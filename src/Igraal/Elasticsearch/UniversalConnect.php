<?php

class UniversalConnect implements IConnectInfo
{

    private static $server = IConnectInfo::HOST;
    private static $currentDB = IConnectInfo::DBNAME;
    private static $user = IConnectInfo::UNAME;
    private static $pass = IConnectInfo::PW;
    private static $hookup = IConnectInfo::HOST;


    public function doConnect()
    {

        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );


        try {
            self::$hookup = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->currentDB .,$this->user, $this->pass, $options);

        } catch (Exception $e) {
            echo "Error : " . $e->getMessage() . '<br/>';
            echo "N° : " . $e->getCode();
        }
    }
}