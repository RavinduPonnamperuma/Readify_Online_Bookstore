<?php
include('../includes/connect.php');
include('../functions/common_function.php');

//we shoud know witch admin is active?
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->

    <style>
        body{
            overflow: hidden;
        }

    </style>
</head>
<body>
    <div class="container-fluid m-3" >
        <h2 class="text-center mb-5">Admin Login</h2>

        <div class="row d-flex justify-content-center align-items-center" >
            <div class="col-lg-6 col-xl-5"  >
                <img src="../image/admin.jpg" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4"  >
               <form action="" method="post">
                <div class="form-outline mb-4" >
                    <label for="username" class="form-label" >Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">

                </div>
              
                <div class="form-outline mb-4" >
                    <label for="password" class="form-label" >Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your Password" required="required" class="form-control">

                </div>
                
                <div>
                    <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_Login" value="Login" >
                    <div class="small fw-bold mt-2 pt-1">Dont you have an account? <a href="admin_registration.php" class="link-danger">Register</a> </div>
                </div>

               </form>

            </div>

        </div>

    </div>
</body>
</html>
<?php
if (isset($_POST['admin_Login'])) {
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    $select_query = "Select * from `admin_tabel` where admin_name='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        if (password_verify($user_password, $row_data['admin_password'])) {
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('adminindex.php','_self')</script>";
         
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>