<?php

use Symfony\Component\Yaml\Yaml;

require('../lib/bootstrap.php');

$core = new NextFramework\Core\Core();
$core->init();
pre($core);


$data = YAML::parse(file_get_contents('../config/core.yaml'));
pre($data);