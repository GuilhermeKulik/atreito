select * from atreito.user 
truncate atreito.user


use atreito;
CREATE table score (
    user_id INT PRIMARY KEY,
    xp_points INT DEFAULT 0,
    points INT DEFAULT 0,
    level INT DEFAULT 1,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    streak INT DEFAULT 0,
    highest_streak INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);
CREATE TABLE log_score (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    client_id INT NOT NULL,
    admin_id INT NOT NULL,
    transaction_type ENUM('ADD', 'CONSUME') NOT NULL,
    points_amount INT NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES user(user_id)
);
