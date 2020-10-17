<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit82bc9a15e365a735d20c540885af09eb
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit82bc9a15e365a735d20c540885af09eb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit82bc9a15e365a735d20c540885af09eb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
