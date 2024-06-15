<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class LoggerExtend {
    public function init() {

    }

    public function log($message, $type = TYPE_INFO, $output = OUTPUT_SCREEN) {
        $debug = core()->config->get('environment')['debug']['enabled'];

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