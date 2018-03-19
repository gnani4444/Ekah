<h2 style="text-align: center;">Change Your Password</h2>
<form class="form-horizontal" action="my_account.php" method="POST">
	<div class="form-group">
		<label for="old Password" class="col-sm-6 col-md-4 control-label" >Enter Current Password :</label>
		<div class="col-sm-6 col-md-4" >
		<input type="Password" class="form-control" name="current_pass" required></div>
	</div>
	<div class="form-group">
		<label for="new Password" class="col-sm-6 col-md-4 control-label" >Enter New Password :</label>
		<div class="col-sm-6 col-md-4" >
		<input type="Password" class="form-control" name="new_pass" required></div>
	</div>
	<div class="form-group">
		<label for="new Password again" class="col-sm-6 col-md-4 control-label" >Retype New Password :</label>
		<div class="col-sm-6 col-md-4" >
		<input type="Password" class="form-control" name="new_pass_again" required></div>
	</div><br>
	<center>
	<input  type="submit" name="change_pas" value="Change Password"></center>
	

	
</form>