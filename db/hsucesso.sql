PRAGMA FOREIGN_KEYS = OFF;

DROP TABLE IF EXISTS UserData;
CREATE TABLE UserData (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL UNIQUE
);

INSERT INTO UserData (username, password) VALUES ("a", "a");
INSERT INTO UserData (username, password) VALUES ("diegofa2004", "senha123");
