CREATE DATABASE IF NOT EXISTS social_app;
USE social_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    bio TEXT NULL,
    profile_image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    UNIQUE KEY one_like (post_id, user_id),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, password, full_name, bio) VALUES
('juan', '$2y$12$0Fk9nDg8boHIOurVFYl5s.GaPDekNefl96Zk7DasZ5O7eQ7FTTNtu', 'Juan Dela Cruz', 'BSIT student at SMCC'),
('maria', '$2y$12$0Fk9nDg8boHIOurVFYl5s.GaPDekNefl96Zk7DasZ5O7eQ7FTTNtu', 'Maria Santos', 'Web Systems student');

INSERT INTO posts (user_id, content) VALUES
(1, 'Hello everyone! Welcome to our mini social network.'),
(2, 'Working on our Web Systems final project today.');

INSERT INTO comments (post_id, user_id, content) VALUES
(1, 2, 'Good luck with the project!');

INSERT INTO likes (post_id, user_id) VALUES
(1, 2),
(2, 1);
