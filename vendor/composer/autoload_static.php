<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit33a3bff9a12755bbdf991a3ac18a96f4
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Classes\\GetResource' => __DIR__ . '/../..' . '/app/classes/GetResource.php',
        'App\\Traits\\BuildString' => __DIR__ . '/../..' . '/app/traits/BuildString.php',
        'App\\Traits\\ManipulateData' => __DIR__ . '/../..' . '/app/traits/ManipulateData.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit33a3bff9a12755bbdf991a3ac18a96f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit33a3bff9a12755bbdf991a3ac18a96f4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit33a3bff9a12755bbdf991a3ac18a96f4::$classMap;

        }, null, ClassLoader::class);
    }
}