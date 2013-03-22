<div class="bs-docs-example tooltip-demo">

<div style="background:#C3D9FF; margin-bottom:10px; padding-left:10px;">
  <h3>Manage Settings</h3> 
</div>

<form method="post" action="?page=settings">
  <table width="100%" class="table">
  <tr>
    <th width="18%" align="right" scope="row">Calendar Slot Time </th>
    <td width="3%" align="center"><strong>:</strong></td>
    <td width="79%">
	<?php 
	//$calendar_slot_time = get_option('calendar_slot_time');
	$AllCalendarSettings = unserialize(get_option('apcal_calendar_settings'));
	$calendar_slot_time = $AllCalendarSettings['calendar_slot_time'];
	
	 ?>
      <select name="calendar_slot_time" id="calendar_slot_time">
        <option value="0">Select Time</option>
        <option value="15" <?php if($calendar_slot_time && $calendar_slot_time == '15') echo "selected"; ?>>15 Minute</option>
        <option value="30" <?php if($calendar_slot_time && $calendar_slot_time == '30') echo "selected"; ?>>30 Minute</option>
        <option value="60" <?php if($calendar_slot_time && $calendar_slot_time == '60') echo "selected"; ?>>60 Minute</option>
      </select>&nbsp;<a href="#" rel="tooltip" title="Calendar Time Slot" ><i class="icon-question-sign"></i></a>	 </td>
    </tr>
  <tr>
    <th align="right" scope="row">Day Start Time </th>
    <td align="center"><strong>:</strong></td>
    <td>
		<?php //$day_start_time = get_option('day_start_time');
			$day_start_time = $AllCalendarSettings['day_start_time'];
		 ?>
		<select name="day_start_time" id="day_start_time">
			<option value="0">Select Start Time</option>
			<?php
				$biz_start_time = strtotime("01:00 AM");
				$biz_end_time = strtotime("11:00 PM");
				for( $i = $biz_start_time; $i <= $biz_end_time; $i += (60*(60))) //making 60min slots
				{
					if( $day_start_time && $day_start_time == date('g:i A', $i) ) $selected = 'selected'; else $selected='';
					echo "<option $selected value='". date('g:i A', $i)."'>". date('g:i A', $i) ."</option>";
				}
			?>
		</select>&nbsp;<a href="#" rel="tooltip" title="Calendar Day Start Time" ><i class="icon-question-sign"></i> </a>	</td>
    </tr>
  <tr>
    <th align="right" scope="row">Day End Time </th>
    <td align="center"><strong>:</strong></td>
    <td>
		<?php // $day_end_time = get_option('day_end_time');
			$day_end_time = $AllCalendarSettings['day_end_time'];
			 ?>
		<select name="day_end_time" id="day_end_time">
			<option value="0">Select End Time</option>
			<?php
				for( $i = $biz_start_time; $i <= $biz_end_time; $i += (60*(60))) //making 60min slots
				{
					if( $day_end_time && $day_end_time == date('g:i A', $i) ) $selected = 'selected'; else $selected='';
					echo "<option $selected value='". date('g:i A', $i)."'>". date('g:i A', $i) ."</option>";
				}
			?>
		</select>&nbsp;<a href="#" rel="tooltip" title="Calendar Day End Time" ><i class="icon-question-sign"></i> </a>	</td>
    </tr>
  <tr>
    <th align="right" scope="row">Calendar View </th>
    <td align="center"><strong>:</strong></td>
    <td>
		<?php
			$calendar_view = $AllCalendarSettings['calendar_view'];
		 //$calendar_view = get_option('calendar_view'); ?>
		<select id="calendar_view" name="calendar_view">
			<option value="0">Select View</option>
			<option value="agendaDay" <?php if($calendar_view && $calendar_view == 'agendaDay') echo "selected"; ?>>Day</option>
			<option value="agendaWeek" <?php if($calendar_view && $calendar_view == 'agendaWeek') echo "selected"; ?>>Week</option>
			<option value="month" <?php if($calendar_view && $calendar_view == 'month') echo "selected"; ?>>Month</option>
		</select>&nbsp;<a href="#" rel="tooltip" title="Calendar View" ><i class="icon-question-sign"></i> </a>	</td>
    </tr>
  <tr>
    <th align="right" scope="row">Calendar First Day </th>
    <td align="center"><strong>:</strong></td>
    <td>
	<?php $calendar_start_day = $AllCalendarSettings['calendar_start_day']; 
	//$calendar_start_day = get_option('calendar_start_day'); ?>
	<select name="calendar_start_day" id="calendar_start_day">
      <option value="-1">Select Start Day</option>
      <option value="1" <?php if($calendar_start_day == 1) echo "selected";  ?>>Monday</option>
      <option value="2" <?php if($calendar_start_day == 2) echo "selected";  ?>>Tuesday</option>
      <option value="3" <?php if($calendar_start_day == 3) echo "selected";  ?>>Wednesday</option>
      <option value="4" <?php if($calendar_start_day == 4) echo "selected";  ?>>Thursday</option>
      <option value="5" <?php if($calendar_start_day == 5) echo "selected";  ?>>Friday</option>
      <option value="6" <?php if($calendar_start_day == 6) echo "selected";  ?>>Saturday</option>
      <option value="0" <?php if($calendar_start_day == 0) echo "selected";  ?>>Sunday</option>
    </select>&nbsp;<a href="#" rel="tooltip" title="Calendar First Day" ><i class="icon-question-sign"></i> </a>    </td>
    </tr>
  <tr>
    <th align="right" scope="row"><?php _e("Booking Button Text")?></th>
    <td align="center"><strong>:</strong></td>
    <td><input name="booking_button_text" type="text" id="booking_button_text" value="<?php echo $AllCalendarSettings['booking_button_text'];	 ?>" /></td>
  </tr>
  <tr><th align="right" scope="row"><?php _e("Booking Time Slot", 'appointzilla'); ?></th> <td align="center"><strong>:</strong></td>
    <td><?php $apcal_booking_time_slot = $AllCalendarSettings['apcal_booking_time_slot']; ?>
       <select name="apcal_booking_time_slot" id="apcal_booking_time_slot">
		   <option <?php if($apcal_booking_time_slot == 5) echo "selected"; ?> value="5"><?php _e("5 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 10) echo "selected"; ?> value="10"><?php _e("10 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 15) echo "selected"; ?> value="15"><?php _e("15 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 20) echo "selected"; ?> value="20"><?php _e("20 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 25) echo "selected"; ?> value="25"><?php _e("25 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 30) echo "selected"; ?> value="30"><?php _e("30 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 35) echo "selected"; ?> value="35"><?php _e("35 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 40) echo "selected"; ?> value="40"><?php _e("40 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 45) echo "selected"; ?> value="45"><?php _e("45 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 60) echo "selected"; ?> value="60"><?php _e("60 Minutes (1 Hour)", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 75) echo "selected"; ?> value="75"><?php _e("75 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 90) echo "selected"; ?> value="90"><?php _e("90 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 120) echo "selected"; ?> value="120"><?php _e("120 Minutes (2 Hour)", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 150) echo "selected"; ?> value="150"><?php _e("150 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 180) echo "selected"; ?> value="180"><?php _e("180 Minutes (3 Hour)", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 210) echo "selected"; ?> value="210"><?php _e("210 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 240) echo "selected"; ?> value="240"><?php _e("240 Minutes (4 Hour)", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 270) echo "selected"; ?> value="270"><?php _e("270 Minutes", 'appointzilla'); ?></option>
		   <option <?php if($apcal_booking_time_slot == 300) echo "selected"; ?> value="300"><?php _e("300 Minutes (5 Hour)", 'appointzilla'); ?></option>
	  </select>&nbsp;<a href="#" rel="tooltip" title="<?php _e('Booking Time Slot' ,'appointzilla'); ?>" ><i class="icon-question-sign"></i></a>
	 </td>
  </tr>

  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>
		<?php if($calendar_slot_time && $day_start_time && $day_end_time && $calendar_view ) { ?>
		<button name="savesettings" class="btn btn-primary" type="submit" id="savesettings" data-loading-text="Saving Settings" >Update Settings</button>
		<?php } else { ?>
		<button name="savesettings" class="btn btn-primary" type="submit" id="savesettings" data-loading-text="Saving Settings" >Save Settings</button>		
		<?php } ?>
		<a href="?page=settings" class="btn btn-primary">Cancel</a>
		
	  
	  <!--<button type="submit" class="btn btn-primary" data-loading-text="Loading...">Loading state</button>-->	</td>
    </tr>
</table>
</form>



<style type="text/css">
.error{  color:#FF0000; }
</style>

<!--validation js lib-->
<script src="<?php echo plugins_url('/js/jquery.min.js', __FILE__); ?>" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function () {
	
		$('#savesettings').click(function(){
			$(".error").hide();
			
			//slot time
			var calendar_slot_time = $('#calendar_slot_time').val();
			if(calendar_slot_time == 0)
			{
				$("#calendar_slot_time").after('<span class="error">&nbsp;<br><strong>Select Slot Time.</strong></span>');
				return false;
			}
			
			var day_start_time = $('#day_start_time').val();
			if(day_start_time == 0)
			{
				$("#day_start_time").after('<span class="error">&nbsp;<br><strong>Select Start Time.</strong></span>');
				return false;
			}
			
			var day_end_time = $('#day_end_time').val();
			if(day_end_time == 0)
			{
				$("#day_end_time").after('<span class="error">&nbsp;<br><strong>Select End Time.</strong></span>');
				return false;
			}
			
			var calendar_view = $('#calendar_view').val();
			if(calendar_view == 0)
			{
				$("#calendar_view").after('<span class="error">&nbsp;<br><strong>Select Calendar View.</strong></span>');
				return false;
			}
			
			var calendar_start_day = $('#calendar_start_day').val();
			if(calendar_start_day == -1)
			{
				$("#calendar_start_day").after('<span class="error">&nbsp;<br><strong>Select Calendar View.</strong></span>');
				return false;
			}
				
		});
	});
</script>
</div>