<?php

namespace NextFramework\Core;

class Core {
    public function init() {
        $this->logger = new Extend\LoggerExtend();
        
        $this->config = new Extend\ConfigExtend();
        $this->config->init();
    }
}