
<table width="795" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View All Brands Here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>S No:</th>
		<th>Category</th>
		<th>Brand Title</th>
                
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
        
        $get_cat= "select * from categories ";
        $run_query = mysqli_query($con,$get_cat);
        $i=0;
        
        while ($row_cat= mysqli_fetch_array($run_query)){
         $cat_id = $row_cat['cat_id'];
         $brand_cat_name = $row_cat['cat_title'];
        
        $get_brands = "select * from brands where brand_cat_id = '$cat_id' ";
        $run_brand = mysqli_query($con,$get_brands);
        while ($row_brand = mysqli_fetch_array($run_brand)){
         $brand_id = $row_brand['brand_id'];
        $brand_title = $row_brand['brand_title'];
         $i++;
        
        ?>
        
        <tr align="center">
		<td><?php echo $i;?></td>
		
		
                <td><?php echo $brand_cat_name;?> </td>
                <td><?php echo $brand_title;?></td>
		<td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
		<td><a href="delete_brand.php?delete_brand=<?php echo $brand_id;?>">Delete</a></td>
	
	</tr>
        
        <?php    
        } }
        ?>
        
      </table>

<div><a href="index.php?view_brands_cat">View the Brands Orderly</a> </div>







