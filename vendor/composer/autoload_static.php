<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8e45022df83c5d63186243b1230e9ece
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8e45022df83c5d63186243b1230e9ece::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8e45022df83c5d63186243b1230e9ece::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
