<?php

/* @var $esClient Igraal\Elasticsearch\ESClient */
$esClient = require(__DIR__.'/../config/bootstrap.php');

$search = $esClient->getEsSearch();
if (!empty($argv)) {
    $search->search($argv[1]);
    $res = $search->retrieve_results();
} else {
    echo "Missing Argument";
}
