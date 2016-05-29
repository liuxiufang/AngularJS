<?php
define('HOST','localhost');
define('USER','root');
define('PWD','');
define('DBNAME','mydb');
require('../db/mysql.class.php');
class IndexController {

    public $mysql;

    public function __construct(){

        $this->mysql = db_mysql::getInstance();
    }
    public function index(){
        $sql ="select * from user "; //SQLÓï¾ä
        $data = $this->mysql->getAll($sql);
        $data = [
            'data' => $data,
        ];
        echo  json_encode($data,true);
    }
}
$index = new IndexController();
$index->index();