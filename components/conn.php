<?php

class Database{

	private $host="localhost";
	private $dbname="rushabhn_rushabhnovelty";
	private $username="rushabhn_novelty";
	private $password="-Vj%ZK;2novelcEH=";
	
	private $server = "mysql:host=localhost;dbname=rushabhn_rushabhnovelty";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);

	protected $con;

	public function open(){
		try{
			$this->con = new PDO($this->server, $this->username, $this->password, $this->options);
			return $this->con;
		}
		catch(PDOException $e){
			echo "There is some problem in connection:". $e->getMessage();
		}
	}

	public function close(){
		$this->con = null;
	}

}

$pdo = new Database();

?>