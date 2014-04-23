<?php
/**
 * Created by PhpStorm.
 * User: ufr_info
 * Date: 23/04/14
 * Time: 10:58
 */
require_once("ESSearch.php");

$search = new ESSearch();
$search->search("ipod");
$res = $search->retrieve_results();

echo $res;

?>