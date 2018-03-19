<?php
include 'admin_area/includes/db.php';
 ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","search.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>
<div class="col-sm-3"></div>
<div class="well col-sm-6" >
        <h2 class="text-center" style="padding:50px;"  >IIT Bhubaneswar Courier Service</h2>
        <form  class="form-group">
        <label class="col-sm-2" >Search :</label>
        <div class="col-sm-8">
        <input  class="form-control " type="text" size="30" onkeyup="showResult(this.value)">
        <div id="livesearch"></div>
        
        
       
        </div>
</form>

<div >
<?php
if(isset($_GET['m'])){
		$m = $_GET['m'];
	$detail_query = "SELECT * FROM student_details WHERE student_id = '$m' ";
	$run = mysqli_query($con,$detail_query);
	$row = mysqli_fetch_array($run);
	 $student_name = $row['student_name'];
	 $student_email = $row['student_email'];
	 $student_phone = $row['student_phone'];
         echo "<table>
<tr>  
        <td>Name :</td>
        <td>  $student_name </td>
</tr>
<tr>  
        <td>Email Id :</td>
        <td>  $student_email </td>
</tr>
<tr>  
        <td>Phone Number :</td>
        <td> $student_phone</td>
</tr>
</table><center>
<button class='btn-info' onclick='send();'>Send the mail</button></center>";
         
}
 ?>

</div>

 

</div>
<div class="col-sm-3"></div>
<div class="clearfix"></div>
</body>
</html>



<script type="text/javascript">
	
	function send() {
		document.write("<?php 
                $insert_table = " INSERT INTO `data` (`id`, `student_id`, `student_name`, `student_email`, `student_phone`, `c_boy_name`, `c_boy_phone`) VALUES (NULL, '$m', '$student_name', '$student_email', '$student_phone', '', '') "; 
                $run_q = mysqli_query($con , $insert_table);
                $id = mysqli_insert_id($con);
                
                $to = $student_email;
                $Subject = " Recieved a Parcel / Letter ";
                $message = "You Have Recieved a parcel , Please collect it From Hostel office  
                Regard No : $id 
                Name : $student_name
                Phone Number : $student_phone ";
                if (mail($to , $Subject , $message )){
		   ?>");
                   
                   
                   
                   alert('Mail Has been Sent Successfully!'); 
                   window.open('mail.php' ,'_self');
                   
                   
                   
                   
                   document.write(" <?php
		}else {
			?> ");
                        
                        
                        alert('Problem with sendind Email');  
                        
                        
               document.write("<?php
		} 
                
               
		?>");

 }
</script>
 