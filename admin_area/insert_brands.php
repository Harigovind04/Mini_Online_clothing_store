<?php  
   include('../includes/connect.php');
   if(isset($_POST['insert_brands']))
  {
      $brand_title=$_POST['brand_title'];

      $select_query="select * from `brands` where brand_title='$brand_title' ";
      $result_select=mysqli_query($con,$select_query);
      $number=mysqli_num_rows($result_select);
      if($number>0){
         echo "<script>alert('This brand is already present inside the database')</script>";

      }
      else
    {

      
      $insert_query="insert into  `brands` (brand_title) values ('$brand_title')";
      $result=mysqli_query($con,$insert_query);
      if($result){
         echo "<script>alert('brand has been inserted successfully')</script>";
      }

    } 

   }



?>



<h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2 w-50 m-auto">
   <div class="input-group mb-3 w-90 mb-2">
      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
      <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="Username" aria-describedby="basic-addon1">
   </div>

   <div class="input-group w-10 mb-2 m-auto">
       <input type="submit" class="bg-info border-0 p-2 my-2" name="insert_brands" value="Insert Brands" aria-label="Username" aria-describedby="basic-addon1" > 
      
   
   </div>
</form>