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
