<?php include('../includes/connect.php');
include('../functions/common_function.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
     <!-- Bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter username" autocomplete="off" required="required" name="user_username" />
                    </div>
                    <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email"   id="user_email" class="form-control" placeholder="Enter email" autocomplete="off" required="required" name="user_email" />
                    </div>
                    <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" id="user_image" class="form-control"  required="required" name="user_image" />
                    </div>
                    <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter password" autocomplete="off" required="required" name="user_password" />
                    </div>
                    <div class="form-outline mb-4">
                    <label for="conf_user_password" class="form-label">Confirm Password</label>
                    <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm password" autocomplete="off" required="required" name="conf_user_password" />
                    </div>
                    <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter address" autocomplete="off" required="required" name="user_address" />
                    </div>
                    <div class="form-outline mb-4">
                    <label for="user_mobile" class="form-label">Contact</label>
                    <input type="text" id="user_mobiles" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_mobile" />
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register" >
                        <p>Already have an account ?<a href="user_login.php"> Login</a></p>
                    </div>
            </form>
            </div>
        </div>
    </div>
    
</body>
</html>

<!-- php code -->
<?php
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_mobile=$_POST['user_mobile'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();


    // select query
    $select_query="select * from `user_table` where username='$user_username' or user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('Username already exists')</script>";
    }else if($user_password!=$conf_user_password){
        echo "<script>alert('Passwords do not match')</script>";

    }
    else{



    // insert_query
    move_uploaded_file($user_image_tmp,'./user_images/$user_image');
    $insert_query="insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile)
    values ('$user_username','$user_email','$user_password','$user_image','$user_ip','$user_address','$user_mobile')";
    $sql_execute=mysqli_query($con,$insert_query);

    

    }



}
?>