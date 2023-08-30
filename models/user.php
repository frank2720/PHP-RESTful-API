<?php
class User{
	//properties
	private $conn;
	private $table='user_details';

	public $user_id;
	public $username;
	public $first_name;
	public $last_name;
	public $gender;

	//constructor that callsback the connection method

	function __construct($db){
		$this->conn=$db;
	}

	//method that selects all properties from the db

	function select_all(){

		$sql="SELECT * FROM ".$this->table;
		$stmt=$this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	//method that select a single propertie from the db
	function select_single(){

		$sql="SELECT * FROM ".$this->table." WHERE user_id=?";
		
		$stmt=$this->conn->prepare($sql);
		$stmt->bindParam(1,$this->user_id);
		$stmt->execute();
		
		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		$this->username=$row['username'];
		$this->first_name=$row['first_name'];
		$this->last_name=$row['last_name'];
		$this->gender=$row['gender'];
	}

	//Add a user

	function insert(){
		//create a query
		$sql="INSERT INTO ".$this->table." (username,first_name,last_name,gender) VALUES (?,?,?,?)";
		//prepare $sql query
		$stmt=$this->conn->prepare($sql);

		//cleaning data
		$this->username=htmlspecialchars(strip_tags($this->username));
		$this->first_name=htmlspecialchars(strip_tags($this->first_name));
		$this->last_name=htmlspecialchars(strip_tags($this->last_name));
		$this->gender=htmlspecialchars(strip_tags($this->gender));

		//bind the param of the query
		$stmt->bindParam(1,$this->username);
		$stmt->bindParam(2,$this->first_name);
		$stmt->bindParam(3,$this->last_name);
		$stmt->bindParam(4,$this->gender);

		//execute query $stmt

		if($stmt->execute()){
			return true;
		}else{
			printf("Error %s./n",$stmt->error);
			return false;
		}
	}
}
