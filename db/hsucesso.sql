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

DROP TABLE IF EXISTS Exames;
CREATE TABLE Exames (
    nome TEXT PRIMARY KEY NOT NULL,
    material TEXT NOT NULL,
    preco TEXT NOT NULL
);

INSERT INTO Exames (nome, material, preco) VALUES ("Hemograma","Sangue","R$ 50,00");
INSERT INTO Exames (nome, material, preco) VALUES ("HIV1 e HIV2 - Anticorpos totais","Sangue","R$ 70,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Espermograma","Esperma","R$ 100,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Exame Qualitativo de Urina","Urina","R$ 20,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Teste do Pezinho PLUS","Sangue Capilar","R$ 30,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Glicose (glicemia basal)","Sangue, Liquor, Urina","R$ 95,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Colesterol Total","Sangue","R$ 50,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Plaquetas","Sangue","R$ 35,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Ferro","Sangue","R$ 20,00");
INSERT INTO Exames (nome, material, preco) VALUES ("Insulina","Sangue","R$ 50,00");