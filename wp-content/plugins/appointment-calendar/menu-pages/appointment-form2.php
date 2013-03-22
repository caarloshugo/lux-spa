<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap-assets/css/bootstrap.css', __FILE__); ?>' />

<div class="bs-docs-example tooltip-demo">

<div style="height:auto; width:auto;" id="myModalsecond"> 
	<form method="post" name="selecttimesloatappointment" id="selecttimesloatappointment">
		<div class="modal-info">
			<div class="alert alert-info">
				<a href="?page=appointment-calendar" style="float:right; margin-right:-22px; margin-top:8px;" id="close"><i class="icon-remove"></i></a>
				<h4>Schedule New Appoinmnet </h4>Setect Time & Fill up Form</div>
		</div>

		<div class="modal-body">
			<div id="timesloatbox" class="alert alert-block" style="float:left; height:auto; width:90%; margin-right:10px;">
			<?php 	include('time-slots-calculation.php'); ?>
			</div>
			<div id="clientboxform" style="float:left; width:auto;" >
				<?php 
	if(!$Enable && !$TodaysAllDayEvent )
	{
		echo "<p align=center class='alert alert-error'><strong>Sorry! Today's all appointments has been booked.</strong> <a class='btn btn-primary' id='back' onclick='backtodate()'>&larr; Back</a></p>";
	}
	else if(!$TodaysAllDayEvent && $Enable)
	{
	?>
				<div style="margin-left:0px; width:550px;">
					<input type="hidden" name="serviceid" id="serviceid" value="<?php echo $_GET['service']; ?>" />
					<input type="hidden" name="appointmentdate" id="appointmentdate"  value="<?php echo $_GET['bookdate']; ?>" />
					<input type="hidden" name="serviceduration" id="serviceduration"  value="<?php echo $ServiceDuration; ?>" />
					<table class="table">
					  <tr>
						<th valign="top" scope="row" >Name</th>
						<td valign="top"><strong>:</strong></td>
						<td valign="top"><input type="text" name="name" id="name" class="inputwidth"/></td>
					  </tr>
					 <tr>
						<th valign="top" scope="row" >Email</th>
						<td valign="top"><strong>:</strong></td>
					   <td valign="top"><input type="text" name="email" id="email" class="inputwidth"></td>
					  </tr>
					  <tr>
						<th valign="top" scope="row" >Phone</th>
						<td valign="top"><strong>:</strong></td>
						<td valign="top"><input name="phone" type="text" class="inputwidth" id="phone" maxlength="12"/>
						<br/><label>Eg : 1234567890</label></td>
					  </tr>
					  <tr>
						<th valign="top" scope="row" >Special Instruction</th>
						<td valign="top"><strong>:</strong></td>
						<td valign="top"><textarea name="desc" id="desc" class="inputwidth"></textarea></td>
					  </tr>
					  <tr>
					  	<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td valign="top">
						<a href="#"class="btn btn-primary" id="back" onclick="backtodate()">&larr; Back</a>
						<button name="booknowapp" class="btn btn-primary" type="button" id="booknowapp" onclick="checkvalidation()">Book Now</button>
						<div id="loading2" style="display:none; color:#1FCB4A;"><?php _e('Sheduling appointment please wait...', 'appointzilla'); ?><img src="<?php echo plugins_url()."/appointment-calendar/images/loading.gif"; ?>" /></div>
				 </div> 
						</td>
					  </tr>
			  </table>
				  
			</div>
		</div>
	<?php } //end else?>
	</form>
</div>
	
<!---Tooltip js ---------->
	
</div>
