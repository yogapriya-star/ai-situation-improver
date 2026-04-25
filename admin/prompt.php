<?php
include("../config/db.php");

$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prompt = $_POST['prompt'];

    $stmt = $conn->prepare("INSERT INTO prompts (prompt_text) VALUES (?)");
    $stmt->bind_param("s", $prompt);
    $stmt->execute();

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Prompt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center px-4">

<div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl p-8">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            ⚙️ Manage AI Prompt
        </h2>
        <p class="text-gray-500 text-sm mt-1">
            Customize how your AI generates improved situations.
        </p>
    </div>

    <!-- Success Message -->
    <?php if ($success): ?>
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 border border-green-300">
            ✅ Prompt saved successfully!
        </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="POST" class="flex flex-col gap-4">

        <!-- Label -->
        <label class="text-sm font-medium text-gray-700">
            Prompt Template
        </label>

        <!-- Textarea -->
        <textarea name="prompt"
            class="w-full h-[260px] p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:outline-none transition text-sm leading-relaxed resize-none"
        >You are an assistant that improves English writing.

Task:
Given a short situation (1–2 lines), rewrite it into a clear paragraph.

Also extract exactly 3 bullet points.

Format strictly:
<paragraph>

Key Points:
- Point 1
- Point 2
- Point 3

Input:
{user_input}</textarea>

        <!-- Button -->
        <button
            class="mt-2 w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-lg font-semibold hover:scale-[1.02] transition-all shadow-md">
            💾 Save Prompt
        </button>

    </form>

    <!-- Tips Section -->
    <div class="mt-6 p-4 bg-gray-50 rounded-xl border text-sm text-gray-600">
        <strong>💡 Tips:</strong>
        <ul class="list-disc pl-5 mt-2 space-y-1">
            <li>Use <code>{user_input}</code> as placeholder</li>
            <li>Keep output format consistent for frontend parsing</li>
            <li>Avoid unnecessary text like "Here is..."</li>
        </ul>
    </div>

</div>

</body>
</html>