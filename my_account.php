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

        <?php 
if (isset($_POST['btn-sig'])){
  $ip = getIp();
  $customer_id  = $_GET['c_id'];
  $c_name =  $_POST['c_name'];
  $c_contact = $_POST['c_cont'];
  $c_email =  $_POST['c_email'];
 
  $update_c = "update customers set customer_name='$c_name' , customer_email='$c_email', customer_contact='$c_contact' where customer_id ='$customer_id' ";
  $run_update = mysqli_query($con,$update_c);
  if ($run_update) {
    $_SESSION['customer_email']= $c_email;
    echo "<script>alert('Your account successfully updated')</script>";
     echo "<script>window.open('my_account.php','_self')</script> ";
  }
  
}
if (isset($_POST['change_pas'])) {
  $user = $_SESSION['customer_email'];
  $current_pass =$_POST['current_pass'];
  $new_pass= $_POST['new_pass'];
  $new_pass_again = $_POST['new_pass_again'];
  $sel_pass= " select * from customers where customer_pass = '$current_pass' AND customer_email = '$user' ";
  $run_pass = mysqli_query($con , $sel_pass);
  $check_pass = mysqli_num_rows($run_pass);
  if ($check_pass == 0) {
    echo "<script>alert('Your Current Password is Wrong')</script> ";
    echo "<script>window.open('my_account.php?change_pass','_self')</script> ";

  }else{
  if ($new_pass != $new_pass_again) {
    echo "<script>alert('Password doesn\'t match')</script> ";
    echo "<script>window.open('my_account.php?change_pass','_self')</script> ";
  }else{
    $update_pass = "update customers set customer_pass ='$new_pass' where customer_email = '$user' ";
    $run_update = mysqli_query($con,$update_pass);
    echo "<script> alert('You Password has been changed successfully!')</script> ";
 }

}//end of else block of check_pass
} // end of change pass
 $user = $_SESSION['customer_email'];
 if (isset($_POST['yes'])) {
   $delete_customer = "delete from customers where customer_email ='$user' ";
   $run_customer = mysqli_query($con , $delete_customer);
   echo "<script>alert('We are really sorry ,your account has been deleted !')</script> ";
   session_destroy('customer_email');
   echo "<script>window.open('index.php','_self')</script> ";

 }
 if (isset($_POST['no'])){
  echo "<script>window.open('my_account.php','_self') </script> ";
 }


?>

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
 
  </div>
  
      <?php
                   $user = $_SESSION['customer_email'];
                   $get_user = "select * from customers where customer_email ='$user' ";
                   $run_get_user = mysqli_query($con,$get_user);
                   $row_get_user = mysqli_fetch_array($run_get_user);
                   $c_name = $row_get_user['customer_name'];
                   

                    ?>

      <div class="col-xs-12 col-sm-6 col-md-6">
          <h2 class="text-center" >Welcome <?php echo $c_name; ?></h2><br>
          <?php 
          if (!isset($_GET['my_orders'])) {
               if (!isset($_GET['edit_account'])) {
                   if (!isset($_GET['change_pass'])) {
                       if (!isset($_GET['delete_account'])) {
                        echo "<center>Go to main page to add Products:<a href='index.php'>ekah</a> </center><br>";
                        echo "<b>You Can see you orders :</b>";
                       }
                    }
               }               
          }

          ?>
          <?php 
          if (isset($_GET['edit_account'])) {
            include ("customer/edit_account.php");
          }
          if (isset($_GET['change_pass'])) {
            include ("customer/change_pass.php");
          }
          if (isset($_GET['delete_account'])) {
            include ("customer/delete_account.php");
          }
          ?>
          
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3">
                 <div class="col-md-10">
                 <h3><p>My Account</p></h3>
                   <ul class="list-group">

                     <li class="list-group-item"><a style="text-decoration: none;" href="my_account.php?my_orders">My Orders</a></li>
                     <li class="list-group-item"><a style="text-decoration: none;"  href="my_account.php?edit_account">Edit Account</a></li>
                     <li class="list-group-item"><a style="text-decoration: none;"  href="my_account.php?change_pass">Change Password</a></li>
                     <li class="list-group-item"><a  style="text-decoration: none;" href="my_account.php?delete_account">Delete Account</a></li>
                     <li class="list-group-item"><a  style="text-decoration: none;" href="logout.php">Logout</a></li>
                    </ul>
                 </div>
                 <div class="col-md-2"></div>
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