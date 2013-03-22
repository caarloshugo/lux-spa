<?php

include "db/db.php";

class Concentration  {
	
	public function __construct() {
		include "config/database.php";
		
		$this->psql = new Db();
		$this->psql->connect($db);
	}
	
	public function all() {
		$data = $this->psql->query("select * from appointments");
		die(var_dump($data));
		return $data;
	}
}
