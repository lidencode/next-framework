<?php

require('../lib/bootstrap.php');


$user = new \NextFramework\Core\Entity\User();
pre($user);

$core->logger->log('¡Hola mundo! (solo se muestra en modo debug (TYPE_DEBUG)', TYPE_INFO, OUTPUT_ALL);

pre($core);

