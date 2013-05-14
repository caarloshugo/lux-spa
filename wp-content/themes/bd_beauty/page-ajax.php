<?php

// User
include "class/user.php";
include "class/functions/string.php";

$User = new User();
$therapists  = $User->getTherapists();
$specialties = $User->getSpecialties();


if(isset($_GET["id_t"])) {
	echo "hello world";
} else {

}
