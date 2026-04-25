# ✨ AI Situation Improver

An AI-powered web application that transforms short situations into clear professional paragraphs with key insights.

---

## 🚀 Features

- 🔹 Convert raw situations into structured paragraphs
- 🔹 Automatically extract **3 key bullet points**
- 🔹 Clean and modern UI using Tailwind CSS
- 🔹 Copy-to-clipboard with visual feedback
- 🔹 Admin panel to manage AI prompt dynamically
- 🔹 AI-powered content generation using OpenRouter API

---

## 🛠️ Tech Stack

**Frontend**
- HTML
- Tailwind CSS
- JavaScript
- SweetAlert2

**Backend**
- Core PHP

**Database**
- MySQL (phpMyAdmin)

**AI Integration**
- OpenRouter API (LLaMA / other models)

---

## 🔄 Project Flow (End-to-End)

### 1️⃣ User Interaction (Frontend)

- The user enters a short situation (1–2 lines) in the input field.
- When the user clicks **"Generate Improved Version"**, a JavaScript function is triggered.
- Input validation ensures the field is not empty.
- A loading indicator (SweetAlert) is displayed while processing.

---

### 2️⃣ API Request (Frontend → Backend)

- The frontend sends a **POST request** to:

`api/generate.php`

- Request body:

```json
{
  "input": "User entered situation"
}
3️⃣ Backend Processing (PHP)

The backend receives the request and:

Validates input
Loads environment variables (.env)
Fetches the latest prompt template from the database (prompts table)

The placeholder:

{user_input}

is replaced with actual user input.

4️⃣ AI Integration (External API)
The processed prompt is sent to the AI model via OpenRouter API

Example model used:

meta-llama/llama-3.1-8b-instruct

The AI returns:

A rewritten paragraph
Exactly 3 bullet points
5️⃣ Response Handling (Backend → Frontend)

The backend:

Extracts AI response
Stores data in situations table:
user_input
ai_output

Sends JSON response:

{
  "success": true,
  "output": "AI generated content"
}
6️⃣ Output Rendering (Frontend)
JavaScript receives the response
The output is formatted into:
A paragraph
A "Key Points" section (bullet list)
The result is displayed in a scrollable UI container
7️⃣ User Experience Enhancements
✅ SweetAlert loading & success messages
✅ Copy-to-clipboard button with visual feedback
✅ Error handling (API / server issues)
✅ Clean UI using Tailwind CSS
8️⃣ Admin Control (Prompt Management)

Admin can update AI behavior via:

/admin/prompt.php

The prompt defines:

Output structure
Formatting rules

This allows dynamic control without changing code.

🔁 Data Flow Summary
User Input
⬇
Frontend (JS Validation)
⬇
API Call (generate.php)
⬇
Backend (PHP Processing)
⬇
AI Model (OpenRouter)
⬇
Response Processing
⬇
Database Storage
⬇
Frontend Display
📊 Database Structure
prompts table
Stores AI prompt template
situations table
Stores:
user_input
ai_output
created_at
⚙️ Setup Instructions
1. Clone the project
git clone https://github.com/your-username/ai-situation-improver.git
2. Setup Database

Create database:

CREATE DATABASE ai_situation_app;

Create tables:

CREATE TABLE prompts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prompt_text TEXT NOT NULL
);

CREATE TABLE situations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_input TEXT,
    ai_output TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
3. Configure .env
OPENROUTER_API_KEY=your_api_key_here
DB_HOST=localhost
DB_NAME=ai_situation_app
DB_USER=root
DB_PASS=
4. Run Project
Place project inside htdocs (XAMPP)
Start Apache & MySQL
Open:
http://localhost/ai-situation-app
📂 Project Structure
ai-situation-app/
│
├── api/
│   └── generate.php
├── admin/
│   └── prompt.php
├── assets/
│   └── js/app.js
├── config/
│   ├── db.php
│   └── env.php
├── includes/
│   ├── header.php
│   └── footer.php
├── index.php
├── .env
├── .gitignore
└── README.md
🔒 Notes
Do not upload .env file to GitHub
Keep API keys secure
Use HTTPS for clipboard features in production
🎯 Key Highlights
🔹 Modular architecture (Frontend + Backend + AI)
🔹 Dynamic prompt system (no hardcoding)
🔹 Clean UI/UX with real-time feedback
🔹 Scalable AI integration (can switch models easily)
👨‍💻 Author

Your Name

📜 License

This project is for educational and personal use.
