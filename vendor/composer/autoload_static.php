<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitec22ad4e40c48fbeb5c9392ff474168b
{
    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'Yakoffka\\DijkstrasAlgorithm\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Yakoffka\\DijkstrasAlgorithm\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitec22ad4e40c48fbeb5c9392ff474168b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitec22ad4e40c48fbeb5c9392ff474168b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitec22ad4e40c48fbeb5c9392ff474168b::$classMap;

        }, null, ClassLoader::class);
    }
}
