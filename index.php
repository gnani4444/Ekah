<?php
session_start();
include 'admin_area/includes/db.php';
include 'functions/function.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Ekah</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
         <script type="text/javascript" src="js/bootstrap.min.js" ></script>     
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
                 <!--<script src="js/bootstrap.min.js"></script>-->
                
                 <link rel="stylesheet" href="css/bootstrap.min.css" >
                 <noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		
		</noscript>
		<link rel="stylesheet" href="css/style-xlarge.css" />

	
                
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->



		<!-- Add Product -->
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
        xmlhttp.open("GET","admin_area/getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<style type="text/css">
	#badg {
     background-color: #0000FF;
    vertical-align: top;
    }
</style>

 <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
  
  </style>
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header">
				<h1><a href="index.php">EKAH</a></h1>
				<nav id="nav">
					<ul>
       <li><a href="new.php">Furniture</a></li>
       <li><a href="new.php">Books</a></li>
       <li><a href="new.php">Mobiles</a></li>
       <li><a href="new.php">Laptops</a></li>
       <li><a href="new.php">Automobiles</a></li>
       <li><a href="new.php">Wedding Dresses</a></li>
       <li><a href="new.php">Electronics</a></li>
						<li><a href="new.php">Home</a></li>
                                                <li><a  href="cart.php"><span class="glyphicon glyphicon-shopping-cart"><span id="badg" class="badge badge-warning"><?php total_items();  ?> </span></span></a></li>

                        <?php
                        if (isset($_SESSION['customer_email'])) {
                        	echo "<li><a href='logout.php'>Logout</a></li>";
                        }else{
                        	echo "<li><a href='checkout.php'>login||Register</a></li>";
                        }
                         ?>
                        
						
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h2>EKAH</h2>
                                <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4">
                                        <form action="results.php?search=search" >
                                          <div class="input-group">
                                            <input type="text" name="user_search" class="form-control" placeholder="Search for...">
                                            <span class="input-group-btn">
                                              <button class="btn btn-default" name="Search" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                            </span>
                                          </div><!-- /input-group -->
                                         </form>
                                        </div><!-- /.col-lg-6 -->
                                      <div class="col-lg-4"></div>
                                      </div><!-- /.row -->
				<ul class="actions">
					<li>
					<?php 
					if (!isset($_SESSION['customer_email'])) {
						
						
					}else{
						
						$c_email = $_SESSION['customer_email'];
          				$get_name = "select * from customers where customer_email ='$c_email' ";
          				$run_get_name = mysqli_query($con , $get_name);
          				$row_get_name = mysqli_fetch_array($run_get_name);
          				$id = $row_get_name['customer_id'];
					}
					?>

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
		move_uploaded_file($product_image_tmp, "admin_area/product_images/$product_image");
                
                $product_image_2 = $_FILES['product_image_2']['name'];
		$product_image_tmp_2 = $_FILES['product_image_2']['tmp_name'];
		move_uploaded_file($product_image_tmp_2, "admin_area/product_images/$product_image_2");
                $product_image_3 = $_FILES['product_image_3']['name'];
		$product_image_tmp_3 = $_FILES['product_image_3']['tmp_name'];
		move_uploaded_file($product_image_tmp_3, "admin_area/product_images/$product_image_3");
                
                

		//insertion in to db 
		$insert_local = mysqli_query($con ,"INSERT INTO `products` (`product_id`,`product_insert_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`,`product_image_2`,`product_image_3`, `product_keyword`) VALUES (NULL,'$id','$product_cat', '$product_brand', '$product_title', '$product_price', '$product_desc', '$product_image','$product_image_2','$product_image_3', '$product_keywords')" );
		if ($insert_local) {
			$get_id=mysqli_insert_id($con);
			echo "<script>alert('Product has been inserted');</script> ";
			echo "<script>window.open('details.php?pro_id=$get_id','_self');</script>";
		}

		
	}



?>

						<!-- Modal -->
						<div style="color: black;" id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog modal-lg">

						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Add Product</h4>
						      </div>
						      <div class="modal-body">
						        	<form action="index.php" method="POST" enctype="multipart/form-data" class="" role="form">
						        	<fieldset>
						           		<div class="form-group">
						        			<label class="col-sm-2 col-md-3 control-label" for="textinput">Product Title:</label>
						        			<div class="col-sm-6">
						        				<input type="text" placeholder="Product Title" class="form-control" name="product_title" required>
						        			</div>
						        		</div><br>
						        	</fieldset>
						        		<fieldset>
						        		<div class="form-group">
						        			<label class="col-sm-2 col-md-3 control-label" for="textinput">Product Category:</label>
						        			<div class="col-sm-6">
						        				<select name="product_cat" class="form-control" onchange="showUser(this.value)" required >
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
						        			</div>
						        		</div><br>
						        		</fieldset>
						        		<fieldset>
						        		<div class="form-group">
						        			<label class="col-sm-2 col-md-3 control-label" for="textinput">Product Brand:</label>
						        			<div class="col-sm-6">
						        				<select name="product_brand" class="form-control" id="txtHint" ></select>
						        			</div>
						        		</div>
						        	</fieldset>
						        	<fieldset>
						        		<!--<legend>Add Product</legend> -->
						        		<div class="form-group">
						        			<label class="col-sm-2 col-md-3 control-label" for="textinput">Product Image:</label>
						        			
						        			<div class="col-sm-2">
						        				<input type="file" name="product_image" required  >
						        			</div><br><div class="col-sm-12"></div><div class="col-sm-2 col-md-3"></div>
						        			<div class="col-sm-2">
						        				<input type="file" name="product_image_2" required  >
						        			</div><br><div class="col-sm-12"></div><div class="col-sm-2 col-md-3"></div>
						        			<div class="col-sm-2">
						        				<input type="file" name="product_image_3" required  >
						        			</div><br>

						        		</div>
						        		</fieldset>

						        		<fieldset>
						           		<div class="form-group">
						        			<label class="col-sm-2 col-md-3 control-label" for="textinput">Product Price:</label>
						        			<div class="col-sm-6">
						        				<input type="number" placeholder="Product Price" class="form-control" name="product_price" required  >
						        			</div>
						        		</div><br>
						        	</fieldset>
						        	<fieldset>
						           		<div class="form-group">
						        			<label class="col-sm-2 col-md-3 control-label" for="textinput">Product Description:</label>
						        			<div class="col-sm-6">
						        				<textarea name="product_desc" class="form-control" rows="10" cols="30"  ></textarea> 
						        			</div>
						        		</div><br>
						        	</fieldset>
						        	<fieldset>
						           		<div class="form-group">
						        			<label class="col-sm-2 col-md-3 control-label" for="textinput">Product Keywords:</label>
						        			<div class="col-sm-6">
						        				<input type="text" placeholder="Product Keywords" class="form-control" name="product_keywords" size="40" required >
						        			</div>
						        		</div><br>
						        	</fieldset>
						        	<fieldset>
						        		<input type="submit" name="insert_product_now" value="Insert Now">
						        		<input type="reset" name="">
						        	</fieldset>


						        	</form>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>

						  </div>
						</div>
					</li>


                                        <li>
                                            <button type="button" style="background-color:  #3BA666;" class="btn  btn-lg" data-toggle="modal" data-target="#myMod">About</button>
					</li>
                                        <div style="color:#333333;" id="myMod" class="modal fade" role="dialog">
                                                          <div class="modal-dialog">
                                                        
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title"><p>About</p></h4>
                                                              </div>
                                                              <div class="modal-body">
                                                                Ekah Helps you to buys products in your budjet
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                              </div>
                                                            </div>
                                                        
                                                          </div>
                                                        </div>
				</ul>
			</section>


<section style="padding :0px; border:0; margin:0;"> 

  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators relative">
    <div class="absolute" style="position : absolute; top :20%; left:30% ; right:30%; ">
        <form action="results.php?search=search" >
                                          <div class="input-group">
                                            <input style="background-color:green;" type="text" name="user_search" class="form-control" placeholder="Search for...">
                                            <span class="input-group-btn">
                                              <button class="btn btn-default" name="Search" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                            </span>
                                          </div><!-- /input-group -->
                                         </form>


</div>
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="images/iphone7.jpg" alt="Chania" width="460" height="345">
        <div class="carousel-caption">
          <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
        </div>
      </div>

      <div class="item">
        <img src="images/psp3.jpg" alt="Chania" width="460" height="345">
        <div class="carousel-caption">
          <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
        </div>
      </div>
    
      <div class="item">
        <img src="images/banner.jpg" alt="Flower" width="460" height="345">
        <div class="carousel-caption">
          <h3>Flowers</h3>
          <p>Beatiful flowers in Kolymbari, Crete.</p>
        </div>
      </div>

      <div class="item">
        <img src="images/iphone7.jpg" alt="Flower" width="460" height="345">
        <div class="carousel-caption">
          <h3>Flowers</h3>
          <p>last one</p>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>



</section>


		<!-- One -->
			<section id="one" class="wrapper style1 align-center">
				<div class="container">
					<header>
						<h2>About : </h2>
						<p>Buy and Rent the products</p>
					</header>
					<div class="row 200%">
						<section class="4u 12u$(small)">
							<a style="text-decoration:none; color:white;" href="checkout.php"><i class="icon big rounded fa-user "></i>
                                                        <p>Create an Account </p></a>
						</section>
						<section class="4u 12u$(small)">
      <a style="text-decoration:none; color:white;" href="checkout.php">
							<i class="icon big rounded fa-share-square-o"></i>
							<p>Rent your Products.</p>
                    </a>
						</section>
						<section class="4u$ 12u$(small)">
							<i class="icon big rounded fa-money"></i>
							<p>Earn money</p>
						</section>
					</div>
				</div>
     <div id=""  style="padding:20px;" class="container align-center" >
     <?php 
					if (!isset($_SESSION['customer_email'])) {
						echo "<button type='button' style='background-color:  #278484;' class='btn  btn-lg'  > <a style='text-decoration:none; color:white;' href='checkout.php'>Add Product</a></button>";
						
					}else{
						echo "<button type='button' style='background-color:  #278484;' class='btn  btn-lg' data-toggle='modal' data-target='#myModal'>Add Product</button>";
						$c_email = $_SESSION['customer_email'];
          				$get_name = "select * from customers where customer_email ='$c_email' ";
          				$run_get_name = mysqli_query($con , $get_name);
          				$row_get_name = mysqli_fetch_array($run_get_name);
          				$id = $row_get_name['customer_id'];
					}
					?>
     </div>        
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2 align-center">
				<div class="container">
					<header>
						<h2>Ekah Specials :</h2>
						<p>Dream has no limits . Ekah helps you to get you dream products. </p>
					</header>
					<div class="row">
						<section class="feature 6u 12u$(small)">
							<img class="image fit" src="images/psp3.jpg" alt="" />
							<h3 class="title">Sony PSP 3</h3>
							
						</section>
						<section class="feature 6u$ 12u$(small)">
							<img class="image fit" src="images/iphone7.jpg" alt="" />
							<h3 class="title">Iphone 7s</h3>
							
						</section>
                                                <section class="feature 6u 12u$(small)">
							<img class="image fit" src="images/psp3.jpg" alt="" />
							<h3 class="title">Sony PSP 3</h3>
							
						</section>
						<section class="feature 6u$ 12u$(small)">
							<img class="image fit" src="images/iphone7.jpg" alt="" />
							<h3 class="title">Iphone 7s</h3>
							
						</section>
                                                
						
					</div>
					<footer>
						<ul class="actions">
							<li>
								<a href="#" class="button alt big">Learn More</a>
							</li>
						</ul>
					</footer>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<div class="row">
						<section class="4u 6u(medium) 12u$(small)">
							<h3>Lorem ipsum</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, cumque!</p>
							<ul class="alt">
								<li><a href="#">Lorem ipsum dolor sit amet.</a></li>
								<li><a href="#">Quod adipisci perferendis et itaque.</a></li>
								<li><a href="#">Itaque eveniet ullam, veritatis reiciendis?</a></li>
								<li><a href="#">Accusantium repellat accusamus a, soluta.</a></li>
							</ul>
						</section>
						<section class="4u 6u$(medium) 12u$(small)">
							<h3>Nostrum, repellat!</h3>
							<p>Tenetur voluptate exercitationem eius tempora! Obcaecati suscipit, soluta earum blanditiis.</p>
							<ul class="alt">
								<li><a href="#">Lorem ipsum dolor sit amet.</a></li>
								<li><a href="#">Id inventore, qui necessitatibus sunt.</a></li>
								<li><a href="#">Deleniti eum odit nostrum eveniet.</a></li>
								<li><a href="#">Illum consectetur quibusdam eos corporis.</a></li>
							</ul>
						</section>
						<section class="4u$ 12u$(medium) 12u$(small)">
							<h3>Contact Us</h3>
							<ul class="icons">
								<li><a href="#" class="icon rounded fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon rounded fa-facebook"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon rounded fa-pinterest"><span class="label">Pinterest</span></a></li>
								<li><a href="#" class="icon rounded fa-google-plus"><span class="label">Google+</span></a></li>
								<li><a href="#" class="icon rounded fa-linkedin"><span class="label">LinkedIn</span></a></li>
							</ul>
							<ul class="tabular">
								<li>
									<h3>Address</h3>
									Ekah office<br>
									IIT HYDERABAD
								</li>
								<li>
									<h3>Mail</h3>
									<a href="#">ram20111996@gmail.com</a>
								</li>
								<li>
									<h3>Phone</h3>
									9603221480
								</li>
							</ul>
						</section>
					</div>
					<ul class="copyright">
						<li>&copy; Ekah. All rights reserved.</li>
						<li>Design: <a href="https://www.facebook.com/vanam.gnaneshwar.3" target="_blank" >Designing team of Ekah</a></li>
						
					</ul>
				</div>
			</footer>

	</body>
</html>



