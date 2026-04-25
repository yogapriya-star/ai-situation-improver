<?php
header("Content-Type: application/json");

// Enable errors (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../config/db.php");

// Load ENV
require_once("../config/env.php");
loadEnv(__DIR__ . '/../.env');

// ✅ Use OpenRouter API key
$apiKey = $_ENV['OPENROUTER_API_KEY'] ?? '';

if (!$apiKey) {
    echo json_encode(["error" => "OpenRouter API key missing"]);
    exit;
}

// Get input
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['input']) || empty(trim($data['input']))) {
    echo json_encode(["error" => "Input is required"]);
    exit;
}

$user_input = trim($data['input']);

// Get prompt from DB
$res = $conn->query("SELECT prompt_text FROM prompts ORDER BY id DESC LIMIT 1");
$row = $res->fetch_assoc();

if (!$row) {
    echo json_encode(["error" => "No prompt found"]);
    exit;
}

// Replace placeholder
$prompt = str_replace("{user_input}", $user_input, $row['prompt_text']);

// ✅ OpenRouter endpoint
$url = "https://openrouter.ai/api/v1/chat/completions";

// Payload
$payload = [
    "model" => "meta-llama/llama-3.1-8b-instruct",
    "messages" => [
        ["role" => "user", "content" => $prompt]
    ]
];
// CURL
$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $apiKey,
        "Content-Type: application/json"
    ],
    CURLOPT_TIMEOUT => 30
]);

$response = curl_exec($ch);

// CURL error
if (curl_errno($ch)) {
    echo json_encode([
        "error" => "Curl Error",
        "message" => curl_error($ch)
    ]);
    exit;
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$result = json_decode($response, true);

// Handle API error
if ($httpCode !== 200) {
    echo json_encode([
        "error" => "API request failed",
        "status_code" => $httpCode,
        "response" => $result
    ]);
    exit;
}

// Extract output
if (!isset($result['choices'][0]['message']['content'])) {
    echo json_encode([
        "error" => "Invalid response structure",
        "response" => $result
    ]);
    exit;
}

$output = $result['choices'][0]['message']['content'];

// Save to DB
$stmt = $conn->prepare("INSERT INTO situations (user_input, ai_output) VALUES (?, ?)");

if (!$stmt) {
    echo json_encode([
        "error" => "DB error",
        "message" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("ss", $user_input, $output);
$stmt->execute();

// Final response
echo json_encode([
    "success" => true,
    "output" => $output
]);