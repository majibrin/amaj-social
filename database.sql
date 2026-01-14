CREATE TABLE IF NOT EXISTS users (
    unique_id INT(11) PRIMARY KEY,
    fname VARCHAR(255),
    lname VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255),
    image VARCHAR(255),
    status VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS posts (
    postid INT(11) AUTO_INCREMENT PRIMARY KEY,
    unique_id INT(11),
    post_msg TEXT,
    post_img VARCHAR(255),
    likes INT(11) DEFAULT 0,
    created DATETIME
);

CREATE TABLE IF NOT EXISTS messages (
    message_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    incoming_id INT(11),
    outgoing_id INT(11),
    message TEXT,
    is_read INT(1) DEFAULT 0,
    date_created DATETIME
);

CREATE TABLE IF NOT EXISTS notifications (
    notification_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    sender_id INT(11),
    receiver_id INT(11),
    type VARCHAR(50),
    related_id INT(11),
    message TEXT,
    is_read INT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS likes (
    like_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    post_id INT(11),
    user_id INT(11)
);
