<?php get_header(); ?>


<?php
// Concentration
include "class/appointment.php";
include "class/functions/string.php";

$Appointment = new Appointment();
$records     = $Appointment->all();
?>

<?php get_footer(); ?>
