<?php
require_once 'vendor/autoload.php';

class ESSearch
{
    protected $index;
    protected $client;
    protected $results;
    protected $resultSet;

    public function __construct()
    {
        $this->params = array();
        $this->params['host'] = 'localhost';
        $this->params['port'] = 9200;

        try {
            $this->client = new Elastica\Client($this->params);
            $this->index = $this->client->getIndex('products_fr');
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    public function search($query)
    {
        // Define a Query . We want a string query .
        $queryString = new \Elastica\Query\QueryString();

        //'And' or 'Or' default : 'Or'
        $queryString->setDefaultOperator('AND');
        $queryString->setFields(array('title','description'));
	$queryString->setQuery($query);
	
        //Search on the index.
        $this->resultSet = $this->index->search($queryString);
    }

    public function retrieve_results()
    {
        $this->results = $this->resultSet->getResults();
        $totalResults = $this->resultSet->getTotalHits();

        foreach ($this->results as $res) {
            var_dump($res);
        }
    }
} 