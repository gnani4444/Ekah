<div class="pull-center"> <center>
<h2 align="center">Cash On Delivery</h2><br>
<p style="text-align: center;" ><img align="center" width="600" height="400"  src="images/Cash-on-Delivery.jpg" class="img-responsive"></p>
</center>
</div>
<!-- cart starts -->
<div class="container">
<div>

  <div class="row">
                 
  <div >
  <br><br>
  <div style="padding:10px; " >
  
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product(s)</th>
                    <th>Quantity</th>
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
                while ($p_price = mysqli_fetch_array($run_price_query)) {
                  $pro_id = $p_price['p_id'];
                  $quantity = $p_price['qty'];
                  $qty = $p_price['qty'];
                  $pro_price ="select * from products where product_id='$pro_id' ";
                  $run_pro_price = mysqli_query($con,$pro_price);
                  if ($pp_price = mysqli_fetch_array($run_pro_price)) {
                    $product_price = $pp_price['product_price'];
                    $product_title = $pp_price['product_title'];
                    $product_image = $pp_price['product_image'];

                    $product_id = $pp_price['product_id'];
                    
           
   ?>
              <tr><form action="cart.php" enctype="multipart/form-data" >
                <td><input type="hidden" name="fd" value="<?php echo  $product_id; ?>">  </td>
                <td><img src="admin_area/product_images/<?php echo $product_image; ?> " width="65" height="65" ></td>
                <td><a href="details.php?pro_id=<?php echo $product_id;?>"><?php echo $product_title ; ?></a> <br><a href="cart.php?del=<?php echo $product_id; ?>">delete</a> </td>
                <td> <input type="number" size="" value="" id="mySelect" onchange="myFunction()" name="qty" min="1" max="999" ><input type="submit" name="ad" value="save"></td>
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
              </form>
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
              <div class="pull-center" style="margin-right: 40px;" >
               
              <center>
              <button type="button" class="" data-toggle="modal" data-target="#myModal">Address For Shipping</button>
              <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Address For Shipping</h4>
                              </div>
                              <div class="modal-body pull-center">
                                <center>
                                  <div class="row pull-center">
                                  <div class="col-md-2" ></div>
    <div class="col-md-8 center">
      <form action="orders.php" method="POST" class="form-horizontal" role="form">
        <fieldset>

          <!-- Form Name -->
         

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 1</label>
            <div class="col-sm-10">
              <input type="text" name="line1" placeholder="Address Line 1" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 2</label>
            <div class="col-sm-10">
              <input type="text" name="line2" placeholder="Address Line 2" class="form-control">
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 3</label>
            <div class="col-sm-10">
              <input type="text" name="line3" placeholder="Address Line 3" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">City</label>
            <div class="col-sm-10">
              <input type="text" name="city" placeholder="City" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">State</label>
            <div class="col-sm-4">
              <input type="text" name="state" placeholder="State" class="form-control">
            </div>

            <label class="col-sm-2 control-label" for="textinput">Postcode</label>
            <div class="col-sm-4">
              <input type="text" name="postcode" placeholder="Post Code" class="form-control">
            </div>
          </div>



          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Country</label>
            <div class="col-sm-10">
              <input type="text" value="India"  class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-center">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" name="add_address" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->

</center>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        
                          </div>
                        </div>

             
              </center>
              </div>
  
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
<script>
function myFunction() {
    document.getElementById("demo").HTML = " ";
}
</script>