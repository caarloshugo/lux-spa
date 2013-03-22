<div style="background:#C3D9FF; margin-bottom:10px; padding-left:10px;">
  <h3>Settings</h3> 
</div>
<table width="100%" class="table">
  <tr>
    <th width="14%" scope="row">Calendar Slot Time</th>
    <td width="5%"><strong>:</strong></td>
    <td width="81%">
		<em>
		<?php
			$AllCalendarSettings = unserialize(get_option('apcal_calendar_settings'));
			if($AllCalendarSettings['calendar_slot_time'])
			{
				echo $AllCalendarSettings['calendar_slot_time']." Minute";
			}
			else echo "Not Available.";
		?>
	    </em></td>
  </tr>
  <tr>
    <th scope="row">Day Start Time</th>
    <td><strong>:</strong></td>
    <td>
		<em>
		<?php 
			if($AllCalendarSettings['day_start_time'])
			{
				echo $AllCalendarSettings['day_start_time'];
			}
			else echo _e('Not Available.' ,'appointzilla');
		?>
	    </em> </td>
  </tr>
  <tr>
    <th scope="row">Day End Time</th>
    <td><strong>:</strong></td>
    <td>
		<em>
		<?php
			if($AllCalendarSettings['day_end_time'])
			{
				echo $AllCalendarSettings['day_end_time'];
			}
			else echo _e('Not Available.' ,'appointzilla');
		?>
	    </em> </td>
  </tr>
  <tr>
    <th scope="row">Calendar View</th>
    <td><strong>:</strong></td>
    <td>
		<em>
		<?php $calendar_view =  get_option('calendar_view' ,'appointzilla');
			if($AllCalendarSettings['calendar_view'])
			{
				if($AllCalendarSettings['calendar_view'] == 'agendaDay') echo _e("Day" ,'appointzilla');
				if($AllCalendarSettings['calendar_view'] == 'agendaWeek') echo _e("Week" ,'appointzilla');
				if($AllCalendarSettings['calendar_view'] == 'month') echo _e("Month" ,'appointzilla');
			}
			else echo _e('Not Available.' ,'appointzilla');
		?>
	    </em> </td>
  </tr>
  <tr>
    <th scope="row">Calendar Start Day</th>
    <td><strong>:</strong></td>
    <td><em>
		<?php $calendar_start_day =  $AllCalendarSettings['calendar_start_day'];
			if($calendar_start_day >= 0 )
			{
				if($calendar_start_day == 1)
					echo _e("Monday" ,'appointzilla');
				if($calendar_start_day == 2)
					echo _e("Tuesday" ,'appointzilla');
				if($calendar_start_day == 3)
					echo _e("Wednesday" ,'appointzilla');
				if($calendar_start_day == 4)
					echo _e("Thursday" ,'appointzilla');
				if($calendar_start_day == 5)
					echo _e("Friday" ,'appointzilla');
				if($calendar_start_day == 6)
					echo _e("Saturday" ,'appointzilla');
				if($calendar_start_day == 0)
					echo _e("Sunday" ,'appointzilla');
			}
			else echo _e('Not Available.' ,'appointzilla');
		?>
	    </em> </td>
  </tr>
  <tr>
    <th scope="row"><?php _e("Booking Button Text")?></th>
    <td><strong>:</strong></td>
    <td><em>
      <?php 
				if($AllCalendarSettings['booking_button_text'])
				{ echo $AllCalendarSettings['booking_button_text']; }
				else
				{ echo _e('Not Available.' ,'appointzilla');  }
		?>
    </em> </td>
  </tr>
  <tr> <th scope="row"><?php _e("Booking Time Slot", 'appointzilla'); ?></th><td><strong>:</strong></td> <td><em>
      <?php if($AllCalendarSettings['apcal_booking_time_slot'])
				{ echo $AllCalendarSettings['apcal_booking_time_slot'] ." " ."Minutes"; }
				else
				{ echo _e('Not Available.' ,'appointzilla');  }
		?> </em> </td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td><a href="?page=manage-settings" class="btn btn-primary">Manage Settings</a></td>
  </tr>
</table>

<?php
	/**
	 * Saving Calendar Settings
	 ****************************/
	if(isset($_POST['savesettings']))
	{
		//update email settings option values
		$CalendarSettingsArray = array(
									'calendar_slot_time' => $_POST['calendar_slot_time'],
									'day_start_time' => $_POST['day_start_time'],
									'day_end_time' => $_POST['day_end_time'],
									'calendar_view' => $_POST['calendar_view'],
									'calendar_start_day' => $_POST['calendar_start_day'],
									'booking_button_text' => $_POST['booking_button_text'],
									'apcal_booking_time_slot' => $_POST['apcal_booking_time_slot'],
								 );
		update_option('apcal_calendar_settings',serialize($CalendarSettingsArray));
		echo "<script>location.href='?page=settings'</script>";
	}
?>