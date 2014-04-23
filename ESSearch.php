<?php

class ESSearch
{
    public function __construct()
    {

    }

    public function search()
    {
        // Define a Query . We want a string query .
        $elasticaQueryString = new \Elastica\Query\QueryString();

        //'And' or 'Or' default : 'Or'
        $elasticaQueryString->setDefaultOperator('AND');
        $elasticaQueryString->setQuery('sesam street');

        // Create the actual search object with some data.
        $elasticaQuery = new \Elastica\Query();
        $elasticaQuery->setQuery($elasticaQueryString);

        //Search on the index.
        $elasticaResultSet = $elasticaIndex->search($elasticaQuery);
    }

    public function retrieve_results()
    {
        $elasticaResults = $elasticaResultSet->getResults();
        $totalResults = $elasticaResultSet->getTotalHits();

        foreach ($elasticaResults as $elasticaResult) {
            var_dump($elasticaResult->getData());
        }
    }
} 