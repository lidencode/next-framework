<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class LoggerExtend {
    public function error($message) {
        var_dump($message);
    }
}