<?php

use Symfony\Component\Yaml\Yaml;

require('../lib/bootstrap.php');

$core = new NextFramework\Core\Core();
$core->init();


$core->logger->log('¡Hola mundo! (solo se muestra en modo debug (TYPE_DEBUG)', TYPE_INFO, OUTPUT_ALL);

pre($core);

