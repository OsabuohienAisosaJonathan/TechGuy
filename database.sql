CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role_id INT,
    location_enabled BOOLEAN DEFAULT 0,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

CREATE TABLE locations (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
