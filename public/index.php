<?php

use Symfony\Component\Yaml\Yaml;

require('../lib/bootstrap.php');

$data = YAML::parse(file_get_contents('../config/core.yaml'));
pre($data);