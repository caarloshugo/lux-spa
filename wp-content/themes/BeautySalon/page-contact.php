<?php 
/* 
Template Name: Contact Us
*/ 
?>


<?php 

// get warp    
$warp = Warp::getInstance();    

// load main template file    
echo $warp['template']->render('template');