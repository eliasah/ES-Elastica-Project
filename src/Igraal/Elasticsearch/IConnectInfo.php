<?php

interface IConnectInfo
{
    const HOST = "172.19.19.19";
    const DBNAME = "products_frs";
    const UNAME = "root";
    const PW = "root";

    public function doConnect();
}

?>