<?php

namespace Bruna\FormulaOne\Domain;

class Driver
{
    public function __construct(
        public string $name,
        public string $team,
        public \DateTimeInterface $birthDate,
        public string $nationality
    )
    {

    }
}