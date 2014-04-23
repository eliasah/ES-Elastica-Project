<?php
require_once("ESIndexer.php");

echo "connecting to ES" . PHP_EOL;
$es = new ESIndexer();

echo "fetching offers" . PHP_EOL;
$es->set_autocommit_size(10000);
$es->index();

echo "DONE" . PHP_EOL;
?>