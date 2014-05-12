<?php

namespace igraal\elasticsearch;
require_once 'vendor/autoload.php';

class ESIndexer
{

    protected $params;
    protected $indexType;
    protected $autoCommit;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->autoCommit = 500;
        $config = array(
            'number_of_shards' => 40,
            'number_of_replicas' => 1,
            'analysis' => array(
                'analyzer' => array(
                    'indexAnalyzer' => array(
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => array('lowercase', 'mySnowball')
                    ),
                    'searchAnalyzer' => array(
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => array('standard', 'lowercase', 'mySnowball')
                    )
                ),
                'filter' => array(
                    'mySnowball' => array(
                        'type' => 'snowball',
                        'language' => 'French'
                    )
                )
            ),
            'similarity' => array(
                'index' => array('type' => "BM25"),
                'search' => array('type' => "BM25")
            )
        );


        try {
            $elasticaClient = new Elastica\Client($this->params);
            $elasticaIndex = $elasticaClient->getIndex('dev');

            if (!$elasticaIndex->exists()) {
                echo "Index exists";
                $elasticaIndex->create($config, true);
            }
            $this->indexType = $elasticaIndex->getType('offers');

            $mapping = new \Elastica\Type\Mapping();
            $mapping->setType($this->indexType);
            $mapping->setParam('index_analyzer', 'indexAnalyzer');
            $mapping->setParam('search_analyzer', 'searchAnalyzer');

            $mapping->send();


        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    private function process_row($row)
    {


    }

    public function set_autocommit_size($size)
    {
        $this->autoCommit = $size;
    }

    function index()
    {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $pdo = new PDO("mysql:host=localhost;dbname=products_fr", 'root', 'root', $options);
        $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

        $result = $pdo->query(
            "SELECT id,title,description,categoryId,brandId,merchantId FROM OFFERS WHERE title LIKE '%iphone%'"
        );

        if ($result) {
            $count = 0;
            $now = microtime(true);
            try {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $description = $row['description'];
                    // echo $description;
                    $offer = array(
                        'title' => $row['title'],
                        'description' => $description,
                        'categoryId' => $row['categoryId'],
                        'brandId' => $row['brandId'],
                        'merchantId' => $row['merchantId']
                    );

                    $doc[] = new Elastica\Document($row['id'], $offer);

                    $count++;
                    if ($count % $this->autoCommit == 0) {

                        $this->indexType->addDocuments($doc);
                        $this->indexType->getIndex()->refresh();
                        $time_end = microtime(true);
                        $time = microtime(true) - $now;
                        $now = microtime(true);

                        echo $count . " rows processed in " . $time . " sec" . PHP_EOL;
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage() . PHP_EOL;
            }

            function index()
            {
                $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                $pdo = new PDO("mysql:host=localhost;dbname=products_fr", 'root', 'root', $options);
                $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                $result = $pdo->query("SELECT id,title,description,categoryId,brandId,merchantId FROM OFFERS");

                if ($result) {
                    $count = 0;
                    $now = microtime(true);
                    try {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $description = $row['description'];
                            // echo $description;
                            $offer = array(
                                'title' => $row['title'],
                                'description' => $description,
                                'categoryId' => $row['categoryId'],
                                'brandId' => $row['brandId'],
                                'merchantId' => $row['merchantId']
                            );

                            $doc[] = new Elastica\Document($row['id'], $offer);

                            $count++;
                            if ($count % $this->autoCommit == 0) {

                                $this->indexType->addDocuments($doc);
                                $this->indexType->getIndex()->refresh();
                                $time_end = microtime(true);
                                $time = microtime(true) - $now;
                                $now = microtime(true);

                                echo $count . " rows processed in " . $time . " sec" . PHP_EOL;
                            }
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage() . PHP_EOL;
                    }
                }
            }
        }
    }
}