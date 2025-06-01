<?php

namespace database;

use mysqli;

class DBController
{
//db connection properties
protected $host='localhost';
protected $user='root';
protected $pass='rakuta77';
protected $dbname='shopee';

//connection property
public $con=null;
//call constructor
public function __construct(){
    $this->con=mysqli_connect($this->host,$this->user,$this->pass,$this->dbname);
    if($this->con->connect_error){
        echo "Failed to connect to MySQL: " . $this->con->connect_error;
    }

}
public function __destruct ()
{
$this->closeConnection();
}
//for mysql closing connection
protected function closeConnection()
{
if($this->con!=null){
    $this->con->close();
    $this->con=null;
}
}
}

