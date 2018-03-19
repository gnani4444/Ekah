<!DOCTYPE html>
<?php 
include ("includes/db.php"); 
?>
<html>
<head>
	<title></title>
</head>
<body>
<option id="" >Select the Brand</option>
<?php 
			if (isset($_GET['q'])) {
				$q = $_GET['q'];
			
						$get_brands = "select * from brands where brand_cat_id =  '".$q."'";
						$run_brands = mysqli_query($con,$get_brands);
						while ($row_brands = mysqli_fetch_array($run_brands) ) {
								$brand_id = $row_brands['brand_id'];
								$brand_title= $row_brands['brand_title'];
								echo "<option value = '$brand_id'>$brand_title</option>";
								}
                                                                }
					?>

</body>
</html>