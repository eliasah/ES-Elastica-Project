<?php


$params = require(__DIR__ . '/parameters.inc.php');
require(__DIR__ . '/../vendor/autoload.php');

return new \Igraal\Elasticsearch\ESClient($params);

