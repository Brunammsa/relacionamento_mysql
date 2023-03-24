<?php

namespace Bruna\FormulaOne\Domain;

class Team
{
    public function __construct(
        public string $name,
        public int $qtdEmployees,
        public string $director,
        public string $country,
        public int $qtdWordTitles
    )
    {

    }
};