<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 'On');

define('APP_ROOT', dirname(__DIR__));

function pre($obj, $die = false) {
    /**
     * TODO: Función para mostrar objetos en pantalla, se tendría que integrar con logger y rehacerla bien.
     */

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

function &core() {
    global $core;
    return $core;
}

function error($message = null) {
    /**
     * TODO: Se muestran mensajes temporalmente, pero se tendrá que rehacer la función y
     *   revisar todos los errores usados hasta el momento en el código.
     */
    if ($message) {
        pre($message, true);
    } else {
        $backtrace = debug_backtrace();

        // Formatear y mostrar el backtrace
        echo "<pre>";

        foreach ($backtrace as $trace) {
            echo "Archivo: " . (isset($trace['file']) ? $trace['file'] : 'N/A') . "\n";
            echo "Línea: " . (isset($trace['line']) ? $trace['line'] : 'N/A') . "\n";
            echo "Función: " . (isset($trace['function']) ? $trace['function'] : 'N/A') . "\n";
            echo "Clase: " . (isset($trace['class']) ? $trace['class'] : 'N/A') . "\n";
            echo "Tipo: " . (isset($trace['type']) ? $trace['type'] : 'N/A') . "\n";
            echo "Args: " . print_r($trace['args'], true) . "\n";
            echo "-------------------------\n";
        }

        echo "</pre>";

        pre('Hay un error! (pendiente de desarrollar en logger)', true);
    }
}