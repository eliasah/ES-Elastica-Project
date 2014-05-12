<?php

/* @var $esClient Igraal\Elasticsearch\ESClient */
$esClient = require(__DIR__.'/../config/bootstrap.php');

echo "connecting to ES" . PHP_EOL;
$es = $esClient->getEsIndexer();

echo "fetching offers" . PHP_EOL;
$es->set_autocommit_size(10000);
$es->index();
