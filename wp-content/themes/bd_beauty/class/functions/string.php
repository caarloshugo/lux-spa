<?php

function getState($string) {
	$states = array("aguascalientes","baja-california","baja-california-sur","campeche","chiapas","chihuahua","coahuila","colima","distrito-federal","durango","mexico","guanajuato","guerrero","hidalgo","jalisco","michoacan","morelos","nayarit","nuevo-leon","oaxaca","puebla","queretaro","quintana-roo","san-luis-potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas", "nacional");
	$keys   = array("1","2","3","4","7","8","5","6","9","10","15","11","12","13","14","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32", "0");
	$idkey  = array_search($string, $states);
	
	if($idkey === NULL or $idkey === FALSE) {
		return 0;
	}
	
	$key = $keys[$idkey];
	return $key;
}

function getStateString($key) {
	$states = array("aguascalientes","baja-california","baja-california-sur","campeche","chiapas","chihuahua","coahuila","colima","distrito-federal","durango","mexico","guanajuato","guerrero","hidalgo","jalisco","michoacan","morelos","nayarit","nuevo-leon","oaxaca","puebla","queretaro","quintana-roo","san-luis-potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas", "nacional");
	$keys   = array("1","2","3","4","7","8","5","6","9","10","15","11","12","13","14","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32", "0");
	$idkey  = array_search($key, $keys);
	
	if($idkey === NULL or $idkey === FALSE) {
		return FALSE;
	}
	
	$state = $states[$idkey];
	return $state;
}


function getArray($text, $pos = NULL) {
	$text = ltrim($text, "{");
	$text = rtrim($text, "}");
	$data = explode(",", $text);

	if($pos !== NULL) {
		return $data[$pos];
	} else {
		return $data;
	}
}

function getRoute($pos = false) {
	
	$route = explode("/", substr($_SERVER["REQUEST_URI"], 1));
	
	if($pos) {
		if(isset($route[$pos])) {
			return $route[$pos];
		} else {
			return false;
		}
	}
	
	return $route;
}
