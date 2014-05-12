<?php

namespace igraal\elasticsearch;
require_once 'vendor/autoload.php';


$search = new ESSearch(\igraal\elasticsearch\$global_params);
if (!empty($argv)) {
    $search->search($argv[1]);
    $res = $search->retrieve_results();
}
else echo "Missing Argument";

?>