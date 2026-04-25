# ✨ AI Situation Improver

An AI-powered web application that transforms short situations into clear professional paragraphs with key insights.

---

## 🚀 Features

* 🔹 Convert raw situations into structured paragraphs
* 🔹 Automatically extract **3 key bullet points**
* 🔹 Clean and modern UI using Tailwind CSS
* 🔹 Copy-to-clipboard with visual feedback
* 🔹 Admin panel to manage AI prompt dynamically
* 🔹 AI-powered content generation using OpenRouter API

---

## 🛠️ Tech Stack

### Frontend

* HTML
* Tailwind CSS
* JavaScript
* SweetAlert2

### Backend

* Core PHP

### Database

* MySQL (phpMyAdmin)

### AI Integration

* OpenRouter API (LLaMA / other models)

---

## 🔄 Project Flow (End-to-End)

### 1️⃣ User Interaction (Frontend)

* User enters a short situation (1–2 lines)
* Clicks **"Generate Improved Version"**
* Input validation is performed
* Loading popup is shown

---

### 2️⃣ API Request (Frontend → Backend)

POST request sent to:

```
api/generate.php
```

Request body:

```json
{
  "input": "User entered situation"
}
```

---

### 3️⃣ Backend Processing (PHP)

* Validates input
* Loads `.env` variables
* Fetches latest prompt from DB
* Replaces:

```
{user_input}
```

with actual input

---

### 4️⃣ AI Integration (OpenRouter)

Model used:

```
meta-llama/llama-3.1-8b-instruct
```

AI returns:

* A rewritten paragraph
* Exactly 3 bullet points

---

### 5️⃣ Response Handling

Backend:

* Extracts AI response
* Stores in `situations` table:

  * user_input
  * ai_output

Returns:

```json
{
  "success": true,
  "output": "AI generated content"
}
```

---

### 6️⃣ Output Rendering (Frontend)

* Formats response into:

  * Paragraph
  * Key Points list
* Displays in scrollable UI

---

### 7️⃣ User Experience Enhancements

* ✅ SweetAlert loading & success
* ✅ Copy button with visual feedback
* ✅ Error handling
* ✅ Clean responsive UI

---

### 8️⃣ Admin Panel (Prompt Control)

Access:

```
/admin/prompt.php
```

* Modify AI prompt
* Control output structure dynamically

---

## 🔁 Data Flow

```
User Input
⬇
Frontend (Validation)
⬇
API Call (generate.php)
⬇
Backend Processing
⬇
OpenRouter AI
⬇
Response Processing
⬇
Database Storage
⬇
Frontend Display
```

---

## 📊 Database Structure

### prompts table

* id
* prompt_text

### situations table

* id
* user_input
* ai_output
* created_at

---

## ⚙️ Setup Instructions

### 1. Clone Repository

```bash
git clone https://github.com/your-username/ai-situation-improver.git
```

---

### 2. Setup Database

```sql
CREATE DATABASE ai_situation_app;
```

```sql
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
```

---

### 3. Configure `.env`

```
OPENROUTER_API_KEY=your_api_key_here
DB_HOST=localhost
DB_NAME=ai_situation_app
DB_USER=root
DB_PASS=
```

---

### 4. Run Project

* Place project in `htdocs` (XAMPP)
* Start Apache & MySQL

Open:

```
http://localhost/ai-situation-app
```

Admin:

```
http://localhost/ai-situation-app/admin/prompt.php
```

---

## 📂 Project Structure

```
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
```

---

## 🔒 Notes

* ❗ Do NOT upload `.env` file
* 🔐 Keep API keys secure
* 🌐 Use HTTPS in production

---

## 🎯 Key Highlights

* 🔹 Modular architecture (Frontend + Backend + AI)
* 🔹 Dynamic prompt system
* 🔹 Clean UI/UX
* 🔹 Scalable AI integration

---

## 👨‍💻 Author

**Yogapriya Shanmugam**

---

## 📜 License

This project is for educational and personal use.
