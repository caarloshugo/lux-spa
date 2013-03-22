<?php

include "db/db.php";

class Ranking_Folios  {
	
	public function __construct() {
		include "config/database.php";
		
		$this->psql = new Db();
		$this->psql->connect($db);
		$this->query  = "select match_folios2.id, producer, match_folios2.name[1], total, totalsurface, keystate, states.name as state from match_folios2 join states on states.key=keystate order by total desc ";
		$this->query2 = "select match_folios2.id, producer, match_folios2.name[1], total, totalsurface, keystate, states.name as state from match_folios2 join states on states.key=keystate where keystate=";
		
	}
	
	public function top($state, $limit) {
		if($state!==0) {
			return $this->psql->query($this->query2 . $state . " order by total desc limit " . $limit);
		} else {
			return $this->psql->query($this->query . "limit " . $limit);
		}
	}
	
	public function all($state, $limit = 50, $offset = 0) {
		if($state!==0) {
			return $this->psql->query($this->query2 . $state . " order by total desc limit " . $limit . " offset " . $offset);
		} else {
			return $this->psql->query($this->query . "limit " . $limit . " offset " . $offset);
		}	
	}
	
	public function getTable($results, $offset = 1) {
		$table = '';
		
		foreach($results as $result) {
			$table .= '<tr>';
				$table .= '<td>'.$offset.'</td>'; 
				$table .= '<td><a href="/subsidios/productor/'.$result["id"].'">'.$result["producer"].'</a></td>';
				$table .= '<td>'.$result["name"].'</td>';
				$table .= '<td>'.$result["state"].'</td>';
				$table .= '<td class="surface">'.$result["totalsurface"].'</td>';
				$table .= '<td class="money">'.$result["total"].'</td>';
			$table .= '</tr>';
			
			$offset++;
		}
		
		return $table;
	}
}
