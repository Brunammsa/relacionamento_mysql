<?php

namespace Bruna\FormulaOne\Repository;

use Bruna\FormulaOne\Domain\Driver;
use Bruna\FormulaOne\Domain\Team;
use Bruna\FormulaOne\Domain\Country;

use PDO;

class RepositorioSql
{
    public function __construct(private PDO $connection)
    {
    }

    public function armazenaDriver(Driver $driver): void
    {
        $insertQuery = 'INSERT INTO driver (name, team_id, birthDate, country) VALUES (
            :name,
            :team_id,
            :birthDate,
            :country_id
        );';

        $statemend = $this->connection->prepare($insertQuery);
        $sucess = $statemend->execute([
            ':name' => $driver->getName(),
            ':team_id' => $driver->getTeamId(),
            ':birthDate' => $driver->getBirthDate(),
            ':country_id' => $driver->country_id()
        ]);
    }

    public function armazenaTeam(Team $team): void
    {
        $insertQuery = 'INSERT INTO team (name, qtdEmployees, director, country, qtdWordTitles) VALUES (
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

    public function armazenaCountry(Country $country): void
    {
        $insertQuery = 'INSERT INTO country (name) VALUES (:country)';
        $statemend = $this->connection->prepare($insertQuery);
        $sucess = $statemend->execute([
            ':name' => $country->getName(),
        ]);
    }

    public function listaPilotosComEquipe(): void
    {

    }
}