<?php

require_once "vendor/autoload.php";

use Bruna\FormulaOne\Persistence\ConnectionCreator;
use Bruna\FormulaOne\Repository\RepositorySql;
use Bruna\FormulaOne\Domain\Country;
use Bruna\FormulaOne\Domain\Driver;
use Bruna\FormulaOne\Domain\Team;
use Brunammsa\Inputzvei\InputCpf;
use Brunammsa\Inputzvei\InputText;
use Brunammsa\Inputzvei\InputNumber;


function menu(): void
{
    $opcao = null;

    while($opcao != 0|| $opcao == null) {

        echo 'Selecione uma das opções abaixo:' . PHP_EOL;
        echo "1 - Inserir equipe\n2 - Inserir Piloto\n3 - Inserir País\n4 - Listar pilotos com equipe\n0 - Sair"  . PHP_EOL;

        $opcao = readline();

        if ($opcao == '1') {
            inserirEquipe();
        } elseif ($opcao == '2') {
            inserirPiloto();
        } elseif ($opcao == '3') {
            inserirPais();
        } elseif ($opcao == '4') {
            listarPilotosComEquipes();
        } elseif ($opcao == '0') {
            exit();
        } else {
            echo 'opção inválida' . PHP_EOL;
        }
    }
    echo "\n";

}

function inserirEquipe()
{
    $pdo = ConnectionCreator::createConnection();
    $repositorio = new RepositorySql($pdo);

    $inputzVei = new InputText('Qual o nome da equipe? ');
    $teamAnswer = $inputzVei->ask();

    $inputzVei = new InputNumber('Quantos funcionários a equipe possue? ');
    $qtdEmployeesAnswer = $inputzVei->ask();

    $inputzVei = new InputText('Qual o nome do(a) chefe de equipe? ');
    $chefAnswer = $inputzVei->ask();

    $inputzVei = new InputText('Qual o país de origem? ');
    $countryAnswer = $inputzVei->ask();
    
    $paisId = $repositorio->pegaIdDoPais($countryAnswer);

    if (is_null($paisId)) {
        $country = new Country($countryAnswer);
        $paisId = $repositorio->armazenaCountry($country);
    }

    $inputzVei = new InputNumber('Quantos titulos mundiais a equipe possue? ');
    $qtdWorldTitlesAnswer = $inputzVei->ask();

    try {
        $equipe = new Team($teamAnswer, $qtdEmployeesAnswer, $chefAnswer, $paisId, $qtdWorldTitlesAnswer);
        $repositorio->armazenaTeam($equipe);
        echo "equipe $teamAnswer inserida com sucesso!" . PHP_EOL;
    } catch (InvalidArgumentException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
    echo "\n";

}

function inserirPiloto()
{
    $pdo = ConnectionCreator::createConnection();
    $repositorio = new RepositorySql($pdo);

    $inputzVei = new InputText('Qual o nome do piloto? ');
    $driverAnswer = $inputzVei->ask();

    $inputzVei = new InputText('Qual o nome da equipe? ');
    $teamAnswer = $inputzVei->ask();


    $teamId = $repositorio->pegaIdDaEquipe($teamAnswer);

    if (is_null($teamId)) {
        echo "a equipe $teamAnswer não está cadastrado ainda, você precisa inseri-la primeiro depois adicionar o piloto." . PHP_EOL;
        return;
    }

    $inputValid = false;

    while(!$inputValid) {
        $inputzVei = new InputText('Qual a data de nascimento? (YYYY-MM-DD) ');
        $birthDateAnswer = $inputzVei->ask();
    
        if (strlen($birthDateAnswer) === 10) {
            $inputValid = true;
        } else {
            echo 'Data de nascimento inválida, por favor verifique o formato e a quantidade de caracteres' . PHP_EOL;
        }
    }

    $inputzVei = new InputText('Qual o país de origem? ');
    $countryAnswer = $inputzVei->ask();
    
    $paisId = $repositorio->pegaIdDoPais($countryAnswer);

    if (is_null($paisId)) {
        $country = new Country($countryAnswer);
        $paisId = $repositorio->armazenaCountry($country);
    }

    $date = \DateTimeImmutable::createFromFormat('Y-m-d', $birthDateAnswer);
    try {
        $driver = new Driver($driverAnswer, $teamAnswer, $date, $paisId);
        $repositorio->armazenaDriver($driver);
        echo "piloto $driverAnswer inserido com sucesso!" . PHP_EOL;
    } catch (InvalidArgumentException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
    echo "\n";
}

function inserirPais()
{
    $pdo = ConnectionCreator::createConnection();
    $repositorio = new RepositorySql($pdo);

    $inputValid = false;

    while (!$inputValid) {
        $inputzVei = new InputText('Qual país gostaria de adicionar? ');
        $countryAnswer = $inputzVei->ask();
    
        $country = $repositorio->buscaPais($countryAnswer);
    
        if (is_string($country)) {
            echo "Este país já existe, tente outro. " . PHP_EOL;
            $inputValid = false;
        } elseif (is_null($country)) {
            $inputValid = true;
        }
    }

    try {
        $country = new Country($countryAnswer);
        $repositorio->armazenaCountry($country);
        echo "País $countryAnswer inserido com sucesso!" . PHP_EOL;
    } catch (InvalidArgumentException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
    echo "\n";
}

function listarPilotosComEquipes()
{
    $pdo = ConnectionCreator::createConnection();
    $repositorio = new RepositorySql($pdo);
    $listaPilotos = $repositorio->listaDePilotos();

    foreach ($listaPilotos as $linha) {
        echo "Piloto: " . $linha[0] . " - Equipe: " . $linha[1] . PHP_EOL;
    }
}
menu();