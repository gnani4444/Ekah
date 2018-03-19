<?php
include ("includes/db.php");

                   $user = $_SESSION['customer_email'];
                   $get_user = "select * from customers where customer_email ='$user' ";
                   $run_get_user = mysqli_query($con,$get_user);
                   $row_get_user = mysqli_fetch_array($run_get_user);
                   $c_id = $row_get_user['customer_id'];
                   $c_name = $row_get_user['customer_name'];
                    $c_email = $row_get_user['customer_email'];
                    $c_contact= $row_get_user['customer_contact'];               
                    ?>


<div id="signupbox" style=" margin-top:50px" class="mainbox col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Update Your Account</div>
                        
                             </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" action="my_account.php?c_id=<?php echo $c_id; ?>" method="POST">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="c_name" value="<?php echo $c_name; ?>"  placeholder="Name" required>
                                    </div>
                                </div><div class="form-group">
                                    <label for="Contact" class="col-md-3 control-label">Contact</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="c_cont" value="<?php echo $c_contact; ?>" placeholder="Contact" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="c_email" value="<?php echo $c_email; ?>" placeholder="Email Address" required>
                                    </div>
                                </div>
                                
                                <!--<div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="c_pass" placeholder="Password" required>
                                    </div>
                                </div>-->
                                    
                                <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">Invitation Code</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="icode" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="btn-sig" id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Update Account</button>
                                        <span style="margin-left:8px;"></span>  
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 