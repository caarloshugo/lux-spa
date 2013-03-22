<?php

add_shortcode( 'APCAL_MOBILE', 'appointment_calendar_shortcode_mobile' );

function appointment_calendar_shortcode_mobile()
{
	?>
	<p align='center'>
	<script>
	function gofornext()
	{
			
			var ServiceId = jQuery('#serviceid').val();
			var ServiceId = jQuery('#serviceid').val();
			var AppDate = jQuery('#appointmentdate').val();
			//var StartTime =  jQuery('#StartTime').val();
			var  ServiceDuration =  jQuery('#serviceduration').val();
			
			
			var StartTime = jQuery('input[name=start_time]:radio:checked').val();
			//alert(StartTime)
			
			if(!StartTime)
			{
				jQuery("#selecttimediv").after("<p align='center' style='float:left; text-align:center;' class='error'><strong>Select any time.</strong></p>");
				return false;  
			}
			
			var currenturl = jQuery(location).attr('href');
			var url = currenturl;
			document.getElementById('loading3').style.display = '';
			document.getElementById('user_info_button').style.display = 'none';
			
			var SecondData = "ServiceId=" + ServiceId + "&AppDate=" + AppDate + "&ServiceDuration=" + ServiceDuration + "&StartTime=" +StartTime  ;
			jQuery.ajax({
			dataType : 'html',
			type: 'GET',
			url : url,
			cache: false,
			data : SecondData,
			complete : function() {  },
			success: function(data) 
					{
						//alert(data);
						data = jQuery(data).find('div#user_info');
						//jQuery('#loading1').hide();
						jQuery('#timesloatbox').hide();
						jQuery('#user_info_page').show();
						jQuery('#user_info_page').html(data);
					}
			});
	}
	
	
</script>
	
	<?php
		//save appointment and email admin & client/customer
	if( isset($_POST['Client_Name']) && isset($_POST['Client_Email']) )
{
		global $wpdb;
		$name = $_POST['Client_Name'];
		$email = $_POST['Client_Email'];
		$phone = $_POST['Client_Phone'];
		$note = $_POST['Client_Note'];
		$appointmentdate= date("Y-m-d", strtotime($_POST['AppDate']));
		$serviceid = $_POST['ServiceId'];
		$serviceduration = $_POST['Service_Duration'];
		$start_time = $_POST['StartTime'];
			
		$start_time_timestamp = strtotime($start_time);
		//calculate end time according to service duration
		$calculate_time = strtotime("+$serviceduration minutes", $start_time_timestamp);
		$end_time =  date('h:i A', $calculate_time ); 

			
		$appointment_key = md5(date("F j, Y, g:i a"));
		$status = "pending";
		$appointment_by = "user";
			
		$table_name = $wpdb->prefix . "ap_appointments";
		$AddAppointment_sql ="INSERT INTO $table_name (
														`id` ,
														`name` ,
														`email` ,
														`service_id` ,
														`phone` ,
														`start_time` ,
														`end_time` ,
														`date` ,
														`note` ,
														`appointment_key` ,
														`status` ,
														`appointment_by`
													)
		VALUES (NULL , '$name', '$email', '$serviceid', '$phone', '$start_time', '$end_time', '$appointmentdate', '$note', '$appointment_key', '$status', '$appointment_by');";
			
			if($wpdb->query($AddAppointment_sql))
			{
				echo "<div class='alert alert-success'><strong>Thank you for scheduling appointment with us.<br>A confirmation mail will be forward to you soon after admin approval.</strong></div>";
				
				$MangeAppointmentUrl = site_url().'/wp-admin/admin.php?page=manage-appointments';
				$BlogUrl = site_url().'/wp-admin';
				$BlogName = get_bloginfo();
				
				$ServiceTable = $wpdb->prefix."ap_services";
				$ServiceData = $wpdb->get_row("SELECT * FROM `$ServiceTable` WHERE `id` = '$serviceid'", OBJECT);
			
				
				
				$subject_to_recipent = "$BlogName: Your Appointment Confirmation Mail.";
				$body_for_recipent = "<p>Dear <b>".ucwords($name).".</b></p>
					<p>Thank you for scheduling appointment with <strong>$BlogName</strong>.</p>
					Your Appointment Details As:<br>
					<hr>
					<strong>Appointment For:</strong> ".ucwords($ServiceData->name)." <br>
					<strong>Appointment Note:</strong> $note <br>
					<strong>Appointment Status:</strong> Pending <br>
					<strong>Appointment Date:</strong> $appointmentdate <br>
					<strong>Appointment Time:</strong> $start_time To $end_time <br>
					<strong>Appointment Key:</strong> $appointment_key <br>
					<hr>
					<p>You will get a confirmation mail once admin accepts the appointment.</p>
					<p>Thank You!!!</p>
					";
					
				$subject_to_admin = "$BlogName: One New Appointment Has Been Arrived.";
				$body_for_admin = "Dear <b>Admin</b>,<br>
					<p>One New Appointment Scheduled By '<strong>".ucwords($name)."'</strong>.</p>
					<p>Appointment Details As:</p>
					<hr>
					<strong>Appointment By:</strong> ".ucwords($name)." <br>
					<strong>Appointment For:</strong> ".ucwords($ServiceData->name)." <br>
					<strong>Appointment Status:</strong> Pending <br>
					<strong>Appointment Date:</strong> $appointmentdate <br>
					<strong>Appointment Time:</strong> $start_time To $end_time <br>
					<strong>Appointment Note:</strong> $note <br>
					<strong>Appointment Key:</strong> $appointment_key <br>
					<strong>Take Action:</strong>
					<a href='$MangeAppointmentUrl' target=_blank>Approve Appointment</a> OR 
					<a href='$MangeAppointmentUrl' target=_blank>Cancel Appointment</a> <br>
					<hr>
					Login to manage appointment at $BlogName dashboard: <a href='$BlogUrl' target='_blank'>Login</a>
					<p>Thank You!!!</p>
					";
				$AdminEmailDetails = unserialize(get_option('emaildetails'));
				$recipent_email = $email;
				
				//send notification & chech mail type
				if(get_option('emailtype') == 'wpmail')
				{
					$wpmail_body_for_recipent = "
					Dear ".ucwords($name).",
					Thank you for scheduling appointment with $BlogName.

					Your Appointment Details As:
					Appointment For: ".ucwords($ServiceData->name)."
					Appointment Note: $note
					Appointment Status: Pending
					Appointment Date: $appointmentdate
					Appointment Time: $start_time To $end_time
					Appointment Key: $appointment_key
					
					Your appointment will be appove by admin. And approval mail will be sent to you soon.
					Thank You!!!
					";
					
					$wpmail_body_for_admin = "
					Dear Admin,
					One New Appointment Scheduled By '".ucwords($name)."'.
					
					Appointment Details As:
					Appointment By: ".ucwords($name)."
					Appointment For: ".ucwords($ServiceData->name)."
					Appointment Status: Pending
					Appointment Date: $appointmentdate
					Appointment Time: $start_time To $end_time
					Appointment Note: $note
					Appointment Key: $appointment_key
					Take Action:
					Approve Appointment: $MangeAppointmentUrl
					OR 
					Cancel Appointment: $MangeAppointmentUrl
					
					Login to manage appointment at $BlogName dashboard: $BlogUrl
					Thank You!!!
					";
					$admin_email = $AdminEmailDetails['wpemail'];
					$headers[] = "From: Admin <$admin_email>";
					//recipent mail
					wp_mail( $recipent_email, $subject_to_recipent, $wpmail_body_for_recipent, $headers, $attachments = '' );
					// admin mail
					wp_mail( $admin_email, $subject_to_admin, $wpmail_body_for_admin, $headers, $attachments = '' );
				}
				
				if(get_option('emailtype') == 'phpmail')
				{
					$phpmail_body_for_recipent = "
					Dear ".ucwords($name).",
					Thank you for scheduling appointment with $BlogName.

					Your Appointment Details As:
					Appointment For: ".ucwords($ServiceData->name)."
					Appointment Note: $note
					Appointment Status: Pending
					Appointment Date: $appointmentdate
					Appointment Time: $start_time To $end_time
					Appointment Key: $appointment_key
					
					Your appointment will be appove by admin. And approval mail will be sent to you soon.
					Thank You!!!
					";
					
					$phpmail_body_for_admin = "
					Dear Admin,
					One New Appointment Scheduled By '".ucwords($name)."'.
					
					Appointment Details As:
					Appointment By: ".ucwords($name)."
					Appointment For: ".ucwords($ServiceData->name)."
					Appointment Status: Pending
					Appointment Date: $appointmentdate
					Appointment Time: $start_time To $end_time
					Appointment Note: $note
					Appointment Key: $appointment_key
					Take Action:
					Approve Appointment: $MangeAppointmentUrl
					OR 
					Cancel Appointment: $MangeAppointmentUrl
					
					Login to manage appointment at $BlogName dashboard: $BlogUrl
					Thank You!!!
					";
					
					$admin_email = $AdminEmailDetails['phpemail'];
					$headers = "From: Admin <$admin_email>" .
					//client mail
					mail($recipent_email, $subject_to_recipent, $phpmail_body_for_recipent, $headers);
					// admin mail
					mail( $admin_email, $subject_to_admin, $phpmail_body_for_admin, $headers);
				}
				
				if(get_option('emailtype') == 'smtp')
				{
					$admin_email = $AdminEmailDetails['smtpemail'];
					include('menu-pages/notification/Email.php');
					$admin_email 	= $AdminEmailDetails['smtpemail'];
					$hostname 		= $AdminEmailDetails['hostname'];
					$portno 		= $AdminEmailDetails['portno'];
					$smtpemail 		= $AdminEmailDetails['smtpemail'];
					$password 		= $AdminEmailDetails['password'];
					$recipent_email = $email;
					
					$Email = new Email;
					$Email->notifyadmin($hostname, $portno, $smtpemail, $password, $admin_email, $subject_to_admin, $body_for_admin, $BlogName);
					$Email->notifyclient($hostname, $portno, $smtpemail, $password, $admin_email, $recipent_email, $subject_to_recipent, $body_for_recipent, $BlogName);
				}
			}
		?>
		
		<?php	
	}
	?>
	
	
<script type='text/javascript'>

jQuery(document).ready(function() {
	
		
<!------------- Modal Form Works -------------------->
		//show frist modal
		jQuery('#addappointment').click(function(){
			jQuery('#AppFirstModal').show();
			jQuery('#calendar').hide();
			jQuery('#addappointment').hide();
		});
		//hide modal
		jQuery('#close').click(function(){
			jQuery('#AppFirstModal').hide();
		});
		
		
		<!----load date picekr on modal for---->
		//document.addnewappointment.appdate.value = jQuery.datepicker.formatDate('dd-mm-yy', new Date());
		
		<!---AppFirstModal Validation---->
		jQuery('#next1').click(function(){
			jQuery(".error").hide();
			if(jQuery('#service').val() == 0)
			{
				jQuery("#service").after('<span class="error"><br><strong>Select Any Service.</strong><br></span>');
				return false;
			}
			var ServiceId =  jQuery('#service').val();
			var AppDate =  jQuery('#appdate').val();
			var SecondData = "ServiceId=" + ServiceId + "&AppDate=" + AppDate;
			var currenturl = jQuery(location).attr('href');
			var url = currenturl;
			
			jQuery('#loading1').show();	// loading button onclick next1 at first modal
			jQuery('#next1').hide();	//hide next button

			jQuery.ajax({
			dataType : 'html',
			type: 'GET',
			url : url,
			cache: false,
			data : SecondData,
			complete : function() {  },
			success: function(data) 
					{
						data = jQuery(data).find('div#AppSecondModal');
						jQuery('#loading1').hide();
						jQuery('#AppFirstModal').hide();
						jQuery('#AppSecondModalDiv').show();
						jQuery('#AppSecondModalDiv').html(data);
					}
			});
	});
		
		<!-------Second Modal form validation--------------->
		jQuery('#booknowapp').click(function(){
			jQuery(".error").hide();

			
			if( !jQuery('#clientname').val() )
			{
				jQuery("#clientname").after('<span class="error"><br><strong>This field required.</strong></span>');
				return false;
			}
			else if(!isNaN( jQuery('#clientname').val() )) 
			{
				jQuery("#clientname").after("<span class='error'><p><strong>Invalid field value.</strong></p></span>");
				return false;  
			}
			
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if( !jQuery('#clientemail').val() )
			{
				jQuery("#clientemail").after('<span class="error"><br><strong>This field required.</strong></span>');
				return false;
			}
			else
			{	if(regex.test(jQuery('#clientemail').val()) == false )
				{	
					jQuery("#clientemail").after("<span class='error'><p><strong>Invalid field value.</strong></p></span>");  
					return false; 
				}
			}	

			if( !jQuery('#clientphone').val() )
			{
				jQuery("#clientphone").after('<span class="error"><br><strong>This field required.</strong></span>');
				return false;
			}
			else if(isNaN( jQuery('#clientphone').val() )) 
			{
				jQuery("#clientphone").after("<span class='error'><p><strong>Invalid field value.</strong></p></span>");
				return false;  
			}
		});
		
		//back button show first modal
		jQuery('#back').click(function(){
			jQuery('#AppFirstModal').show();
			jQuery('#AppSecondModal').hide();
		});
		
		
			
});	

		

<!------------- Modal Form Works -------------------->
function Backbutton()
{
	jQuery('#AppFirstModal').show();
	jQuery('#AppSecondModalDiv').hide();
	jQuery('#next1').show();
	jQuery('#loading1').hide();
}

function checkvalidation()
{	
	jQuery(".error").hide();

	var start_time = jQuery('input[name=start_time]:radio:checked').val();
	if(!start_time)
	{
		jQuery("#selecttimediv").after("<br><p style='width:350px; padding:2px;' class='error'><strong>Select any time.</strong></p>");
		return false;  
	}
	
	if( !jQuery('#clientname').val() )
	{
		jQuery("#clientname").after('<span class="error"><br><strong>This field required.</strong></span>');
		return false;
	}
	else if(!isNaN( jQuery('#clientname').val() )) 
	{
		jQuery("#clientname").after("<span class='error'><p><strong>Invalid field value.</strong></p></span>");
		return false;  
	}
	
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if( !jQuery('#clientemail').val() )
	{
		jQuery("#clientemail").after('<span class="error"><br><strong>This field required.</strong></span>');
		return false;
	}
	else
	{	if(regex.test(jQuery('#clientemail').val()) == false )
		{	
			jQuery("#clientemail").after("<span class='error'><p><strong>Invalid field value.</strong></p></span>");  
			return false; 
		}
	}	

	if( !jQuery('#clientphone').val() )
	{
		jQuery("#clientphone").after('<span class="error"><br><strong>This field required.</strong></span>');
		return false;
	}
	else if(isNaN( jQuery('#clientphone').val() )) 
	{
		jQuery("#clientphone").after("<span class='error'><p><strong>Invalid field value.</strong></p></span>");
		return false;  
	}
		  
	var ServiceId = jQuery('#serviceid').val();
	var AppDate = jQuery('#appointmentdate').val();
	//var StartTime =  jQuery('#StartTime').val();
	var  ServiceDuration =  jQuery('#serviceduration').val();
	
	var StartTime = jQuery('input[name=start_time]:radio:checked').val();

	var Client_Name =  jQuery('#clientname').val();
	var Client_Email =  jQuery('#clientemail').val();
	var Client_Phone =  jQuery('#clientphone').val();
	var Client_Note =  jQuery('#clientnote').val();
	var currenturl = jQuery(location).attr('href');
	  
	var SecondData = "ServiceId=" + ServiceId + "&AppDate=" + AppDate + "&StartTime=" + StartTime + '&Client_Name=' + Client_Name +'&Client_Email=' + Client_Email +'&Client_Phone=' + Client_Phone +'&Client_Note=' + Client_Note+'&Service_Duration=' + ServiceDuration; 
	var currenturl = jQuery(location).attr('href');
	var url = currenturl;
	jQuery('#loading2').show();		// loading button onclick next1 at first modal
	jQuery('#buttonbox').hide();	// loading button onclick book now at first modal
	
	jQuery.ajax({
		dataType : 'html',
		type: 'POST',
		url : url,
		cache: false,
		data : SecondData, 
		complete : function() {  },
		success: function() 
				{	
					jQuery('#AppSecondModalDiv').hide();
					jQuery('#AppThirdModalDiv').show();
				}
	});
		
}
		

	</script>
	
	<style type='text/css'>
	.error{ 
		color: #FF0000; 
	}
	</style>

	
	<!----- Add New Appointment Button -------->
	<div id="bkbtndiv" align="center" style="padding:5px;">
		<button name="addappointment" class="btn btn-primary" type="submit" id="addappointment">
		<?php 
			if($AllCalendarSettings['booking_button_text']) 
				echo $AllCalendarSettings['booking_button_text']; 
			else echo _e("Shedule New Appointment"); 
		?>
		</button>
	</div>
	
	<!---------Show appointment calendar ------------>
	<div id='calendar' style="width:100%;display:none;">
			<div align="right">Appointment Calendar Powered By: <a href="http://appointzilla.com/" title="Appointment Scheduling plugin for Wordpress" target="_blank">AppointZilla</a></div>
			<!--------AppSecondModal For Schedule New Appointment-->
			
			<!--------AppSecondModal For Schedule New Appointment End-->
	</div>
	
	<div id="AppSecondModalDiv" style="display:none;"></div>
	<div id="AppThirdModalDiv" style="display:none;">
	<div class="alert alert-info">
		Thank you for scheduling appointment with us. A confirmation mail will be forward to you soon after admin approval.<br/>
		<br/><a href="" onclick="javascript: location.reload()">Click here </a> to book another appointment.<br/>
		<div align="right">Appointment Calendar Powered By: <a href="http://appointzilla.com/" title="Appointment Scheduling plugin for Wordpress" target="_blank">AppointZilla</a></div>
	</div>
	</div>
	
	<!--------AppFirstModal For Schedule New Appointment-->
	<div id="AppFirstModal" style="display:none">
		<div id="myModal" style="z-index:99999;">
			<form action="" method="post" name="addnewappointment" id="addnewappointment" >
				<div >
					<div class="alert alert-info">
						<div align="center"></div>
						<h4 align="center" >Schedule New Appointment</h4>
						<div align="center">Setect Time & Service</div>
					</div>
				</div>
				
				<div class="modal-body">
					<div id="firdiv" style="float:left;">
					<!--		<div id="datepicker"></div> -->
				 <!--PHP Datepicker Test -->
				
				 <form id="form1" name="form1" method="post" action="">
				 <?php
					include_once('calendar/tc_calendar.php');
					$curr_date = date("Y-m-d", time());
					$datepicker2=plugins_url('calendar/', __FILE__);
					$myCalendar = new tc_calendar("date1");
					$myCalendar->setIcon($datepicker2."images/iconCalendar.gif");
				    $myCalendar->setDate(date("d"), date("m"), date("Y"));
				    $myCalendar->setPath($datepicker2);
				    $myCalendar->setYearInterval(2035,date('Y'));
				    $myCalendar->dateAllow($curr_date, "2035-03-01", false);
					$myCalendar->setOnChange("myChanged()");
				    $myCalendar->writeScript();
			  ?>
			  </form>
	   
			  <script language="javascript">
				  function myChanged()
				  {
					var x = document.getElementById('date1').value;
					x = moment(x).format('DD-MM-YYYY');
					document.getElementById('appdate').value = x;
				  }
			  </script>
					</div>
					
					<div id="secdiv" style="float:right;" >
						<h5><strong>Your Appointment Date:</strong></h5>
						<input name="appdate" id="appdate" type="text" readonly="" height="30px;" value="<?php echo date('d-m-Y');?>" style="height:30px;" />
					<?php
						global $wpdb;
						$ServiceTable = $wpdb->prefix."ap_services";
						$findservice_sql = "SELECT * FROM `$ServiceTable` WHERE `availability` = 'yes'";
						$AllService = $wpdb->get_results($findservice_sql, OBJECT);
					?><br><br>
						  <h5><strong>Select Service:</strong></h5>
							<select name="service" id="service">
								<option value="0">Select Service</option>
								<?php
								foreach($AllService as $Service)
									echo "<option value='$Service->id'>".ucwords($Service->name)." (".$Service->duration."min/$$Service->cost)</option>";
								?>
							</select>
						<br>
						<button name="next1" class="btn btn-primary" type="button" id="next1" value="next1">Next &rarr;</button>
						<div id="loading1" style="display:none;"><?php _e('Loading...', 'appointzilla'); ?><img src="<?php echo plugins_url()."/appointment-calendar/images/loading.gif"; ?>" /></div>
					</div>
				</div>
			
			</form>
		  </div>
	</div>
	<!--------AppSecondModal For Schedule New Appointment-->
	

<!--date-picker js -->
<script src="<?php echo plugins_url('/menu-pages/datepicker-assets/js/jquery.ui.datepicker.js', __FILE__); ?>" type="text/javascript"></script>
	
<?php
	if( isset($_GET['ServiceId']) && isset($_GET['AppDate']))
	{
	?>
	<div id="AppSecondModal">
	<div > 
		<form method="post" name="appointment-form2" id="appointment-form2" action="" onsubmit="checkvalidation()">
		<div class="modal-info">
		  <div class="alert alert-info">
			
				<h4 align="center">Schedule New Appointment</h4>
				<div align="center">Setect Time & Fill Up Form </div>
			</div>
		</div>

		<div >
			<div id="timesloatbox" class="alert alert-block" style="float:left; height:auto; width:90%;">
			<!-------slots time calulation-------->
			<?php
				/*
				 * time-slots calculation
				 *************************/
					global $wpdb;
					$ServiceId =  $_GET['ServiceId']; 
					$ServiceTableName = $wpdb->prefix."ap_services";
					$FindService_sql = "SELECT `name`, `duration` FROM `$ServiceTableName` WHERE `id` = '$ServiceId'";	
					$ServiceData = $wpdb->get_row($FindService_sql, OBJECT);
					$ServiceDuration = $ServiceData->duration;
					
					$AppointmentDate = date("Y-m-d", strtotime($_GET['AppDate'])); //assign selected date by user	
					$AllCalendarSettings = unserialize(get_option('apcal_calendar_settings'));
					$Biz_start_time = $AllCalendarSettings['day_start_time'];
					$Biz_end_time = $AllCalendarSettings['day_end_time'];
					$UserDefineTimeSlot = $AllCalendarSettings['apcal_booking_time_slot'];
					
					$AllSlotTimesList = array();
					
					$AppPreviousTimes = array();
					$AppNextTimes = array();
					$AppBetweenTimes = array();
					$EventPreviousTimes = array();
					$EventBetweenTimes = array();
					$DisableSlotsTimes = array();
					$BusinessEndCheck =array();
					$AllSlotTimesList_User = array();
					$TodaysAllDayEvent = 0;
					
					$TimeOffTableName = $wpdb->prefix."ap_events";
					//if today is any allday timeoff then show msg no time avilable today
					$TodaysAllDayFetchEvents_sql = "SELECT `start_time`, `end_time`, `repeat`, `start_date`, `end_date` FROM `$TimeOffTableName` WHERE date('$AppointmentDate') between `start_date` AND `end_date` AND `allday` = '1'";
					
					$TodaysAllDayEventData = $wpdb->get_results($TodaysAllDayFetchEvents_sql, OBJECT);
					
					//check if appointment date in any recurring timeoff date
					foreach($TodaysAllDayEventData as $SingleTimeOff)
					{
						// none check
						if($SingleTimeOff->repeat == 'N')
						{
							$TodaysAllDayEvent = 1;
						}
						
						// daily check
						if($SingleTimeOff->repeat == 'D')
						{
							$TodaysAllDayEvent = 1;
						}
						
						// weekly check
						if($SingleTimeOff->repeat == 'W')
						{
							$EventStartDate = $SingleTimeOff->start_date;
							$diff = ( strtotime($EventStartDate) - strtotime($AppointmentDate)  )/60/60/24; 
							if(($diff % 7) == 0)
							{
								$TodaysAllDayEvent = 1;
							}
						}
						
						//bi-weekly check
						if($SingleTimeOff->repeat == 'BW')
						{
							$EventStartDate = $SingleTimeOff->start_date;
							$diff = ( strtotime($EventStartDate) - strtotime($AppointmentDate)  )/60/60/24; 
							if(($diff % 14) == 0)
							{
								$TodaysAllDayEvent = 1;
							}
						}
						
						//monthly check
						if($SingleTimeOff->repeat == 'M')
						{
							// calculate all monthly dates
							$EventStartDate = $SingleTimeOff->start_date;
							$EventEndDate = $SingleTimeOff->end_date;
							$i = 0; 
							do {
									$NextDate = date("Y-m-d", strtotime("+$i months", strtotime($EventStartDate)));
									$AllEventMonthlyDates[] = $NextDate;
									$i = $i+1;
							} while(strtotime($EventEndDate) != strtotime($NextDate));
							
							//check appointmentdate in $AllEventMonthlyDates
							if(in_array($AppointmentDate, $AllEventMonthlyDates))
							{
								$TodaysAllDayEvent = 1;
							}
						}
					}//end of event fetching forech
					

					if($TodaysAllDayEvent)
					{	
						echo "<div class='alert alert-error'>Sorry! No time available today.</div>";
						echo '<a class="btn btn-primary" id="back" onclick="Backbutton()">&larr; Back</a>';
					}
					else
					{
						echo "<div class='alert alert-info'>Available Time For <strong>'$ServiceData->name'</strong> On <strong>'".date("l, jS M.", strtotime($AppointmentDate))."'</strong></div>";
						
						//Caluculate all time slots according to today's biz hours
						$start = strtotime($Biz_start_time);
						$end = strtotime($Biz_end_time);
						 
						if($UserDefineTimeSlot)
						{
							$UserTimeSlot = $UserDefineTimeSlot;
						}else
						{
							$UserTimeSlot = 30;
						}
						for( $i = $start; $i < $end; $i += (60*$UserTimeSlot)) 
						{
							$AllSlotTimesList_User[] = date('h:i A', $i);
						} 
						// Buniness end chek
						$Business_end = strtotime($Biz_end_time);
						$ServiceDuration_Biss= $ServiceDuration-5;
						$ServiceDuration_Biss = $ServiceDuration_Biss *60;
						$EndStartTime = $Business_end - $ServiceDuration_Biss;
						for( $i = $EndStartTime; $i < $Business_end; $i += (60*5)) 
						{
							$BusinessEndCheck[] = date('h:i A', $i);
						} 
						
						// Create Business Time slot for calculation 
						for( $i = $start; $i < $end; $i += (60*5)) 
						{	$AllSlotTimesList[] = date('h:i A', $i); } 
						
						//Fetch All today's appointments and calculate disable slots
						$AppointmentTableName = $wpdb->prefix."ap_appointments";
						$AllAppointments_sql = "SELECT `start_time`, `end_time` FROM `$AppointmentTableName` WHERE `date`= '$AppointmentDate'"; 
						
						$AllAppointmentsData = $wpdb->get_results($AllAppointments_sql, OBJECT);
						//print_r(count($AllAppointmentsData)); echo "<br>";
						
						if($AllAppointmentsData)
						{
							foreach($AllAppointmentsData as $Appointment)
							{
								
								
								$AppStartTimes[] = date('h:i A', strtotime( $Appointment->start_time ) );
								$AppEndTimes[] = date('h:i A', strtotime( $Appointment->end_time ) );
															
								//now calculate 5min slots between appointment's start_time & end_time
								$start_et = strtotime($Appointment->start_time);
								$end_et = strtotime($Appointment->end_time);
								for( $i = $start_et; $i < $end_et; $i += (60*(5))) //make 15-10=5min slot
								{
									$AppBetweenTimes[] = date('h:i A', $i);
								}
							}
								//print_r($AppBetweenTimes);
						
								//calculating  Next & Previous time of booked appointments
								foreach($AllSlotTimesList as $single)
								{
									//echo $single;
									if(in_array($single, $AppStartTimes))
									{
										//get next time
										$time = $single; 												
										$event_length = $ServiceDuration-5; 	// Service duration time	-  slot time							
										$timestamp = strtotime("$time"); 								
										$endtime = strtotime("+$event_length minutes", $timestamp); 	
										$next_time = date('h:i A', $endtime);				//echo "<br>";
										//calculate next time				
										$start = strtotime($single);
										$end = strtotime($next_time);
										for( $i = $start; $i <= $end; $i += (60*(5))) //making 5min diffrance slot
										{
											$AppNextTimes[] = date('h:i A', $i);
										}
										
										
										//calculate previous time
										$time1 = $single; 												
										$event_length1 = $ServiceDuration-5; 	// 60min Service duration time - 15 slot time 								
										$timestamp1 = strtotime("$time1"); 								
										$endtime1 = strtotime("-$event_length1 minutes", $timestamp1); 	
										$next_time1 = date('h:i A', $endtime1); 						

										$start1 = strtotime($next_time1);
										$end1 = strtotime($single);
										for( $i = $start1; $i <= $end1; $i += (60*(5))) //making 5min diff slot
										{
											$AppPreviousTimes[] = date('h:i A', $i);
										}
									}
								}
								//end calculating Next & Previous time of booked appointments
							//print_r($AllSlotTimesList);
							//print_r($AppPreviousTimes);
							//print_r($AppBetweenTimes);
							//print_r($AppNextTimes);
						} // end if $AllAppointmentsData
						
							
							//Fetch All today's timeoff and calculate disable slots
							$EventTableName = $wpdb->prefix."ap_events";
							$AllEventts_sql = "SELECT `start_time`, `end_time` FROM `$EventTableName` WHERE date('$AppointmentDate') between `start_date` AND `end_date` AND `allday` = '0' AND `repeat` != 'W' AND `repeat` != 'BW' AND `repeat` != 'M'";
							$AllEventsData = $wpdb->get_results($AllEventts_sql, OBJECT);
							if($AllEventsData)
							{
								foreach($AllEventsData as $Event)
								{
									//calculate previous time (event start time to back serviceduration-5)
									$minustime = $ServiceDuration - 5;
									$start = date('h:i A', strtotime("-$minustime minutes", strtotime($Event->start_time)));
									$start = strtotime($start);
									$end =  $Event->start_time;
									$end = strtotime($end);	
									for( $i = $start; $i <= $end; $i += (60*(5))) //making 5min diffrance slot
									{
										$EventPreviousTimes[] = date('h:i A', $i);
									}
									
									//calculating between time (start - end)
									$start_et = strtotime($Event->start_time);
									$end_et = strtotime($Event->end_time);
									for( $i = $start_et; $i < $end_et; $i += (60*(5))) //making 5min slot
									{
										$EventBetweenTimes[] = date('h:i A', $i);
									}
								}
							}
							
							
							
							//Fetch All 'WEEKLY' timeoff and calculate disable slots
							$EventTableName = $wpdb->prefix."ap_events";
							$AllEventts_sql = "SELECT `start_time`, `end_time`, `start_date`, `end_date` FROM `$EventTableName` WHERE date('$AppointmentDate') between `start_date` AND `end_date` AND `allday` = '0' AND `repeat` = 'W'";
							$AllEventsData = $wpdb->get_results($AllEventts_sql, OBJECT);
							if($AllEventsData)
							{
								foreach($AllEventsData as $Event)
								{
									//calculate all weekly dates between recurring_start_date - recurring_end_date
									$Current_Re_Start_Date = $Event->start_date;
									$Current_Re_End_Date = $Event->end_date;
									
									$Current_Re_Start_Date = strtotime($Current_Re_Start_Date);
									$Current_Re_End_Date = strtotime($Current_Re_End_Date);
									
									//make weekly dates
									for( $i = $Current_Re_Start_Date; $i <= $Current_Re_End_Date; $i += (60 * 60 * 24 * 7)) 
									{
										$AllEventWeelylyDates[] = date('Y-m-d', $i);
									}
									if(in_array($AppointmentDate, $AllEventWeelylyDates))
									{
										//calculate previous time (event start time to back serviceduration-5)
										$minustime = $ServiceDuration - 5;
										$start = date('h:i A', strtotime("-$minustime minutes", strtotime($Event->start_time)));
										$start = strtotime($start);
										$end =  $Event->start_time;
										$end = strtotime($end);	
										for( $i = $start; $i <= $end; $i += (60*(5))) //making 5min diffrance slot
										{
											$EventPreviousTimes[] = date('h:i A', $i);
										}
										
										//calculating between time (start - end)
										$start_et = strtotime($Event->start_time);
										$end_et = strtotime($Event->end_time);
										for( $i = $start_et; $i < $end_et; $i += (60*(5))) //making 5min slot
										{
											$EventBetweenTimes[] = date('h:i A', $i);
										}
									}
								}
							}
							
							
							//Fetch All 'BI-WEEKLY' timeoff and calculate disable slots
							$EventTableName = $wpdb->prefix."ap_events";
							$AllEventts_sql = "SELECT `start_time`, `end_time`, `start_date`, `end_date` FROM `$EventTableName` WHERE date('$AppointmentDate') between `start_date` AND `end_date` AND `allday` = '0' AND `repeat` = 'BW'";
							$AllEventsData = $wpdb->get_results($AllEventts_sql, OBJECT);
							if($AllEventsData)
							{ 
								foreach($AllEventsData as $Event)
								{
									//calculate all weekly dates between recurring_start_date - recurring_end_date
									$Current_Re_Start_Date = $Event->start_date;
									$Current_Re_End_Date = $Event->end_date;
									
									$Current_Re_Start_Date = strtotime($Current_Re_Start_Date);
									$Current_Re_End_Date = strtotime($Current_Re_End_Date);
									//make bi-weekly dates
									for( $i = $Current_Re_Start_Date; $i <= $Current_Re_End_Date; $i += (60 * 60 * 24 * 14)) 
									{
										$AllEventBiWeelylyDates[] = date('Y-m-d', $i);
									}
									if(in_array($AppointmentDate, $AllEventBiWeelylyDates))
									{
										//calculate previous time (event start time to back serviceduration-5)
										$minustime = $ServiceDuration - 5;
										$start = date('h:i A', strtotime("-$minustime minutes", strtotime($Event->start_time)));
										$start = strtotime($start);
										$end =  $Event->start_time;
										$end = strtotime($end);	
										for( $i = $start; $i <= $end; $i += (60*(5))) //making 5min diffrance slot
										{
											$EventPreviousTimes[] = date('h:i A', $i);
										}
										
										//calculating between time (start - end)
										$start_et = strtotime($Event->start_time);
										$end_et = strtotime($Event->end_time);
										for( $i = $start_et; $i < $end_et; $i += (60*(5))) //making 5min slot
										{
											$EventBetweenTimes[] = date('h:i A', $i);
										}
									}
								}
							}

							
							//Fetch All 'MONTHLY' timeoff and calculate disable slots
							$EventTableName = $wpdb->prefix."ap_events";
							$AllEventts_sql = "SELECT `start_time`, `end_time`, `start_date`, `end_date` FROM `$EventTableName` WHERE date('$AppointmentDate') between `start_date` AND `end_date` AND `allday` = '0' AND `repeat` = 'M'";
							$AllEventsData = $wpdb->get_results($AllEventts_sql, OBJECT);
							if($AllEventsData)
							{
								foreach($AllEventsData as $Event)
								{
									//calculate all weekly dates between recurring_start_date - recurring_end_date
									$Current_Re_Start_Date = $Event->start_date;
									$Current_Re_End_Date = $Event->end_date;
									
									$i = 0; 
									do {
											$NextDate = date("Y-m-d", strtotime("+$i months", strtotime($Current_Re_Start_Date)));
											$AllEventMonthlyDates[] = $NextDate;
											$i = $i+1;
									} while(strtotime($Current_Re_End_Date) != strtotime($NextDate));
									
									if(in_array($AppointmentDate, $AllEventMonthlyDates))
									{
										//calculate previous time (event start time to back serviceduration-5)
										$minustime = $ServiceDuration - 5;
										$start = date('h:i A', strtotime("-$minustime minutes", strtotime($Event->start_time)));
										$start = strtotime($start);
										$end =  $Event->start_time;
										$end = strtotime($end);	
										for( $i = $start; $i <= $end; $i += (60*(5))) //making 5min diffrance slot
										{
											$EventPreviousTimes[] = date('h:i A', $i);
										}
										
										//
										$start_et = strtotime($Event->start_time);
										$end_et = strtotime($Event->end_time);
										for( $i = $start_et; $i < $end_et; $i += (60*(5))) //making 5min slot
										{
											$EventBetweenTimes[] = date('h:i A', $i);
										}
									}
								}
							}
							
							$DisableSlotsTimes = array_merge($AppBetweenTimes, $AppPreviousTimes, $EventPreviousTimes, $EventBetweenTimes, $BusinessEndCheck);
							unset($AppBetweenTimes);
							unset($AppPreviousTimes);
							unset($AppNextTimes);
							unset($EventBetweenTimes);
							unset($BusinessEndCheck);
							
							foreach($AllSlotTimesList as $Single) // comaper All Business Time sloat with  with DisableSlotsTimes
							{
								if(in_array($Single, $DisableSlotsTimes))
								{	$Disable[] = $Single;	}
								else
								{ $Enable[] = $Single;	}
							}// end foreach
							
							foreach($AllSlotTimesList_User as $Single) // Show All Enable Time Slot 
							{
								if(isset($Enable))
								{ if(in_array($Single, $Enable))
									{	// disable slots	?>
										<div style="width:100px; float:left; padding:2px;">
											<input name="start_time" id="start_time" type="radio"   value="<?php echo $Single; ?>"/>&nbsp;<?php echo $Single; ?>
										</div>
										<?php
									}else
									{	// enable slots		?>
										<div style="width:100px; float:left; padding:2px;">
										<input name="start_time" id="start_time"  disabled="disabled" type="radio"  value="<?php echo $Single; ?>"/>&nbsp;<del><?php echo $Single; ?></del>
										</div>
										<?php
									}
								}// end of enable isset	
							}// end foreach
						unset($DisableSlotsTimes);
							
					} // end else
			?><br />
			<div id="selecttimediv" ><!--display select time error --></div>
			
			<?php
			if(!$Enable && !$TodaysAllDayEvent )
			{
				echo "<br><p align=center class='alert alert-error' style='width:auto;'><strong>Sorry! Today's all appointments has been booked.</strong>  <a class='btn btn-primary btn-mini' id='back' onclick='Backbutton()'>Back</a>";
			}
			else if(!$TodaysAllDayEvent && $Enable)
			{
			?>
					<input type="hidden" name="serviceid" id="serviceid" value="<?php echo $_GET['ServiceId']; ?>" />
					<input type="hidden" name="appointmentdate" id="appointmentdate"  value="<?php echo $_GET['AppDate']; ?>" />
					<input type="hidden" name="serviceduration" id="serviceduration"  value="<?php echo $ServiceDuration; ?>" />
					<br/>

					<div id="user_info_button">
						<div id="user1_info_button" style="float:left; width:100%"><br/>
							<div style="float:left;">
								&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" id="back" onclick="Backbutton()">&larr; Back</a>
							</div>
							<div style="float:right;">
								&nbsp;&nbsp;&nbsp;<button name="booknowapp1" class="btn btn-primary" type="button" id="booknowapp1" onclick="gofornext()">Next &rarr; </button>
							</div>
						</div>
					</div>
					
					<div id="user_info_button" align="center">
						<div id="loading3" style="display:none">
							Loading...<img src="<?php echo plugins_url()."/appointment-calendar/images/loading.gif"; ?>" />
						</div>
					</div>
			<?php
			  }
			  ?>
			  </form>
			   </div>
			  </div>
			  <div id="user_info_page" style="display:none"></div>
			  <?php if(isset($_GET['StartTime'])) { ?>
			
				<div id="user_info">
				  <input type="hidden" name="serviceId" id="serviceid" value="<?php echo $_GET['ServiceId'];?>" />
				    <input type="hidden" name="appointmentdate" id="appointmentdate" value="<?php echo $_GET['AppDate'];?>" />
					<input type="hidden" name="StartTime" id="StartTime" value="<?php echo $_GET['StartTime'];?>"/>
					<input type="hidden" name="ServiceDuration" id="ServiceDuration" value="<?php echo $_GET['ServiceDuration']; ?>" />
					<table width="100%" id="bordercssremove" class="table table-hover">
					 <tr >
						<td width="29%" align="left" scope="row"><strong>Name</strong></td>
						<td width="6%" align="center" valign="top"><strong>:</strong></td>
						<td width="65%"><input type="text" name="clientname" id="clientname" height="30px;" style="height:30px;" /></td>
					  </tr>
					 <tr>
						<td align="left" scope="row"><strong>Email</strong></td>
						<td align="center" valign="top"><strong>:</strong></td>
						<td><input type="text" name="clientemail" id="clientemail" height="30px;" style="height:30px;" ></td>
					  </tr>
					  <tr>
						<td align="left" scope="row"><strong>Phone</strong></td>
						<td align="center" valign="top"><strong>:</strong></td>
						<td><input name="clientphone" type="text" id="clientphone" maxlength="12" height="30px;" style="height:30px;" />
						<br/>
						<label>Eg: 1234567890</label></td>
					  </tr>
					  <tr>
						<td align="left" valign="middle" scope="row"><strong>Special Instruction</strong></td>
						<td align="center" valign="top"><strong>:</strong></td>
						<td valign="top"><textarea name="clientnote" id="clientnote"></textarea></td>
					  </tr>
					  <tr>
					  	<td>&nbsp;</td>
						<td>&nbsp;</td>
					    <td id="buttonbox"><a class="btn btn-primary" id="back" onclick="Backbutton()">&larr; Back</a>
                          <button name="booknowapp" class="btn btn-primary" type="button" id="booknowapp" onclick="checkvalidation()">Book Now</button>
					    </td>
					  </tr>
		  </table>
		 <div id="loading2" style="display:none; color:#1FCB4A;"><?php _e('Sheduling your appointment please wait...', 'appointzilla'); ?><img src="<?php echo plugins_url()."/appointment-calendar/images/loading.gif"; ?>" /></div>
		 
		  <style type="text/css">
		  #bordercssremove tr td
		  {
			border-top: 0 solid #DDDDDD;
		  }
		  </style>
		  </div>
		  <?php } ?>
		 </div>
	</div>
</div>
	<?php
	}// end of isset nextnext1 servicId and AppDate
}//end of short code function
?>