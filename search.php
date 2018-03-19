<?php
include 'admin_area/includes/db.php';
$q = $_GET['q'];
$query = "SELECT * FROM student_details where student_name like '%$q%' ";
$run_query = mysqli_query($con,$query);
while ($row_query =  mysqli_fetch_array($run_query)){

 $name =  $row_query['student_name']; 
 $id = $row_query['student_id'];
 echo "<a href='mail.php?m=$id'>$name</a> ";
 echo "<br>";
}


 ?>