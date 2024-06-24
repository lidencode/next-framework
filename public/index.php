<?php

require('../lib/bootstrap.php');


$values = core()->database['main']->query("SELECT * FROM `test` WHERE `id` = :id", ['id' => 2]);
pre($values);

// $user = new \NextFramework\Core\Entity\User();
// pre($user);

// $core->logger->log('¡Hola mundo! (solo se muestra en modo debug (TYPE_DEBUG)', TYPE_INFO, OUTPUT_ALL);

pre($core);

