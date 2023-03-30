<?php

require_once "vendor/autoload.php";

use Bruna\FormulaOne\Persistence\ConnectionCreator;
use Bruna\FormulaOne\Repository\RepositorySql;
use Bruna\FormulaOne\Domain\Country;
use Bruna\FormulaOne\Domain\Driver;
use Bruna\FormulaOne\Domain\Team;


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
    $nomeValido = false;

    while ($nomeValido == false) {
        $nomeEquipe = readline(('Qual o nome da equipe? '));
        $nomeValido = true;

        if (strlen($nomeEquipe) == 0) {
            echo 'Nome inválido' . PHP_EOL;
            $nomeValido = false;
        }
    }

    $qtdEmployeesValid = false;
    while ($qtdEmployeesValid == false) {
        $qtdEmployees = readline('Quantos funcionários a equipe possue? ');
        $qtdEmployeesValid = true;

        if (!is_numeric($qtdEmployees)) {
            echo 'número de funcionários inválido' . PHP_EOL;
            $qtdEmployeesValid = false;
        }
    }

    $directorValid = false;
    while ($directorValid == false) {
        $nomeDiretor = readline('Qual o nome do(a) chefe de equipe? ');
        $directorValid = true;

        if (strlen($nomeDiretor) == 0) {
            echo 'Nome inválido' . PHP_EOL;
            $directorValid = false;
        }
    }
    
    $countryValid = false;
    while ($countryValid == false) {
        $countryName = readline('Qual o país de origem? ');
        $countryValid = true;

        if (strlen($countryName) == 0) {
            echo 'país inválido' . PHP_EOL;
            $qtdWordTitlesValid = false;
        }

        $paisId = $repositorio->pegaIdDoPais($countryName);

        if (is_null($paisId)) {
            echo "Este país não está cadastrado ainda, você precisa inseri-lo em Inserir País para depois adicionar a equipe." . PHP_EOL . 
            "Após adicionar, volte e insira novamente a equipe \n\n";
            return;
        }
    }

    $qtdWordTitlesValid = false;
    while ($qtdWordTitlesValid == false) {
        $qtdWordTitles = readline('Quantos titulos mundiais a equipe possue? ');
        $qtdWordTitlesValid = true;

        if (!is_numeric($qtdWordTitles)) {
            echo 'quantidade inválida' . PHP_EOL;
            $qtdWordTitlesValid = false;
        }
    }


    try {
        $equipe = new Team($nomeEquipe, $qtdEmployees, $nomeDiretor, $paisId, $qtdWordTitles);
        $repositorio->armazenaTeam($equipe);
        echo "equipe $nomeEquipe inserida com sucesso!" . PHP_EOL;
    } catch (InvalidArgumentException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
    echo "\n";

}

function inserirPiloto()
{
    $pdo = ConnectionCreator::createConnection();
    $repositorio = new RepositorySql($pdo);
    $nomeValido = false;

    while ($nomeValido == false) {
        $nomePiloto = readline('Qual o nome do piloto? ');
        $nomeValido = true;

        if (strlen($nomePiloto) == 0) {
            echo 'Nome inválido' . PHP_EOL;
            $nomeValido = false;
        }
    }

    $nomeValido = false;
    while ($nomeValido == false) {
        $nomeEquipe = readline('Qual o nome da equipe? ');
        $nomeValido = true;

        if (strlen($nomeEquipe) == 0) {
            echo 'Nome inválido' . PHP_EOL;
            $nomeValido = false;
        }
    }

    $equipeId = $repositorio->pegaIdDaEquipe($nomeEquipe);

    if (is_null($equipeId)) {
        echo "Esta equipe não está cadastrado ainda, você precisa inseri-la em Inserir Equipe para depois adicionar o piloto." . PHP_EOL . 
        "Após adicionar, volte e insira novamente o piloto \n\n";
        return;
    }

    $nascimentoValido = false;
    while ($nascimentoValido == false) {
        $nascimento = readline('Qual a data de nascimento? (YYYY-MM-DD)');
        $nascimentoValido = true;

        if (strlen($nascimento) < 10 || strlen($nascimento) > 10 ) {
            echo 'Data de nascimento inválida, por favor verifique o formato e a quantidade de caracteres' . PHP_EOL;
            $nascimentoValido = false;
        }
    }

    $countryValid = false;
    while ($countryValid == false) {
        $countryName = readline('Qual o país de origem? ');
        $countryValid = true;

        if (strlen($countryName) == 0) {
            echo 'País inválido' . PHP_EOL;
            $countryValid = false;
        }
    }

    $paisId = $repositorio->pegaIdDoPais($countryName);

    if (is_null($paisId)) {
        echo "Este país não está cadastrado ainda, você precisa inseri-lo em Inserir País para depois adicionar o piloto." . PHP_EOL . 
        "Após adicionar, volte e insira novamente o piloto \n\n";
        return;
    }

    $date = \DateTimeImmutable::createFromFormat('Y-m-d', $nascimento);
    try {
        $piloto = new Driver($nomePiloto, $equipeId, $date, $equipeId);
        $repositorio->armazenaDriver($piloto);
        echo "piloto $nomePiloto inserido com sucesso!" . PHP_EOL;
    } catch (InvalidArgumentException $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
    echo "\n";
}

function inserirPais()
{
    $pdo = ConnectionCreator::createConnection();
    $repositorio = new RepositorySql($pdo);
    $countryValid = false;

    while ($countryValid == false) {
        $countryName = readline('Qual país gostaria de adicionar? ');
        $countryValid = true;

        if (strlen($countryName) == 0) {
            echo 'País inválido' . PHP_EOL;
            $countryValid = false;
        }

        $nomePais = $repositorio->buscaPais($countryName);

        if (is_string($nomePais)) {
            echo "Este país já existe, tente outro. " . PHP_EOL;
            $countryValid = false;
        } elseif (is_null($nomePais)) {
            $countryValid = true;
        }
    }

    try {
        $country = new Country($countryName);
        $repositorio->armazenaCountry($country);
        echo "País $countryName inserido com sucesso!" . PHP_EOL;
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