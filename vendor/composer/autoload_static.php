<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3bc84851fc9e536f40bfcd579ea090e4
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Dotenv\\' => 25,
            'Seld\\CliPrompt\\' => 15,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'L' => 
        array (
            'League\\CLImate\\' => 15,
        ),
        'B' => 
        array (
            'Brunammsa\\Inputzvei\\' => 20,
            'Bruna\\FormulaOne\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dotenv',
        ),
        'Seld\\CliPrompt\\' => 
        array (
            0 => __DIR__ . '/..' . '/seld/cli-prompt/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'League\\CLImate\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/climate/src',
        ),
        'Brunammsa\\Inputzvei\\' => 
        array (
            0 => __DIR__ . '/..' . '/brunammsa/inputzvei/src',
        ),
        'Bruna\\FormulaOne\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3bc84851fc9e536f40bfcd579ea090e4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3bc84851fc9e536f40bfcd579ea090e4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3bc84851fc9e536f40bfcd579ea090e4::$classMap;

        }, null, ClassLoader::class);
    }
}
