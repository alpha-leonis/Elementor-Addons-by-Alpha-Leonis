<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite0ce5f2c7e3f169b1f772e5505102c46
{
    public static $files = array (
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
        'A' => 
        array (
            'AlphaLeonisAddons\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
        'AlphaLeonisAddons\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite0ce5f2c7e3f169b1f772e5505102c46::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite0ce5f2c7e3f169b1f772e5505102c46::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
