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