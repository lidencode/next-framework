<?php

define('APP_ROOT', dirname(__DIR__));

function pre($obj, $die = false) {
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';

    if ($die) die();
}

/**
 * Autoload Class Function
 */
spl_autoload_register(function($classPath) {
    $segments = explode('\\', $classPath);
    $project = array_shift($segments);
    $module = array_shift($segments);
    $relativePath = implode('/', $segments);

    $moduleFolders = scandir(APP_ROOT.'/modules/');
    foreach ($moduleFolders as $moduleFolder) {
        if ($moduleFolder != '..') {
            $path = APP_ROOT.'/modules/'.$moduleFolder.'/'.strtolower($module).'/src/'.$relativePath.'.php';

            if (file_exists($path)) {
                require_once($path);
                return true;
            }
        }
    }

    error();
});


function error() {
    pre('Hay un error!', true);
}