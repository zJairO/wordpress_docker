<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit685c973f3e8705ca723ea3a039426174
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rtrsp\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rtrsp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Rtrsp\\Controllers\\Admin\\AdminController' => __DIR__ . '/../..' . '/app/Controllers/Admin/AdminController.php',
        'Rtrsp\\Controllers\\Admin\\HookFilter' => __DIR__ . '/../..' . '/app/Controllers/Admin/HookFilter.php',
        'Rtrsp\\Controllers\\Admin\\Meta\\MetaController' => __DIR__ . '/../..' . '/app/Controllers/Admin/Meta/MetaController.php',
        'Rtrsp\\Controllers\\Admin\\Meta\\MetaOptions' => __DIR__ . '/../..' . '/app/Controllers/Admin/Meta/MetaOptions.php',
        'Rtrsp\\Controllers\\Admin\\RtrsLicensing' => __DIR__ . '/../..' . '/app/Controllers/Admin/RtrsLicensing.php',
        'Rtrsp\\Controllers\\Admin\\ScriptLoader' => __DIR__ . '/../..' . '/app/Controllers/Admin/ScriptLoader.php',
        'Rtrsp\\Helpers\\Fns' => __DIR__ . '/../..' . '/app/Helpers/Fns.php',
        'Rtrsp\\Helpers\\Functions' => __DIR__ . '/../..' . '/app/Helpers/Functions.php',
        'Rtrsp\\Models\\RtrsLicense' => __DIR__ . '/../..' . '/app/Models/RtrsLicense.php',
        'Rtrsp\\Shortcodes\\ShortcodeFilter' => __DIR__ . '/../..' . '/app/Shortcodes/ShortcodeFilter.php',
        'Rtrsp\\Traits\\SingletonTrait' => __DIR__ . '/../..' . '/app/Traits/SingletonTrait.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit685c973f3e8705ca723ea3a039426174::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit685c973f3e8705ca723ea3a039426174::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit685c973f3e8705ca723ea3a039426174::$classMap;

        }, null, ClassLoader::class);
    }
}
