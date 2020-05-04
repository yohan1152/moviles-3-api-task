<?php 

class db {
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPass = '';
    private $dbName = 'taskapp';

    public function conectionDB(){
        try{
            $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
            $dbConection = new PDO($mysqlConnect, $this->dbUser, $this->dbPass);
            $dbConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConection;
        }catch(PDOException $e){
            echo $e;
        }
    }
}