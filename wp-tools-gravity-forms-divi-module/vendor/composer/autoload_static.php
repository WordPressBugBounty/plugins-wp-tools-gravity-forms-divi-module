<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit50a42ae65d484d3bdd333d103795232d
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPTools\\Psr\\Container\\' => 22,
            'WPTools\\Pimple\\' => 15,
            'WPT_Divi_Gravity_Modules\\' => 25,
            'WPT\\DiviGravity\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPTools\\Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpt00ls/container/src',
        ),
        'WPTools\\Pimple\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpt00ls/pimple/src/Pimple',
        ),
        'WPT_Divi_Gravity_Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes/modules',
        ),
        'WPT\\DiviGravity\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit50a42ae65d484d3bdd333d103795232d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit50a42ae65d484d3bdd333d103795232d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit50a42ae65d484d3bdd333d103795232d::$classMap;

        }, null, ClassLoader::class);
    }
}
