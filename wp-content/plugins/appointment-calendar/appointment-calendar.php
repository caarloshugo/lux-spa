<?php
/*
	# Plugin Name: Appointment Calendar
	# Version: 2.6.1
	# Description: Easily accept and manage appointments on your wordpress site. 
	# Author: Scientech It Solution
	# Author URI: http://www.appointzilla.com
	# Plugin URI: /plugins/appointment_calendar.zip

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 3 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
*/


/**
 *	Run 'Install' script on plugin activation
 *******************************************/
register_activation_hook( __FILE__, 'InstallScript' );
function InstallScript()
{
	include('install-script.php');
}


/**
 *	Admin dashboard Menu Pages For Booking Calendar Plugin
 **********************************************************/
add_action('admin_menu','appointment_calendar_menu');

function appointment_calendar_menu() 
{	
	//syntax: add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	//syntax: add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	
	//create new top-level menu 'appointment-calendar'
	$menu = add_menu_page('Appointment Calendar', 'Appointment Calendar', 'administrator', 'appointment-calendar');


	// Calendar Page
	$submenu1 = add_submenu_page( 'appointment-calendar', 'Appointment Calendar', 'Appointment Calendar', 'administrator', 'appointment-calendar', 'dispaly_calendar_page' );
	// Time sloat Page
	$submenu2 = add_submenu_page( 'appointment-calendar', 'Manage Time Sloat', '', 'administrator', 'time_sloat', 'dispaly_time_sloat_page' );
	// Data Save Page
	$submenu3 = add_submenu_page( 'appointment-calendar', 'Data Save', '', 'administrator', 'data_save', 'dispaly_datasave_page' );
	
	
	// Service Page
	$submenu4 =  add_submenu_page( 'appointment-calendar', 'Service', 'Service', 'administrator', 'service', 'dispaly_service_page' );
	// manage Service Page
	$submenu5 = add_submenu_page( 'appointment-calendar', 'Manage Service', '', 'administrator', 'manage-service', 'dispaly_manageservice_page' );
	
	
	// Time-Off Page
	$submenu6 = add_submenu_page( 'appointment-calendar', 'Time Off', 'Time Off', 'administrator', 'timeoff', 'dispaly_timeoff_page' );
	// Update Time-Off Page
	$submenu7 = add_submenu_page( 'appointment-calendar', 'Update TimeOff', '', 'administrator', 'update-timeoff', 'dispaly_updatetimeoff_page' );
	
	
	// Manage Appointment Page
	$submenu8 = add_submenu_page( 'appointment-calendar', 'Manage Appointment', 'Manage Appointment', 'administrator', 'manage-appointments', 'dispaly_manageappointment_page' );
	// Update Appointments Page
	$submenu9 = add_submenu_page( 'appointment-calendar', 'Update Appointment', '', 'administrator', 'update-appointment', 'dispaly_updateappointment_page' );
	
	// Settings Page
	$submenu10 = add_submenu_page( 'appointment-calendar', 'Settings', 'Settings', 'administrator', 'settings', 'dispaly_settings_page' );
	// Manage Settings Page
	$submenu11 = add_submenu_page( 'appointment-calendar', 'Manage Settings', '', 'administrator', 'manage-settings', 'dispaly_managesettings_page' );
	
	
	// Email Settings Page
	$submenu12 = add_submenu_page( 'appointment-calendar', 'Notification Settings', 'Notification Settings', 'administrator', 'notificationsettings', 'dispaly_notificationsettings_page' );
	// Manage Email Settings Page
	$submenu13 = add_submenu_page( 'appointment-calendar', 'Manage Notification Settings', '', 'administrator', 'manage-notificationsettings', 'dispaly_managenotificationsettings_page' );
	
	// Remove Plugin
	$submenu14 = add_submenu_page( 'appointment-calendar', 'Remove Plugin', __('Remove Plugin', 'appointzilla'), 'administrator', 'uninstall-plugin', 'dispaly_uninstallplugin_page' );
	
	// Get Premium
	$submenu15 = add_submenu_page( 'appointment-calendar', 'Get Premium Version', 'Get Premium Version', 'administrator', 'get-premium', 'dispaly_getpremium_page' );
	
	// Help & Support
	$submenu16 = add_submenu_page( 'appointment-calendar', 'Help & Support', 'Help & Support', 'administrator', 'help-support', 'dispaly_helpnsupport_page' );
	
	add_action( 'admin_print_styles-' . $menu, 'calendar_css_js' );
	//calendar
	add_action( 'admin_print_styles-' . $submenu1, 'calendar_css_js' );
	add_action( 'admin_print_styles-' . $submenu2, 'calendar_css_js' );
	add_action( 'admin_print_styles-' . $submenu3, 'calendar_css_js' );
	//service
	add_action( 'admin_print_styles-' . $submenu4, 'otherpages_css_js' );
	add_action( 'admin_print_styles-' . $submenu5, 'otherpages_css_js' );
	//time-off
	add_action( 'admin_print_styles-' . $submenu6, 'otherpages_css_js' );
	add_action( 'admin_print_styles-' . $submenu7, 'otherpages_css_js' );
	//manage app
	add_action( 'admin_print_styles-' . $submenu8, 'otherpages_css_js' );
	add_action( 'admin_print_styles-' . $submenu9, 'otherpages_css_js' );
	//calendar settings
	add_action( 'admin_print_styles-' . $submenu10, 'otherpages_css_js' );
	//notification settings
	add_action( 'admin_print_styles-' . $submenu11, 'otherpages_css_js' );
	//manage notification settings
	add_action( 'admin_print_styles-' . $submenu12, 'otherpages_css_js' );
	//settings
	add_action( 'admin_print_styles-' . $submenu13, 'otherpages_css_js' );
	//remove plugin
	add_action( 'admin_print_styles-' . $submenu14, 'otherpages_css_js' );
	//Get Premium
	add_action( 'admin_print_styles-' . $submenu15, 'otherpages_css_js' );
	//help & support
    add_action( 'admin_print_styles-' . $submenu16, 'otherpages_css_js' );
	
}//end of menu function


function calendar_css_js()
{ 
	wp_register_script( 
		'jquery-custom', 
		plugins_url('menu-pages/fullcalendar-assets-new/js/jquery-ui-1.8.23.custom.min.js', __FILE__), 
		array('jquery'), 
		true 
	 ); 
	 
	wp_enqueue_script('full-calendar',plugins_url('/menu-pages/fullcalendar-assets-new/js/fullcalendar.min.js', __FILE__),array('jquery','jquery-custom'));
	wp_register_style('bootstrap-css',plugins_url('/bootstrap-assets/css/bootstrap.css', __FILE__));
	wp_enqueue_style('bootstrap-css');
	wp_enqueue_style('fullcalendar-css',plugins_url('/menu-pages/fullcalendar-assets-new/css/fullcalendar.css', __FILE__));
	wp_enqueue_style('datepicker-css',plugins_url('/menu-pages/datepicker-assets/css/jquery-ui-1.8.23.custom.css', __FILE__));
}

function otherpages_css_js()
{ 
	wp_register_style('bootstrap-css',plugins_url('/bootstrap-assets/css/bootstrap.css', __FILE__));
	wp_enqueue_style('bootstrap-css');
	wp_enqueue_style('datepicker-css',plugins_url('/menu-pages/datepicker-assets/css/jquery-ui-1.8.23.custom.css', __FILE__));
	wp_enqueue_script('tooltip',plugins_url('/bootstrap-assets/js/bootstrap-tooltip.js', __FILE__),array('jquery'));
	wp_enqueue_script('bootstrap-affix',plugins_url('/bootstrap-assets/js/bootstrap-affix.js', __FILE__));
	wp_enqueue_script('bootstrap-application',plugins_url('/bootstrap-assets/js/application.js', __FILE__));
}




function shortcode_detect()
{

    global $wp_query;	
    $posts = $wp_query->posts;
    $pattern = get_shortcode_regex();
    
    foreach ($posts as $post){
		if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
			&& array_key_exists( 2, $matches )
			&& in_array( 'APCAL_PC', $matches[2] ) || in_array( 'APCAL_MOBILE', $matches[2] ) || in_array( 'APCAL', $matches[2] ) )
			{
			  wp_register_script( 
				'jquery-custom', 
				plugins_url('menu-pages/fullcalendar-assets-new/js/jquery-ui-1.8.23.custom.min.js', __FILE__), 
				array('jquery'), 
				true 
			  ); 
				wp_enqueue_script('full-calendar',plugins_url('/menu-pages/fullcalendar-assets-new/js/fullcalendar.min.js', __FILE__),array('jquery','jquery-custom'));
				wp_enqueue_script('calendar',plugins_url('calendar/calendar.js', __FILE__));
				wp_enqueue_script('moment-min',plugins_url('calendar/moment.min.js', __FILE__));
				wp_enqueue_style('bootstrap-shortcode',plugins_url('/menu-pages/bootstrap-assets/css/shortcode-bootstrap.css', __FILE__));
				wp_enqueue_style('fullcalendar-css',plugins_url('/menu-pages/fullcalendar-assets-new/css/fullcalendar.css', __FILE__));
				wp_enqueue_style('datepicker-css',plugins_url('/menu-pages/datepicker-assets/css/jquery-ui-1.8.23.custom.css', __FILE__));
				//wp_enqueue_style('theme-style',plugins_url('/menu-pages/fullcalendar-assets-new/css/theme-fcc.css', __FILE__));
			    break;	
			}    
    }
}
add_action( 'wp', 'shortcode_detect' );

	
/**
 * Rendering All appointment-calendar Menu Page
 ***************************************/
  
 //calendar page
 function dispaly_calendar_page()
 {
	include('menu-pages/calendar.php');
 }
 //time slot page
 function dispaly_time_sloat_page()
 {
 	include("menu-pages/appointment-form2.php");
 
 }
 //appointment save page
 function dispaly_datasave_page()
 {
 	include("menu-pages/data_save.php");
 }
 
 
 //service page
 function dispaly_service_page()
 {
	include("menu-pages/service.php");
 }
 //manage service page
 function dispaly_manageservice_page()
 {
	include("menu-pages/manage-service.php");
 }


 
 
 //time-off page
 function dispaly_timeoff_page()
 {
	include("menu-pages/timeoff.php");
 }
 //update-time-off page
 function dispaly_updatetimeoff_page()
 {
	include("menu-pages/update-timeoff.php");
 }
 

 
 
 //manage-appointment page
 function dispaly_manageappointment_page()
 {
	include("menu-pages/manage-appointments.php");
 }
 function dispaly_updateappointment_page()
 {
	include("menu-pages/update-appointments.php");
 }

 
 
 
 //settings page
 function dispaly_settings_page()
 {
	include("menu-pages/settings.php");
 }
 //add/update settings page
 function dispaly_managesettings_page()
 {
	include("menu-pages/manage-settings.php");
 } 
 
  
 
 
  //email-settings page
 function dispaly_notificationsettings_page()
 {
	include("menu-pages/notification-settings.php");
 }
  //manage-emailsettings page
 function dispaly_managenotificationsettings_page()
 {
	include("menu-pages/manage-notificationsettings.php");
 }
 
 
 
 // Remove plugin
 function dispaly_uninstallplugin_page()
 {
 	include("uninstall-plugin.php");
 }
 
 //get-premium page
 function dispaly_getpremium_page()
 {
 	include("menu-pages/getpremium.php");
 }
 
 //help & support page
 function dispaly_helpnsupport_page()
 {
 	include("menu-pages/helpnsupport.php");
 }
 
 

/****
 * Including Calendar Short-Code Page
 ***************************************/
	include("appointment-calendar-shortcode.php");
	include("appointment-calendar-mobile.php");
	//include("appointment-calendar-mobile-new.php");
	
?>
