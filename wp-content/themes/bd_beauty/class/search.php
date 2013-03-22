<?php

include "db/db.php";

class Search  {
	
	public function __construct() {
		include "config/database.php";
		
		$this->psql = new Db();
		$this->psql->connect($db);
		
		$this->query  = "select DISTINCT(match_folios2.id),producer,total,totalsurface,states.name as state, match_folios2.name[1] from match_folios2 join states on states.key=keystate where to_tsquery('";
		$this->query2 = "') @@ textsearch order by total desc limit ";
		
	}
	
	public function byName($name, $state, $limit = 50, $offset = 0) {
		if($state==0) {
			$query = $this->query . $name . $this->query2 . $limit . " offset " . $offset;
		} else {
			$query = $this->query . $name . "') @@ textsearch and keystate=" . $state . " order by total desc limit " . $limit . " offset " . $offset;
		}
		
		return $this->psql->query($query);
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
