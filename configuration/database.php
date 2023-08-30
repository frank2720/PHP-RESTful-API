<?php
class DB{
	//properties
	
    private $host='localhost';
    private $username='root';
    private $password='2720';
    private $db_name='myblog';
    private $conn;

    //methods

    function db_connect(){
        $this->conn=null;
    try {
	    $this->conn=new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
	    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $error) {
        echo 'connection failed: '.$error->getMessage();
    }
    return $this->conn;
    }
}
