<?php

namespace Bruna\FormulaOne\Domain;

class Country
{
    public function __construct(public string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}