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
