<?php  
$con = mysqli_connect("fdb13.awardspace.net","2236904_ekah","Naga.v.n#1#","2236904_ekah");
//For Displaying error
if (mysqli_connect_errno()) {
		echo "Failed to connect to MYSQl".mysqli_connect_error();
	}


//Getting the user ip
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
	}

//creating the shopping cart
function cart(){
	
	if (isset($_GET['add_cart'])) {
	global $con ;
	$ip = getIp();
		$pro_id=$_GET['add_cart'];
		$check_pro = "select * from cart where ip_add='$ip' AND p_id ='$pro_id' ";
		$run_check = mysqli_query($con , $check_pro);
		if (mysqli_num_rows($run_check) > 0 ) {
			echo "";
		}else {
			$insert_pro = "insert into cart (p_id,ip_add) values('$pro_id','$ip')";
			$run_pro = mysqli_query($con , $insert_pro);
			echo "<script>window.open('new.php','_self') </script>";
		}
	}
	

}

//getting the total added items
function total_items() {
	if (isset($_GET['add_cart']) ) {
		global $con ;
		$ip = getIp();
		$get_items = "select * from cart where ip_add='$ip' ";
		$run_items = mysqli_query($con,$get_items);
		$count_items = mysqli_num_rows($run_items);
	}else {
		global $con ;
		$ip = getIp();
		$get_items = "select * from cart where ip_add='$ip' ";
		$run_items = mysqli_query($con,$get_items);
		$count_items = mysqli_num_rows($run_items);
	}
	echo $count_items;
	
}

//for total price  of the items in the cart
function total_price(){
	$total = 0;
	global $con ;
	$ip = getIp();
	$select_price = "select * from cart where ip_add='$ip' ";
	$run_price_query = mysqli_query($con,$select_price);
	while ($p_price = mysqli_fetch_array($run_price_query)) {
		$pro_id = $p_price['p_id'];
		$pro_price ="select * from products where product_id='$pro_id' ";
		$run_pro_price = mysqli_query($con,$pro_price);
		while ($pp_price = mysqli_fetch_array($run_pro_price)) {
			$product_price = $pp_price['product_price'];
			$total +=$product_price;

		}

	}
	echo $total;
}


function getCats()
{
	global $con ; 
	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con,$get_cats);
	while ($row_cats = mysqli_fetch_array($run_cats) ) {
		$cat_id = $row_cats['cat_id'];
		$cat_title= $row_cats['cat_title'];
		echo "<a href='new.php?cat=$cat_id' class='list-group-item'> $cat_title </a> ";
	}

}



function getBrands()
{
	global $con;
	$get_brands = "select * from brands";
	$run_query_brands = mysqli_query($con , $get_brands);
	while ($row_brands= mysqli_fetch_array($run_query_brands)) {
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];
		echo "<a href='new.php?brand=$brand_id' class='list-group-item'> $brand_title </a> ";
	}
}



function getpro()
{
	if (!isset($_GET['cat'])) {
		if (!isset($_GET['brand'])) {
	global $con ;
	$get_pro ="select * from products order by RAND() LIMIT 0,12";
	$run_query_pro = mysqli_query($con,$get_pro);
	$i = 0;
	while($row_pro= mysqli_fetch_array($run_query_pro)) {

		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];

		//echo
		echo "
		<div class='col-sm-6 col-lg-4 col-xs-12 col-md-4'>
                        <div class='thumbnail' style='margin :20px; '>
                            <img class ='img-responsive' style='max-height:200px;' src='admin_area/product_images/$pro_image'>
                            <div class='caption'>
                            <h4><a href='details.php?pro_id=$pro_id'>$pro_title</a></h4><h3><a href='new.php?add_cart=$pro_id' ><span class='glyphicon glyphicon-shopping-cart pull-right'></span></a></h3>
                            <h4 class=''>Price : &#8377; $pro_price</h4>
                            
                                <p></p>
                            </div>
                            <!--<div class='ratings'>
                                <p class='pull-right'>12 reviews</p>
                                <p>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star-empty'></span>
                                </p>
                            </div> -->
                        </div>
                    </div> ";

    $i = $i +1;
	if ($i%3 == 0) {
		echo "<div class='col-xs-12'></div><br><br><hr>";
	}

	}


	}}		
}


function getcatpro()
{
	if (isset($_GET['cat'])) {	
		$cat_id = $_GET['cat'];
	global $con ;
	$get_cat_pro ="select * from products where product_cat='$cat_id' ";
	$run_cat_pro = mysqli_query($con,$get_cat_pro);
	$count_cats = mysqli_num_rows($run_cat_pro);
	$i=0;
	if ($count_cats > 0) {
	while($row_cat_pro= mysqli_fetch_array($run_cat_pro)) {
		$pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['product_cat'];
		$pro_brand = $row_cat_pro['product_brand'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		$pro_image = $row_cat_pro['product_image'];
		$pro_desc = $row_cat_pro['product_desc'];
		
		echo "
		<div class='col-sm-4 col-lg-4 col-xs-6 col-md-4'>
                        <div class='thumbnail' style='margin :20px; '>
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
                            <div class='caption'>
                            <h4><a href='details.php?pro_id=$pro_id'>$pro_title</a></h4><h3><a href='new.php?add_cart=$pro_id' ><span class='glyphicon glyphicon-shopping-cart pull-right'></span></a></h3>
                            <h4 class=''>&#8377; $pro_price</h4>
                            
                                <p></p>
                            </div>
                            <!--<div class='ratings'>
                                <p class='pull-right'>12 reviews</p>
                                <p>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star-empty'></span>
                                </p>
                            </div> -->
                        </div>
                    </div> ";  
                    $i = $i +1;
	if ($i%3 == 0) {
		echo "<div class='col-xs-12'></div><br><br>";
	}


	}}else {echo "<h3 style='padding:20px;'>There is no product in this category!</h3>";}

	}	
}
function getbrandpro()
{
	if (isset($_GET['brand'])) {	
		$brand_id = $_GET['brand'];
	global $con ;
	$get_brand_pro ="select * from products where product_brand='$brand_id' ";
	$run_brand_pro = mysqli_query($con,$get_brand_pro);
	$count_brands = mysqli_num_rows($run_brand_pro);
	$i=0;
	if ($count_brands > 0) {
	while($row_brand_pro= mysqli_fetch_array($run_brand_pro)) {
		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_cat'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_image'];
		$pro_desc = $row_brand_pro['product_desc'];
		
		echo "
		<div class='col-sm-4 col-lg-4 col-xs-6 col-md-4'>
                        <div class='thumbnail' style='margin :20px; '>
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
                            <div class='caption'>
                            <h4><a href='details.php?pro_id=$pro_id'>$pro_title</a></h4><h3><a href='new.php?add_cart=$pro_id' ><span class='glyphicon glyphicon-shopping-cart pull-right'></span></a></h3>
                            <h4 class=''>&#8377; $pro_price</h4>
                            
                                <p></p>
                            </div>
                            <!--<div class='ratings'>
                                <p class='pull-right'>12 reviews</p>
                                <p>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star'></span>
                                    <span class='glyphicon glyphicon-star-empty'></span>
                                </p>
                            </div> -->
                        </div>
                    </div> ";  
                    $i = $i +1;
	if ($i%3 == 0) {
		echo "<div class='col-xs-12'></div><br><br><hr>";
	}


	}}else {echo "<h3 style='padding:20px;'>There is no product in this brand!</h3>";}

	}	
}






?>