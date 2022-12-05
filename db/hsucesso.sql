PRAGMA FOREIGN_KEYS = OFF;

DROP TABLE IF EXISTS UserData;
CREATE TABLE UserData (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL UNIQUE
);

INSERT INTO UserData (username, password) VALUES ("a", "a");
INSERT INTO UserData (username, password) VALUES ("diegofa2004", "senha123");

-- DROP TABLE IF EXISTS Teste;
-- CREATE TABLE Teste (
--     id INTEGER PRIMARY KEY AUTOINCREMENT,
--     nome TEXT NOT NULL,
--     cpf TEXT NOT NULL UNIQUE
-- );

-- INSERT INTO Teste (nome, cpf) VALUES ("NomeTeste", "999.999.999-99");
-- INSERT INTO Teste (nome, cpf) VALUES ("NomeTeste2", "111.111.111-11");

-- SELECT * FROM Teste;
