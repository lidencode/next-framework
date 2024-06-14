<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 'On');

use Symfony\Component\Yaml\Yaml;

require('../lib/bootstrap.php');

$data = YAML::parse(file_get_contents('../config/core.yaml'));
pre($data);

$admin = new NextFramework\Core\Controller\AdminController();
$admin->test();