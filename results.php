<?php
session_start();
include ("functions/function.php");
?>
<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ekah</title>
    <style type="text/css">
        
        
    </style>
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<style type="text/css">



	</style>
    <style>

</style>
<style>
#badg {
     background-color: #0000FF;
    vertical-align: top;
    }
    body{ background:#eee;
    }
</style>

</head>
<body>


<!-- start of navbar -->
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        			<span class="sr-only">Toggle navigation</span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
    			</button>
                <div  class="navbar-brand">
                    <a id="menu-toggle" href="#" class="glyphicon glyphicon-align-justify btn-menu toggle">
                        <i class="fa fa-bars"></i>
                    </a>
    				<a href="index.php" id="logo_img" ><img src="images/ekah.png" style="vertical-align: center; position: relative;" width="40px" height="40px"></a>
    				<a href="index.php" style="font-size: 1.5em; padding: 10px;">EKAH</a>
                </div>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="new.php">Home</a></li>
					<li><a href="#about">About</a></li>
                    <li><?php cart(); ?> <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"><span id="badg" class="badge badge-warning"><?php total_items();  ?> </span></span></a></li>
        
        <?php 
        if (!isset($_SESSION['customer_email'])) {
          echo "<li><a href='checkout.php'>Welcome Guest:<?php ?></a></li>";
          echo "<li><a href='checkout.php'>Login||Register <?php ?></a></li>";
        } else {
          $c_email = $_SESSION['customer_email'];
          $get_name = "select * from customers where customer_email ='$c_email' ";
          $run_get_name = mysqli_query($con , $get_name);
          $row_get_name = mysqli_fetch_array($run_get_name);
          $name = $row_get_name['customer_name'];
          echo "<li><a disabled>Welcome : $name</a></li>";
          echo "<li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='my_account.php'>My Account</a></li>
            <li><a href='logout.php'>Logout</a></li>
          </ul>
        </li>";
        }
        

        ?>
				</ul>

                <form action="results.php" class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" name="user_search" class="form-control" placeholder="Search">
        </div>
        <button type="submit" name="search" class="btn btn-default" value="search">Search</button>
      </form>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <nav id="spy">
            <ul class="sidebar-nav nav">
                <li class="sidebar-brand">
                    <a href="new.php"><span class="fa fa-home solo">Home</span></a>
                </li>
                <li>
                    <a href="#anch1">
                        <span class="">Mobiles</span>
                    </a>
                </li>
                <li>
                    <a href="#anch2">
                        <span class="">Laptops</span>
                    </a>
                </li>
                <li>
                    <a href="#anch3">
                        <span class="">books</span>
                    </a>
                </li>
                <li>
                    <a href="#anch4">
                        <span class=""></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Page content -->
    <div id="page-content-wrapper">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    
                   
                    <div>

    <div class="row">
     <!--    <div class=" col-xs-8 col-sm-3 col-md-3">
              <div class="col-md-2"></div>
              <div class="col-md-10">
                   <h3><p>  Products</p></h3>
                    <div class="list-group text-center">
                      <h4>
                        <?php // getCats();?>
                      </h4>
                    </div>
                    <h3><p>  Brands</p></h3>
                    <div class="list-group text-center">
                      <h4>
                        <?php // getBrands(); ?>
                      </h4>
                    </div>
                </div> 
        </div>  -->
  <div>
  <div class="container">
<div>

  <div class="row">
                  

  <div class="col-sm-9 col-xs-12 col-md-9">
        <?php 

        if ( isset($_GET['user_search'])   ) {
            $user_search = $_GET['user_search'];
            $i=0;
             $get_cat_pro ="select * from categories where cat_title like '%$user_search%' ";
             $run_query_cat_pro=mysqli_query($con,$get_cat_pro);
            if ($row_cat_pro=mysqli_fetch_array($run_query_cat_pro)) {
                $cat_id = $row_cat_pro['cat_id'];

                $get_pro ="select * from products where product_cat ='$cat_id' ";
    $run_query_pro = mysqli_query($con,$get_pro);
    if ($row_pro= mysqli_fetch_array($run_query_pro)) {
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
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
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
    
   $i =1 ;
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
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
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
     }
            }





$get_cat_pro ="select * from brands where brand_title like '%$user_search%' ";
             $run_query_cat_pro=mysqli_query($con,$get_cat_pro);
            if ($row_cat_pro=mysqli_fetch_array($run_query_cat_pro)) {
                $cat_id = $row_cat_pro['brand_id'];

                $get_pro ="select * from products where product_brand ='$cat_id' ";
    $run_query_pro = mysqli_query($con,$get_pro);
    if ($row_pro= mysqli_fetch_array($run_query_pro)) {
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
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
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
    
   $i =1 ;
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
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
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
     }
            }



            $get_pro ="select * from products where product_keyword like '%$user_search%' ";
    $run_query_pro = mysqli_query($con,$get_pro);
    if ($row_pro= mysqli_fetch_array($run_query_pro)) {
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
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
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
    
   $i =1 ;
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
                            <img class ='img-responsive' src='admin_area/product_images/$pro_image'>
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
     } 

      if($i==0){
        echo "<center>
<h2>NO PRODUCT FOUND</h2>
</center>";
    }
        }
        ?>
      


          </div>
        </div>
    </div>
</div>

      


          </div>
        </div>
    </div>
</div>














                  







                </div>
            </div>
        </div>
    </div>
</div>






<script src="js/jquery.min.js"></script>
<script >
	    
	/*Menu-toggle*/
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        
    });
    </script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>     
</body>
</html>