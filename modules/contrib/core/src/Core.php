<?php

namespace NextFramework\Core;

class Core {
    public function init() {
        $this->config = new Extend\ConfigExtend();
        $this->config->init();
    }
}