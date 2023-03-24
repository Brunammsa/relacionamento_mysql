<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbb29081ac3f3c315a1115ce2f06e98ba
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Bruna\\Formulaone\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Bruna\\Formulaone\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitbb29081ac3f3c315a1115ce2f06e98ba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbb29081ac3f3c315a1115ce2f06e98ba::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbb29081ac3f3c315a1115ce2f06e98ba::$classMap;

        }, null, ClassLoader::class);
    }
}