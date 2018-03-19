<?php 
session_start();
include ('admin_area/includes/db.php');
$id = $_GET['i'];
$c_email=$_GET['c'];
$c_pass=$_GET['l'];
$insert="UPDATE customers SET customer_email='$c_email', customer_pass = '$c_pass' WHERE customer_id ='$id' ";
$run = mysqli_query($con,$insert);
if($run){
        $_SESSION['customer_email']=$c_email;
        echo "<script>alert('Account has been created successfully, Thanks!') </script>";
        echo "<script>window.open('index.php','_self') </script>";
}


?>