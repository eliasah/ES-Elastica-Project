<meta http-equiv="content-type" content="text/html;charset=utf-8"/>

<h2> Results :</h2>

<?php

ini_set("display_errors", "On");
$query = $_POST['query'];

/* @var $esClient Igraal\Elasticsearch\ESClient */
$esClient = require(__DIR__ . '/../config/bootstrap.php');
$search = $esClient->getEsSearch();

if (!empty($query)) {
    $search->search($query);
    $res = $search->retrieve_results();


} else {
    echo "Missing Argument";
}

?>