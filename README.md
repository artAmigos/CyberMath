# CyberMath
CyberMath_Developers
composer require vlucas/phpdotenv

ru, languages

add file .env 
DB_HOST=localhost
DB_NAME=apparta
DB_USER=root
DB_PASS=


при создании бд такая была
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE users ADD UNIQUE (name);


ALTER TABLE users 
ADD COLUMN coins INT DEFAULT 0,
ADD COLUMN status ENUM('active', 'blocked') DEFAULT 'active';



CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE moderator (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE moderator_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    moderator_id INT NOT NULL,
    target_name VARCHAR(255) NOT NULL, -- имя пользователя, на кого идет запрос
    action ENUM('give_coins', 'block_user', 'delete_user') NOT NULL,
    coins INT DEFAULT 0,
    note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



composer require vlucas/phpdotenv
