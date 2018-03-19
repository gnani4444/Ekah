<?php 
include("includes/db.php"); 
?>
<form action="" method="post" style="padding:80px;">
<center>

				<b>Category:</b>
				<select name="new_brand_cat" onchange="" required >
					<option value="" disabled selected>Select the Category</option>
					<?php 
						$get_cats = "select * from categories";
						$run_cats = mysqli_query($con,$get_cats);
						while ($row_cats = mysqli_fetch_array($run_cats) ) {
								$cat_id = $row_cats['cat_id'];
								$cat_title= $row_cats['cat_title'];
								echo "<option value = '$cat_id'>$cat_title</option>";
								}
					?>
				</select>
			

<br>
<b>Insert New Brand:</b>
<input type="text" name="new_brand" required/> 
<br>
<input type="submit" name="add_brand" value="Add Brand" /> 
</center>
</form>

<?php 
include("includes/db.php"); 
	


	if(isset($_POST['add_brand']) ){
	
	 $new_brand = $_POST['new_brand'];
	 $new_brand_cat =$_POST['new_brand_cat'];
	$insert_brand = " INSERT INTO `brands` (`brand_cat_id`, `brand_id`, `brand_title`) VALUES ('$new_brand_cat ', NULL, '$new_brand') ";

	$run_brand = mysqli_query($con, $insert_brand); 
	
	if($run_brand){
	
	echo "<script>alert('New Brand has been inserted!')</script>";
	echo "<script>window.open('index.php?view_brands','_self')</script>";
	}
	}

?>