-- Reseting tables
PRAGMA FOREIGN_KEYS = OFF;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Funcionarios;
DROP TABLE IF EXISTS DadosExames;
DROP TABLE IF EXISTS Agendamento;
PRAGMA FOREIGN_KEYS = ON;
-- Creating Tables
-- User info table
CREATE TABLE Users (
    id INTEGER PRIMARY KEY NOT NULL,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    nomeReal TEXT NOT NULL UNIQUE,
    cpf TEXT NOT NULL UNIQUE,
    idade INTEGER NOT NULL
);
-- Employee reference table
CREATE TABLE Funcionarios (
    id INTEGER PRIMARY KEY NOT NULL,
    type TEXT NOT NULL,
    FOREIGN KEY (id) REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE
);
-- Exam data table
CREATE TABLE DadosExames (
    id INTEGER PRIMARY KEY NOT NULL,
    nome TEXT NOT NULL,
    material TEXT NOT NULL,
    preco REAL NOT NULL,
    descricao TEXT NOT NULL
);
-- Scheduling table
CREATE TABLE Agendamento (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    exame_id INTEGER NOT NULL,
    horario TIME NOT NULL,
    paciente_id INTEGER NOT NULL,
    enfermeiro_id INTEGER NOT NULL,
    FOREIGN KEY (exame_id) REFERENCES DadosExames(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (paciente_id) REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (enfermeiro_id) REFERENCES Funcionarios(id) ON DELETE CASCADE ON UPDATE CASCADE
);
-- Inserting values into Tables
-- Manually adding users (employees)
INSERT INTO Users
VALUES (
        0,
        "a",
        "a@gmail.com",
        "0cc175b9c0f1b6a831c399e269772661",
        "A",
        "000.000.000-00",
        18
    );
INSERT INTO Users
VALUES (
        1,
        "b",
        "b@gmail.com",
        "92eb5ffee6ae2fec3ad71c777531578f",
        "B",
        "111.111.111-11",
        18
    );
INSERT INTO Funcionarios
VALUES (1, "enfermeiro");
INSERT INTO Users
VALUES (
        2,
        "c",
        "c@gmail.com",
        "4a8a08f09d37b73795649038408b5f33",
        "C",
        "222.222.222-22",
        18
    );
INSERT INTO Funcionarios
VALUES (2, "enfermeiro");
INSERT INTO Users
VALUES (
        3,
        "d",
        "d@gmail.com",
        "8277e0910d750195b448797616e091ad",
        "D",
        "333.333.333-33",
        18
    );
INSERT INTO Funcionarios
VALUES (3, "enfermeiro");
INSERT INTO Users
VALUES (
        4,
        "diegofa2004",
        "diegofavila20@gmail.com",
        "e7d80ffeefa212b7c5c55700e4f7193e",
        "Diego Fontes de Avila",
        "015.367.357-95",
        18
    );
INSERT INTO Funcionarios
VALUES (4, "atendente");
-- Adding data for the different types of exams
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Hemograma",
        "Sangue",
        "R$ 50,00",
        "An??lise de informa????es espec??ficas sobre os tipos e quantidades dos componentes no sangue, como: Gl??bulos vermelhos (hem??cias); Gl??bulos brancos (leuc??citos); Plaquetas (coagula????o sangu??nea)."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "HIV1 e HIV2 - Anticorpos totais",
        "Sangue",
        "R$ 70,00",
        "Analisa no sangue a presen??a de anticorpos produzidos pelo corpo contra os dois tipos de v??rus existentes, o HIV 1 e o HIV 2."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Espermograma",
        "Esperma",
        "R$ 100,00",
        "Analisa a fertilidade masculina, avaliando a composi????o do s??men e as condi????es f??sicas de cada paciente em sua individualidade."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Exame Qualitativo de Urina",
        "Urina",
        "R$ 20,00",
        "Utilizado para avalia????o da fun????o renal e urin??ria, podendo auxiliar no diagn??stico e tratamento. Neste exame ?? feito o exame f??sico, qu??mico e de sedimento da urin??rio, procurando identificar poss??veis pat??genos e estruturas presentes na urina."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Teste do Pezinho PLUS",
        "Sangue Capilar",
        "R$ 30,00",
        "Exame feito a partir do sangue coletado do calcanhar do beb?? e que permite identificar doen??as graves, como: o hipotireoidismo cong??nito, a fenilceton??ria e as hemoglobinopatias."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Glicose (glicemia basal)",
        "Sangue, Liquor, Urina",
        "R$ 95,00",
        "Mede o n??vel da glicose na circula????o sangu??nea do paciente. ?? necess??rio estar de 8 a 12 horas de jejum, sem consumir nenhum tipo de alimento ou bebidas, apenas ??gua ?? permitido. O exame ?? utilizado para investigar poss??veis casos de diabetes e para controle da doen??a."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Colesterol Total",
        "Sangue",
        "R$ 50,00",
        "Mostra os n??veis de colesterol e triglic??rides na corrente sangu??nea.
        Os pacientes que apresentam maiores riscos para doen??as cardiovasculares, fazem acompanhamento com dieta e medicamentos para o controle dos n??veis de colesterol e/ou apresentam risco de ter hipercolesterolemia, por isso devem realizar o exame regularmente."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Plaquetas",
        "Sangue",
        "R$ 35,00",
        "Avalia a sa??de de uma maneira geral e quando h?? sintomas como febre, fadiga e fraqueza, entre outros. Ajuda a identificar doen??as como leucemia, anemia e infec????es bacterianas ou virais. Alergias e hemorragias tamb??m podem ser detectadas."
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Ferro",
        "Sangue",
        "R$ 20,00",
        "Mede os ??ndices da subst??ncia no organismo, prevenindo poss??veis doen??as que surgem pela falta ou excesso do elemento no sangue. "
    );
INSERT INTO DadosExames (nome, material, preco, descricao)
VALUES (
        "Insulina",
        "Sangue",
        "R$ 50,00",
        "Mede a quantidade de insulina no sangue. A insulina ?? um horm??nio produzido e armazenado no p??ncreas. ?? vital para transporte e armazenamento da glicose nas c??lulas, regula o n??vel sangu??neo de glicose e controla o metabolismo de lip??dios."
    );
-- Scheduling exams
INSERT INTO Agendamento
VALUES (
        0,
        1,
        "2022-12-29T13:30",
        0,
        1
    );
INSERT INTO Agendamento
VALUES (
        1,
        1,
        "2022-12-29T12:30",
        0,
        1
    );
INSERT INTO Agendamento
VALUES (
        2,
        1,
        "2022-12-29T15:30",
        0,
        2
    );