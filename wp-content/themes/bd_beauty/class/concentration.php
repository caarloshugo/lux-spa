<?php

include "db/db.php";

class Concentration  {
	
	public function __construct() {
		include "config/database.php";
		
		$this->psql = new Db();
		$this->psql->connect($db);
	}
	
	public function getStates($key = FALSE) {
		if($key) {
			$data = $this->psql->query("select  * from states where key=" . $key);
		} else {
			$data = $this->psql->query("select * from states");
		}
		
		return $data;
	}
	
	public function getState($key) {
		$data = $this->psql->query("select concentration_state2.*,states.name from concentration_state2 join states on states.key=keystate where keystate=" . $key);
		return $data[0];
	}
	
	public function getAllStates() {
		return $this->psql->query("select states.name, total[2] as total, total[4] as surface from concentration_state2 join states on keystate=states.key where keystate!=0 order by states.name asc");
	}
	
	public function getCSV($key) {
		$data   = $this->psql->query("select concentration_state2.*,states.name from concentration_state2 join states on states.key=keystate where keystate=" . $key);
		$result = $data[0];
		
		echo getStateString($key) . "<br/>";
		
		echo "concentration,1,".getArray($result["p1"],0).",".getArray($result["p1"],3).",".getArray($result["p1"],1) . "<br/>";
		echo "concentration,2,".getArray($result["p2"],0).",".getArray($result["p2"],3).",".getArray($result["p2"],1) . "<br/>";
		echo "concentration,3,".getArray($result["p3"],0).",".getArray($result["p3"],3).",".getArray($result["p3"],1) . "<br/>";
		echo "concentration,4,".getArray($result["p4"],0).",".getArray($result["p4"],3).",".getArray($result["p4"],1) . "<br/>";
		echo "concentration,5,".getArray($result["p5"],0).",".getArray($result["p5"],3).",".getArray($result["p5"],1) . "<br/>";
		echo "concentration,6,".getArray($result["p6"],0).",".getArray($result["p6"],3).",".getArray($result["p6"],1) . "<br/>";
		echo "concentration,7,".getArray($result["p7"],0).",".getArray($result["p7"],3).",".getArray($result["p7"],1) . "<br/>";
		echo "concentration,8,".getArray($result["p8"],0).",".getArray($result["p8"],3).",".getArray($result["p8"],1) . "<br/>";
		echo "concentration,9,".getArray($result["p9"],0).",".getArray($result["p9"],3).",".getArray($result["p9"],1) . "<br/>";
		echo "concentration,10,".getArray($result["p10"],0).",".getArray($result["p10"],3).",".getArray($result["p10"],1) . "<br/>";
		echo "concentration,11,".getArray($result["p11"],0).",".getArray($result["p11"],3).",".getArray($result["p11"],1) . "<br/>";
		echo "concentration,12,".getArray($result["p12"],0).",".getArray($result["p12"],3).",".getArray($result["p12"],1) . "<br/>";
		echo "concentration,13,".getArray($result["p13"],0).",".getArray($result["p13"],3).",".getArray($result["p13"],1) . "<br/>";
		echo "concentration,14,".getArray($result["p14"],0).",".getArray($result["p14"],3).",".getArray($result["p14"],1) . "<br/>";
		echo "concentration,15,".getArray($result["p15"],0).",".getArray($result["p15"],3).",".getArray($result["p15"],1) . "<br/>";
		echo "concentration,16,".getArray($result["p16"],0).",".getArray($result["p16"],3).",".getArray($result["p16"],1) . "<br/>";
		echo "concentration,17,".getArray($result["p17"],0).",".getArray($result["p17"],3).",".getArray($result["p17"],1) . "<br/>";
		echo "concentration,18,".getArray($result["p18"],0).",".getArray($result["p18"],3).",".getArray($result["p18"],1) . "<br/>";
		echo "concentration,19,".getArray($result["p19"],0).",".getArray($result["p19"],3).",".getArray($result["p19"],1) . "<br/>";
		echo "concentration,20,".getArray($result["p20"],0).",".getArray($result["p20"],3).",".getArray($result["p20"],1) . "<br/>";
		echo "concentration,80,".getArray($result["p80"],0).",".getArray($result["p80"],3).",".getArray($result["p80"],1) . "<br/>";
		
		echo "<br/><br/>";
	}
}
