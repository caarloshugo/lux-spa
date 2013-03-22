<?php

include "db/db.php";

class Appointment {
	
	public function __construct() {
		include "config/database.php";
		
		$this->psql = new Db();
		$this->psql->connect($db);
	}
	
	public function all() {
		$data = $this->psql->query("select * from appointments");
		
		return $data;
	}
}
