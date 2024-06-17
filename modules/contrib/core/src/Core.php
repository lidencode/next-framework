<?php

namespace NextFramework\Core;

class Core {
    /** @var Extend\LoggerExtend $logger */
    public $logger = null;

    /** @var Extend\ConfigExtend $config */
    public $config = null;

    /** @var Extend\RouterExtend $router */
    public $router = null;

    public function init() {
        $this->logger = new Extend\LoggerExtend();
        $this->logger->init();

        $this->config = new Extend\ConfigExtend();
        $this->config->init();

        $this->router = new Extend\RouterExtend();
        $this->router->init();
    }
}