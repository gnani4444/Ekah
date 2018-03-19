<?php 
include 'admin_area/includes/db.php';

if(isset($_POST['submit'])){
$name =$_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$query ="INSERT INTO `student_details` (`student_id`, `student_name`, `student_email`, `student_phone`) VALUES (NULL, '$name', '$email', '$phone')";
if ($run_query = mysqli_query($con , $query )){
echo "<script>alert('Student details inserted Successfully ');</script>";
}
}

?>
<form action='in.php' method="POST"  >

Name :<input type="text" name="name"></input><br>
Email : <input type="text" name="email"></input><br>
Phone Number : <input type="text" name="phone"></input> <br>
<input type="submit" name="submit" value="submit"></input>
</form>
