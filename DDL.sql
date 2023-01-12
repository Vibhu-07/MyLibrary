CREATE TABLE users (
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(50),
    'password' VARCHAR(225),
    created_at DATETIME DEFAULT current_timestamp()
);