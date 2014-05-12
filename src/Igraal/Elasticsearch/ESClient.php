<?php

namespace Igraal\Elasticsearch;

class ESClient
{
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return \Igraal\Elasticsearch\ESIndexer
     */
    public function getEsIndexer()
    {
        return new ESIndexer($this->params);
    }

    /**
     * @return \Igraal\Elasticsearch\ESSearch
     */
    public function getEsSearch()
    {
        return new ESSearch($this->params);
    }


} 