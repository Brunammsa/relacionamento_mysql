<?php

namespace Bruna\FormulaOne\Repository;

use Bruna\FormulaOne\Domain\Driver;
use Bruna\FormulaOne\Domain\Team;
use Bruna\FormulaOne\Domain\Country;
use PDO;

class RepositorySql
{
    public function __construct(private PDO $connection)
    {
    }

    public function armazenaDriver(Driver $driver): void
    {
        $insertQuery = 'INSERT INTO driver (name, team_id, birthDate, country_id) VALUES (
            :name,
            :team_id,
            :birthDate,
            :country_id
        );';

        $statemend = $this->connection->prepare($insertQuery);
        $sucess = $statemend->execute([
            ':name' => $driver->getName(),
            ':team_id' => $driver->getTeamId(),
            ':birthDate' => $driver->getBirthDate()->format('Y-m-d'),
            ':country_id' => $driver->getCountryId()
        ]);
    }

    public function armazenaTeam(Team $team): void
    {
        $insertQuery = 'INSERT INTO team (name, qtdEmployees, director, country_id, qtdWorldTitles) VALUES (
            :name, 
            :qtdEmployees,
            :director,
            :country_id,
            :qtdWorldTitles
        );';

        $statemend = $this->connection->prepare($insertQuery);
        $sucess = $statemend->execute([
            ':name' => $team->getName(),
            ':qtdEmployees' => $team->getQtdEmployees(),
            ':director' => $team->getDirector(),
            ':country_id' => $team->getCountryId(),
            ':qtdWorldTitles' => $team->getQtdWorldTitles()
        ]);
    }

    public function armazenaCountry(Country $country): int
    {
        $insertQuery = 'INSERT INTO country (name) VALUES (:country)';
        $statemend = $this->connection->prepare($insertQuery);
        $sucess = $statemend->execute([
            ':country' => $country->getName(),
        ]);

        $lastId = $this->connection->lastInsertId();

        return (int)$lastId;
    }

    public function listaDePilotos(): array
    {
        $sqlQuery = 'SELECT d.name, t.name FROM driver AS d JOIN team AS t ON t.id=d.team_id;';
        $statement = $this->connection->query($sqlQuery);
        $resultado = $statement->fetchAll();

        $listaPilotos = [];

        foreach ($resultado as $resultadoPilotos) {
            $listaPilotos[] = $resultadoPilotos;
        }

        return $listaPilotos;
    }

    public function pegaIdDoPais($pais): ?int
    {
        $sqlQuery = "SELECT id FROM country WHERE name ='$pais'";
        $statement = $this->connection->query($sqlQuery);
        $sucess = $statement->fetch(PDO::FETCH_ASSOC);

        if (is_array($sucess)) {
            $idDoPais = $sucess['id'];
        } else {
            $idDoPais = null;
        }

        return $idDoPais;
    }

    public function buscaPais($pais): ?string
    {
        $sqlQuery = "SELECT * FROM country WHERE name ='$pais'";
        $statement = $this->connection->query($sqlQuery);
        $sucess = $statement->fetch(PDO::FETCH_ASSOC);

        if (is_array($sucess)) {
            $nomeDoPais = $sucess['name'];
        } else {
            $nomeDoPais = null;
        }
    
        return $nomeDoPais;
    }

    public function pegaIdDaEquipe($equipe): ?int
    {
        $sqlQuery = "SELECT id FROM team WHERE name ='$equipe'";
        $statement = $this->connection->query($sqlQuery);
        $sucess = $statement->fetch(PDO::FETCH_ASSOC);

        if (is_array($sucess)) {
            $idDoPais = $sucess['id'];
        } else {
            $idDoPais = null;
        }

        return $idDoPais;
    }

}