<?php

namespace NextFramework\Core;

use NextFramework\Core\Extend\DatabaseExtend;

class Core {
    /** @var Extend\LoggerExtend $logger */
    public $logger = null;

    /** @var Extend\ConfigExtend $config */
    public $config = null;

    /** @var Extend\RouterExtend $router */
    public $router = null;

    /** @var Extend\DatabaseExtend $database */
    public $database = null;

    public function init() {
        $this->logger = new Extend\LoggerExtend();
        $this->logger->init();

        $this->config = new Extend\ConfigExtend();
        $this->config->init();

        $this->router = new Extend\RouterExtend();
        $this->router->init();

        /* Parse Databases in Environment Config */
        $config = $this->config->get('environment');

        foreach($config['database'] as $key => $database) {
            $connector = isset($database['connector']) ? $database['connector'] : 'mysql';

            switch ($connector) {
                case 'mysql':
                    $this->database[$key] = new DatabaseExtend($database);
                    break;
                default:
                    error();
            }

        }

        /* Remove Database Config to prevent malicious access */
        unset($config['database']);
        $this->config->set('environment', $config);
    }
}