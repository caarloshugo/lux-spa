<!---load bootstrap css----->
<link rel='stylesheet' type='text/css' href='<?php //echo plugins_url('menu-pages/bootstrap-assets/css/bootstrap.css', __FILE__); ?>' />

<?php
	/*
	 * Uninstall Appointment Calendar
	 ********************************/
if(isset($_POST['uninstallapcal']))
{
		global $wpdb;
	
		//drop ap_appointments table
	$table_appointments = $wpdb->prefix . "ap_appointments";
	$appointments = "DROP TABLE `$table_appointments`";
	$wpdb->query($appointments); 
	
	
	//drop ap_events table
	$table_events = $wpdb->prefix . "ap_events";
	$events = "DROP TABLE `$table_events`";
	$wpdb->query($events); 
	
	
	//drop ap_services table	
	$table_services = $wpdb->prefix . "ap_services";
	$services = "DROP TABLE `$table_services`";
	$wpdb->query($services); 
	
	
	//drop a service Category
	$table_service_category = $wpdb->prefix . "ap_service_category";
	$service_category = "DROP TABLE `$table_service_category`";
	$wpdb->query($service_category);
	
		
	//drop a calendar settings table
	$table_calendar_settings = $wpdb->prefix . "ap_calendar_settings";
	$calendar_settings = "DROP TABLE `$table_calendar_settings`";
	$wpdb->query($calendar_settings);


	//delete all default calendar options & settings
	delete_option('calendar_slot_time');
	delete_option('day_start_time');
	delete_option('day_end_time');
	delete_option('calendar_view');
	delete_option('calendar_start_day');
	delete_option('emailstatus');
	delete_option('emailtype');
	delete_option('emaildetails');
		
		
	// DEACTIVATE APPOINTMENT CALENDAR PLUGIN
	$plugin = "appointment-calendar/appointment-calendar.php";
	deactivate_plugins($plugin);
	?>
	<div class="alert" style="width:95%; margin-top:10px;">
		<p><strong><?php _e('Appointment Calendar Plugin has been successfully removed. It can be re-activated from the ', 'appointzilla'); ?><a href="plugins.php"><?php _e('Plugins Page', 'appointzilla'); ?></a></strong>.</p>
	</div>
	<?php
	return;
 }
?>

<?php
if(!isset($_POST['uninstallapcal']))
{
?>

<div style="background:#C3D9FF; margin-bottom:10px; padding-left:10px;">
  <h3><?php _e('Remove Plugin', 'appointzilla'); ?></h3> 
</div>

<div class="alert alert-error" style="width:95%;">
	<form method="post">
	<h3><?php _e('Remove Appointment Calendar Plugin', 'appointzilla'); ?></h3>
	<p><?php _e('This operation wiil delete all Appointment Calendar data & settings. If you continue, You will not be able to retrieve or restore your appointments entries.', 'appointzilla'); ?></p>
	<p><button id="uninstallapcal" type="submit" class="btn btn-danger" name="uninstallapcal" value="" onclick="return confirm('<?php _e('Warning! Appointment Calendar data & settings, including appointment entries will be deleted. This cannot be undone. OK to delete, CANCEL to stop', 'appointzilla'); ?>')" ><?php _e('REMOVE PLUGIN', 'appointzilla'); ?></button></p>
	</form>
</div>
<?php
}
?>