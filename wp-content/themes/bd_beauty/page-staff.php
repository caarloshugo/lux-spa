<?php 
/* 
Template Name: Staff Profile
*/ 
?>


<?php 

// get warp    
$warp = Warp::getInstance();    

// load main template file    
echo $warp['template']->render('template');