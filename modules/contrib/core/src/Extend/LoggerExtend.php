<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class LoggerExtend {
    public function init() {

    }

    public function log($message, $type = TYPE_INFO, $output = OUTPUT_SCREEN) {
        $debug = core()->config->get('environment')['debug']['enabled'];
        $time = date('d/m/y H:i:s');

        /* Type error */
        $typeString = 'undefined';

        switch ($type) {
            case TYPE_INFO: $typeString = 'info'; break;
            case TYPE_WARNING: $typeString = 'warning'; break;
            case TYPE_ERROR: $typeString = 'error'; break;
            case TYPE_DEBUG: $typeString = 'debug'; break;
        }

        $message = $time.' ['.$typeString.'] '.$message."\n";

        if (!$type) $type = TYPE_INFO;
        if ($type == TYPE_DEBUG && !$debug) return;

        if ($output == OUTPUT_ALL || $output == OUTPUT_SCREEN) {
            var_dump($message);
        }

        if ($output == OUTPUT_ALL || $output == OUTPUT_FILE) {
            $file = APP_ROOT.'/var/logs/'.APP_ENV.'-'.date('Ymd').'.log';
            file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
        }
    }
}