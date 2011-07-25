CREATE DATABASE chat_development;
CREATE TABLE  messages (
    id INTEGER(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user VARCHAR(255), 
    time DATETIME, 
    message TEXT
);
