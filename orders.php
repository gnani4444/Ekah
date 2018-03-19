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
          $name_id = $row_get_name['customer_id'];
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
                

                    <?php
                            if(isset($_POST['add_address'])){
                              
                              $cust_email=$_SESSION['customer_email'];
                              $cust_line1= $_POST['line1'];
                              $cust_line2= $_POST['line2'];
                              $cust_line3= $_POST['line3'];
                              $cust_city= $_POST['city'];
                              $cust_post= $_POST['postcode'];
                              $cust_state= $_POST['state'];
                              
                               if($inser_add = mysqli_query($con,"INSERT INTO `address` (`address_id`, `customer_id`, `customer_email`, `customer_line1`, `customer_line2`, `customer_line3`, `customer_city`, `customer_post`, `customer_state`) VALUES (NULL, '$name_id', '$cust_email', '$cust_line1', '$cust_line2', '$cust_line3', '$cust_city', '$cust_post', '$cust_state')"
                           )){
                                   $a_id= mysqli_insert_id($con);
                                   echo"<script>alert('Shipping address Added');</script>";
                           }else{
                                   echo"<script>alert('Shipping address not Added');</script>";
                           }
                           
                            }
                    ?>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 ">
                            
                       <table class="">
                       <thead></thead>
                       <tbody>
                               <tr style="background-color:#EEEEEE;">
                              
                               <th><h3>Name:</h3></th>
                               <td></td>
                               <td></td>
                               <td><h3><?php echo $name;?></h3></td>
                               
                               </tr>
                               <tr>
                               <th>Address:</th>
                               <td></td>
                               <td></td>
                               <td><?php echo $cust_line1;?></td>
                               </tr>
                               <tr>
                               <th>Address Line2:</th>
                               <td></td>
                               <td></td>
                               <td><?php echo $cust_line2;?></td>
                               </tr>
                               <tr>
                               <th>Address Line3:</th>
                               <td></td>
                               <td></td>
                               <td><?php echo $cust_line3;?> </td>
                               </tr>
                               <tr style="background-color:#EEEEEE;">
                              
                               <th>City:</th>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td><?php echo $cust_city;?></td>
                               
                               </tr>
                               <tr style="">
                              
                               <th>Postal Code:</th>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td><?php echo $cust_post;?></td>
                               
                               </tr>
                               <tr style="background-color:#EEEEEE;">
                              
                               <th>State:</th>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td><?php echo $cust_state;?></td>
                               
                               </tr>
                               
                       </tbody>
                       </table>
                        
                    
                    
                     <div style="padding:10px; " >
  <form action="orders.php" method ="POST"> 
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product(s)</th>
                   
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = 0;
                global $con ;
                $ip = getIp();
                $select_price = "select * from cart where ip_add='$ip' ";
                $run_price_query = mysqli_query($con,$select_price);
                $j =0;
                while ($p_price = mysqli_fetch_array($run_price_query)) {
                  $pro_id = $p_price['p_id'];
                  $a[j]=$pro_id;
                  $quantity = $p_price['qty'];
                  $b[j]=$quantity;
                  $j++;
                  $qty = $p_price['qty'];
                  $pro_price ="select * from products where product_id='$pro_id' ";
                  $run_pro_price = mysqli_query($con,$pro_price);
                  if ($pp_price = mysqli_fetch_array($run_pro_price)) {
                    $product_price = $pp_price['product_price'];
                    $product_title = $pp_price['product_title'];
                    $product_image = $pp_price['product_image'];

                    $product_id = $pp_price['product_id'];
                    
           
   ?>
              <tr>
                <td><input type="hidden" name="fd" value="<?php echo  $product_id; ?>">  </td>
                <td><img src="admin_area/product_images/<?php echo $product_image; ?> " width="65" height="65" ></td>
                <td><a href="details.php?pro_id=<?php echo $product_id;?>"><?php echo $product_title ; ?></a> <br><a href="cart.php?del=<?php echo $product_id; ?>"></a> </td>
                <?php     
                  if (isset($_GET['ad'])   ) {
                    $qty=$_GET['qty'];
                    $fd = $_GET['fd'];
                    
                    $update_qty = "update cart set qty ='$qty' where p_id= '$fd' ";
                    $run_qty = mysqli_query($con , $update_qty);
                  }  ?>
                

               
                <td><?php 

                $q_qty= "select * from cart where ip_add='$ip' AND p_id = '$product_id' ";
                $run_q_qty= mysqli_query($con,$q_qty);
                if ($row_qty = mysqli_fetch_array($run_q_qty)) {
                  $qty = $row_qty['qty'];
                }

                $total= $total + ($product_price*$qty);
                echo '&#8377;'.$product_price.'x';
                echo $qty.'<br>'; ?></td>
              </tr>
             
              <?php  }

                } ?>
                <tr >
                <td></td>
                <td></td>
                <td></td>
                  <td ><b>Sub Total :</b></td>
                  <td > <?php 
                  
                  echo '&#8377;'.$total; ?> </td>
                </tr>
                </tbody>
              </table>
             
               <center>
              
               
   
             <button input="submit"  type="submit" class="" ><a style="text-decoration: none; color: inherit;" href="orders.php?a=$a_id">Place The Order</a></button>
              </center>
      </form>
  
    <?php 

    $ip = getIp();
    if (isset($_GET['del']) ) {
        $remove_id=$_GET['del'];
        echo $remove_id;
        $delete_product = "delete from cart where p_id ='$remove_id' AND ip_add='$ip' ";
        $run_delete = mysqli_query($con,$delete_product);
        
      
      if ($run_delete) {
        echo "<script>window.open('cart.php','_self')</script> ";
      }
    }
      
    ?>
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