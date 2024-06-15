<?php

use Symfony\Component\Yaml\Yaml;

require('../lib/bootstrap.php');

$core = new NextFramework\Core\Core();
$core->init();


$core->logger->log('hola');

pre($core);

