<?php
require_once("ESIndexer.php");
require_once("parameters.php");

echo "connecting to ES" . PHP_EOL;
$es = new ESIndexer($global_params);

echo "fetching offers" . PHP_EOL;
$es->set_autocommit_size(10000);
$es->index();

?>