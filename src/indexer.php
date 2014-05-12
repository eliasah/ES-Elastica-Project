<?php

namespace igraal\elasticsearch;
require_once 'vendor/autoload.php';

echo "connecting to ES" . PHP_EOL;
$es = new ESIndexer(\igraal\elasticsearch\$global_params);

echo "fetching offers" . PHP_EOL;
$es->set_autocommit_size(10000);
$es->index();

?>