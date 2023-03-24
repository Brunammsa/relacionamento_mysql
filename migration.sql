CREATE TABLE driver(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    team varchar(255),
    birthDate DATE,
    nationality varchar(255),
);

CREATE TABLE team(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    qtdEmployees int,
    director varchar(255),
    country varchar(255),
    qtdWordTitles int
);

INSERT INTO driver (name, team, birthDate, nationality) VALUES (
    "Lewis Hamilton",
    "Mercedes-AMG",
    "1985-01-07",
    "Reino Unido"
);

INSERT INTO driver (name, team, birthDate, nationality) VALUES (
    "Kevin Magnussen",
    "Haas",
    "1992-10-02",
    "Dinamarca"
);

INSERT INTO driver (name, team, birthDate, nationality) VALUES (
    "Max Verstappen",
    "Red Bull Racing",
    "1997-09-30",
    "Holanda");

INSERT INTO team (name, qtdEmployees, director, country, qtdWordTitles) VALUES (
    "Mercedes-AMG",
    300,
    "Toto Wolff",
    "Reino Unido",
    9
);

INSERT INTO team (name, qtdEmployees, director, country, qtdWordTitles) VALUES (
    "Red Bull Racing",
    300,
    "Christian Horner",
    "Austria",
    5
);

INSERT INTO team (name, qtdEmployees, director, country, qtdWordTitles) VALUES (
    "Haas",
    150,
    "Günther Steiner",
    "Estados Unidos",
    0
);
