<?php

namespace NextFramework\Core;

class Core {
    /** @var Extend\LoggerExtend $logger */
    public $logger = null;

    /** @var Extend\ConfigExtend $config */
    public $config = null;

    public function init() {
        $this->logger = new Extend\LoggerExtend();
        $this->logger->init();

        $this->config = new Extend\ConfigExtend();
        $this->config->init();
    }
}