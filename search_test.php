<?php
/**
 * Created by PhpStorm.
 * User: ufr_info
 * Date: 23/04/14
 * Time: 10:58
 */
require_once("ESSearch.php");

echo $argv[1] or exit("Missing arguments");

$search = new ESSearch();
$search->search($argv[1]);
$res = $search->retrieve_results();

?>