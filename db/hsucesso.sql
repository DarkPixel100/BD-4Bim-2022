PRAGMA FOREIGN_KEYS = OFF;

DROP TABLE IF EXISTS UserData;
CREATE TABLE UserData (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL UNIQUE
);

INSERT INTO UserData (username, email, password) VALUES ("a", "a", "a");
INSERT INTO UserData (username, email, password) VALUES ("diegofa2004", "diegofavila20@gmail.com", "senha123");
