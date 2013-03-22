<?php

include "db/db.php";

class Producer  {
	
	public function __construct() {
		include "config/database.php";
		
		$this->psql = new Db();
		$this->psql->connect($db);
		$this->query = "select match_folios2.*, states.name as state from match_folios2 join states on states.key=keystate ";
		
	}
	
	public function getByID($id) {
		$result = $this->psql->query($this->query . " where match_folios2.id=" . $id);
		
		return $result[0];
	}
	
	public function getTypeCrops($id) {
		return $this->psql->query("select * from crops where id in (SELECT DISTINCT unnest(crops) as crop from match_folios2  where id=" . $id . ")");
	}
	
	public function getMatchNames($id) {
		return $this->psql->query("SELECT DISTINCT unnest(name) as names from match_folios2 where id=" . $id);
	}
	
	public function getTotalYear($producer, $keystate, $year) {
		$query = "select sum(importe) from rpro_nac where ";
		$query .= "estado='" .$keystate ."' and ";
		$query .= "productor='" . $producer . "' and ";
		$query .= "ano='" . $year . "'";

		$result = $this->psql->query($query);
		
		return $result[0]["sum"];
	}
	
	public function getSurfaceYear($producer, $keystate, $year) {
		$query = "select sum(superficie) from rpro_nac where ";
		$query .= "estado='" .$keystate ."' and ";
		$query .= "productor='" . $producer . "' and ";
		$query .= "ano='" . $year . "'";

		$result = $this->psql->query($query);
		
		return $result[0]["sum"];
	}
}
