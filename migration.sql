CREATE TABLE country(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE driver(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    team_id int,
    birth_date DATE,
    country_id int
);

CREATE TABLE team(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    qtd_employees int,
    director varchar(255),
    country_id int,
    qtd_world_titles int
);