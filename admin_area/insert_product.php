<!DOCTYPE html>
<?php 
include ("includes/db.php"); 
?>
<html>
<head>
	<title>Inserting Product</title>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
  	<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body style="background-color:skyblue;">
	<form action="insert_product.php" method="POST" enctype="multipart/form-data" >
		<table style="background-color: orange;" align="center" width="750" >
			<tr align="center">
				<td colspan="8"><h2>Insert New Product Here</h2></td>
			</tr>
			<tr><td colspan="8"><hr style="color: solid black;"></td></tr>
			<tr>
				<td>Product title:</td>
				<td><input type="text" name="product_title" size="40" required /></td>
			</tr>
			<tr>
				<td>Product Category:</td>
				<td><select name="product_cat" onchange="showUser(this.value)" required >
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
				</select></td>
			</tr>
			
			
			<tr>
				<td>Product Brand:</td>
				<td><select name="product_brand" id="txtHint" ></select></td>
			</tr>
			<tr>
				<td>Product Image:</td>
				<td><input type="file" name="product_image" required  ></td>
			</tr>
                        <tr>
				<td></td>
				<td><input type="file" name="product_image_2" required  ></td>
			</tr>
                        <tr>
				<td></td>
				<td><input type="file" name="product_image_3" required  ></td>
			</tr>
			<tr>
				<td>Product Price:</td>
				<td><input type="text" name="product_price" required  ></td>
			</tr><tr>
				<td>Product Desription:</td>
				<td><textarea name="product_desc" rows="10" cols="30"  ></textarea> </td>
			</tr>
			<tr>
				<td>Product Keywurds</td>
				<td><input type="text" name="product_keywords" size="40" required ></td>
			</tr>
			<tr align="center">
				<td colspan="8"><input type="submit" name="insert_product_now" value="Insert Now"></td>
			</tr>
		</table>
		
	</form>
</body>
</html>
<?php 
	if (isset($_POST['insert_product_now'])) {
		//getting the text from the fields
		$product_title =$_POST['product_title'];
		$product_cat =$_POST['product_cat'];
		$product_brand =$_POST['product_brand'];
		$product_price =$_POST['product_price'];
		$product_desc =$_POST['product_desc'];
		$product_keywords =$_POST['product_keywords'];
		//getting the image from the field
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		move_uploaded_file($product_image_tmp, "product_images/$product_image");
                
                $product_image_2 = $_FILES['product_image_2']['name'];
		$product_image_tmp_2 = $_FILES['product_image_2']['tmp_name'];
		move_uploaded_file($product_image_tmp_2, "product_images/$product_image_2");
                $product_image_3 = $_FILES['product_image_3']['name'];
		$product_image_tmp_3 = $_FILES['product_image_3']['tmp_name'];
		move_uploaded_file($product_image_tmp_3, "product_images/$product_image_3");
                
                

		//insertion in to db 
		$insert_local = mysqli_query($con ,"INSERT INTO `products` (`product_id`,`product_insert_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`,`product_image_2`,`product_image_3`, `product_keyword`) VALUES (NULL,'1','$product_cat', '$product_brand', '$product_title', '$product_price', '$product_desc', '$product_image','$product_image_2','$product_image_3', '$product_keywords')" );
		if ($insert_local) {
			echo "<script>alert('Product has been inserted');</script> ";
			echo "<script>window.open('index.php','_self');</script>";
		}

		
	}



?>