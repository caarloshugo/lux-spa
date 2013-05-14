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
	
	public function login($email, $password) {
		$data = $this->psql->query("select * from users where email='".$email."' and password='". md5($password) ."'");
		
		return $data;
	}
	
	public function setAppointment($id_user, $id_therapist, $id_specialty, $id_hour, $date) {
		$date2 = date("Y-m-d", strtotime($date));
		
		$query =  "insert into appointments ";
		$query .= "(id_user,id_therapist,id_specialty,id_hour, day, day_str, status) values ";
		$query .= "(".$id_user.",".$id_therapist.",".$id_specialty.",".$id_hour.",";
		$query .= "CAST('".$date."' AS DATE), true)";
		
		die(var_dump($query));
		
		$data = $this->psql->query($query);
		
		return $data;
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
	
	public function getTherapistsBySpecialty($id) {
		$data = $this->psql->query("select * from therapist where id in (select id_therapist from threpaist_to_specialties where id_specialty=" . $id . ")");
		
		return $data;
	} 
	
	public function edit() {
		$data = $this->psql->query("select * from users");
		
		return $data;
	}
	
	public function get($id) {
		$data = $this->psql->query("select * from users");
		
		return $data;
	}
}
