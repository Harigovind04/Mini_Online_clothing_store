<?php
  include("includes/connect.php");
  include('functions/common_function.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <!--  CSS file -->
    <link rel="stylesheet" href="style.css">
    <style>
    .cart_img{
    width:80px;
    height:80px;
    object-fit:contain;
    }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="container-fluid p-0">
        <!-- First child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./images/logo.jpg" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?php
                            cart_item();?></sup></a>
                        </li>
                        
                    </ul>
                    
                </div>
            </div>
        </nav>

        <!-- calling cart function -->
        <?php
        cart();
        ?>

        <!-- Second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./users_area/user_login.php">Login</a>
                </li>
            </ul>
        </nav>

        <!-- Third child -->
        <div class="bg-light">
            <h3 class="text-center">Haute Harbor</h3>
            <p class="text-center">Discover the new you. Elevate your everyday style with our fashion-forward clothing. Redefining the way you look at fashion.</p>
        </div>

      <!-- fourth child -table -->
      <div class="container">
        <div class="row">
            <form action=" " method="post">
            <table class="table table-bordered text-center">
                
                    <!-- code to display dynamic data -->
                    <?php
                      
                        global $con;
                        $get_ip_add=getIPAddress();
                        $total_price=0;
                        $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
                        $result=mysqli_query($con,$cart_query);
                        $result_count=mysqli_num_rows($result);
                        if($result_count>0){
                            echo"<thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead> 
                        <tbody>";
                        
                        while($row=mysqli_fetch_array($result)){
                            $product_id=$row['product_id'];
                            $select_products="select * from `products` where product_id='$product_id'";
                            $result_products=mysqli_query($con,$select_products);
                            while($row_product_price=mysqli_fetch_array($result_products)){
                            $product_price=array($row_product_price['product_price']);
                            $price_table=$row_product_price['product_price'];
                            $product_title=$row_product_price['product_title'];
                            $product_image1=$row_product_price['product_image1'];
                            $product_values=array_sum($product_price);
                            $total_price+=$product_values;  
                         
                    
                    ?>
                    <!-- <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead> 
                        <tbody>
                    <tr> -->
                       <td><?php echo $product_title?></td>
                       <td><img src="./admin_area/product_images/<?php echo $product_image1?>" alt="" 
                       class="cart_img"></td>
                       <td><input type="text" name="qty" 
                       class="form-input w-50"></td>

                       <?php
                       $get_ip_add=getIPAddress();
                       if(isset($_POST['update_cart'])){
                        $quantities=$_POST['qty'];
                        $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                        $result_product_quantity=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantities;
                       }

                       ?>
                       <td>Rs.<?php echo $price_table?>/-</td>
                       <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                       <td>
                       <!-- <button class="bg-info px-3 py-2
                        border-0 mx-3">Update</button> -->
                        <input type="submit" value="Update cart"
                        class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                        <!-- <button class="bg-info px-3 py-2 
                        border-0 mx-3">Remove</button> -->
                       
                       <input type="submit" value="Remove cart"
                        class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                        </td>



                    </tr>
                    <?php
                    }}}
                    else{
                        echo "<h2 class='text-center text-danger'>Cart is Empty</h2>";
                    }
                     ?>
            </table>
            <!-- subtotal -->
            <?php
            $get_ip_add=getIPAddress();
            // $total_price=0;
            $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
            $result=mysqli_query($con,$cart_query);
            $result_count=mysqli_num_rows($result);
            if($result_count>0){
                echo" <h4 class='px-3'>Subtotal:<strong>Rs.$total_price/-</strong></h4>
                <a href='index.php' class ='bg-info px-3 py-2 border-0 mx-3 text-decoration-none'>Continue Shopping</a>
                <a href='./users_area/checkout.php' class='bg-primary px-3 py-2 border-0 text-light text-decoration-none'>Checkout</a>";
            
            }else{
                echo "<a href='index.php' class ='bg-info px-3 py-2 border-0 mx-3 text-decoration-none'>Continue Shopping</a>";
                
            }
        

            ?>
            <div class="d-flex mb-5">
                
            </div>
        </div>
      </div>
      </form>
<!-- function to remove items -->
   <?php
   function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
        echo $remove_id;
        $delete_query ="delete from `cart_details` where  product_id=$remove_id";
        $run_delete=mysqli_query($con,$delete_query);
        if($run_delete){
            echo "<script>window.open('cart.php','_self')</script>";
        }
    }
   }
}
echo $remove_item=remove_cart_item();
?>
        <!-- Last child -->
        <!-- include footer -->
        <?php include("./includes/footer.php")
        ?>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
