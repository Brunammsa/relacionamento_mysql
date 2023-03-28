<?php

namespace Bruna\FormulaOne\Domain;

class Driver
{
    public function __construct(
        public string $name,
        public string $team_id,
        public \DateTimeInterface $birthDate,
        public string $country_id
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTeamId(): string
    {
        return $this->team_id;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function getCountryId(): string
    {
        return $this->country_id;
    }
}