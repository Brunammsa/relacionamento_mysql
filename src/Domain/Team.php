<?php

namespace Bruna\FormulaOne\Domain;

class Team
{
    public function __construct(
        public string $name,
        public int $qtdEmployees,
        public string $director,
        public string $country_id,
        public int $qtdWorldTitles
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQtdEmployees(): int
    {
        return $this->qtdEmployees;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function getCountryId(): string
    {
        return $this->country_id;
    }

    public function getQtdWorldTitles(): int
    {
        return $this->qtdWorldTitles;
    }
};