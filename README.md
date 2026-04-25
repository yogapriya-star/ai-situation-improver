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

### Frontend
- HTML  
- Tailwind CSS  
- JavaScript  
- SweetAlert2  

### Backend
- Core PHP  

### Database
- MySQL (phpMyAdmin)  

### AI Integration
- OpenRouter API (LLaMA / other models)  

---

## 🔄 Project Flow (End-to-End)

### 1️⃣ User Interaction (Frontend)
- The user enters a short situation (1–2 lines) in the input field.  
- On clicking **"Generate Improved Version"**, a JavaScript function is triggered.  
- Input validation ensures the field is not empty.  
- A loading indicator (SweetAlert) is displayed.  

---

### 2️⃣ API Request (Frontend → Backend)
- A **POST request** is sent to:


api/generate.php


- Request body:

```json
{
  "input": "User entered situation"
}
3️⃣ Backend Processing (PHP)
Validates user input
Loads environment variables from .env
Fetches latest prompt from prompts table
Replaces placeholder:
{user_input}

with actual input.

4️⃣ AI Integration (External API)
Sends processed prompt to OpenRouter API

Example model:

meta-llama/llama-3.1-8b-instruct
AI returns:
A rewritten paragraph
Exactly 3 bullet points
5️⃣ Response Handling (Backend → Frontend)
Extracts AI response
Stores in situations table:
user_input
ai_output
Sends response:
{
  "success": true,
  "output": "AI generated content"
}
6️⃣ Output Rendering (Frontend)
JavaScript formats output into:
Paragraph
Key Points list
Displays inside scrollable UI container
7️⃣ User Experience Enhancements
✅ SweetAlert loading & success messages
✅ Copy-to-clipboard with visual feedback
✅ Error handling (API / server issues)
✅ Clean responsive UI
8️⃣ Admin Control (Prompt Management)
Accessible via:
/admin/prompt.php
Allows dynamic control of:
Output format
AI behavior
🔁 Data Flow Summary
User Input
⬇
Frontend (Validation)
⬇
API Call (generate.php)
⬇
Backend Processing
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
user_input
ai_output
created_at
⚙️ Setup Instructions
1. Clone Repository
git clone https://github.com/your-username/ai-situation-improver.git
2. Setup Database
CREATE DATABASE ai_situation_app;
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
Move project to htdocs (XAMPP)
Start Apache & MySQL
Open:
http://localhost/ai-situation-app

Admin panel:

http://localhost/ai-situation-app/admin/prompt.php
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
❗ Do not upload .env file to GitHub
🔐 Keep API keys secure
🌐 Use HTTPS in production (clipboard support)
🎯 Key Highlights
🔹 Modular architecture (Frontend + Backend + AI)
🔹 Dynamic prompt system
🔹 Clean UI/UX with real-time feedback
🔹 Scalable AI integration
👨‍💻 Author

Yogapriya Shanmugam

📜 License

This project is for educational and personal use.
