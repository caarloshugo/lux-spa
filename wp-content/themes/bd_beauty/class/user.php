<?php

include "db/db.php";

class User {
	
	public function __construct() {
		include "config/database.php";
		
		$this->psql = new Db();
		$this->psql->connect($db);
	}
	
	public function all() {
		$data = $this->psql->query("select * from users");
		
		return $data;
	}
	
	public function add($name, $lastname, $email, $birthday, $sex, $telephone, $password) {
		$password = md5($password);
		
		if($sex==="0") {
			$sex="true"; // Masculino
		} else {
			$sex="false"; //Femenino
		}
		
		$query = "insert into users ";
		$query .="(name,lastname,password,birthday_varchar,sex,email,telephone,status,type) values ";
		$query .="('".$name."','".$lastname."','".$password."','".$birthday."',".$sex.",'".$email."',".$telephone.",true,true);";
		
		$data = $this->psql->query($query);
		
		return $data;
	}
	
	public function login() {
		
	}
	
	public function logout() {
		
	}
	
	public function getTherapists() {
		$data = $this->psql->query("select * from therapist");
		
		return $data;
	}
	
	public function getSpecialties() {
		$data = $this->psql->query("select * from specialties");
		
		return $data;
	}
	
	public function edit() {
		$data = $this->psql->query("insert into * from users");
		
		return $data;
	}
	
	public function get($id) {
		$data = $this->psql->query("insert into * from users");
		
		return $data;
	}
}
