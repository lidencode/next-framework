<?php

namespace NextFramework\Core;

use NextFramework\Core\Connector\MySQLConnector;

class Core {
    /** @var Extend\LoggerExtend $logger */
    public $logger = null;

    /** @var Extend\ConfigExtend $config */
    public $config = null;

    /** @var Extend\RouterExtend $router */
    public $router = null;

    /** @var Extend\DatabaseExtend $database */
    private $database = null;

    private $modules = [];

    public function init() {
        $this->logger = new Extend\LoggerExtend();
        $this->logger->init();

        $this->config = new Extend\ConfigExtend();
        $this->config->init();

        $this->router = new Extend\RouterExtend();
        $this->router->init();

        /* Parse modules */
        $config = $this->config->get('environment');
        if (isset($config['modules'])) {
            $folders = scandir(APP_ROOT.'/modules/');

            foreach($config['modules'] as $key) {
                /* find module folder */
                foreach ($folders as $folder) {
                    if ($folder != '..') {
                        if (file_exists(APP_ROOT.'/modules/'.$folder.'/'.strtolower($key)) &&
                            file_exists(APP_ROOT.'/modules/'.$folder.'/'.strtolower($key).'/module.php')) {
                            $this->modules[$key] = new Extend\ModuleExtend(APP_ROOT.'/modules/'.$folder.'/'.strtolower($key));
                        }
                    }
                }
            }
        }

        /* Parse Databases in Environment Config */
        $config = $this->config->get('environment');

        foreach($config['database'] as $key => $database) {
            $connector = isset($database['connector']) ? $database['connector'] : 'mysql';

            switch ($connector) {
                case 'mysql':
                    $this->database[$key] = new MySQLConnector($database);
                    break;
                default:
                    error();
            }

        }

        /* Remove Database Config to prevent malicious access */
        unset($config['database']);
        $this->config->set('environment', $config);
    }

    /**
     * @param $database
     * @return Extend\DatabaseExtend
     */
    function database($database) {
        return isset($this->database[$database]) ? $this->database[$database] : null;
    }

    /**
     * @param $module
     * @return Extend\ModuleExtend
     */
    function module($module) {
        return isset($this->modules[$module]) ? $this->modules[$module] : null;
    }

    function hook($hook) {
        foreach($this->modules as $key => $module) {
            $hook_function = $key.'_'.$hook;
            $args = func_get_args();
            $args = isset($args[1]) ? $args[1] : [];

            if(function_exists($hook_function)) {
                call_user_func_array($hook_function, $args);
            }
        }
    }
}