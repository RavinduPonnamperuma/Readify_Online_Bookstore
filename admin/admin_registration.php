<?php
//connect to the database
include('../includes/connect.php');
//some importent funtions
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin registration</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->

    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>

        <div class="row d-flex justify-content-center align-items-center">

            <div class="col-lg-6 col-xl-5">
                <img src="../image/admin.jpg" alt="Admin Registration" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">

                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username"
                            required="required" class="form-control">

                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="username" name="email" placeholder="Enter your email"
                            required="required" class="form-control">

                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password"
                            required="required" class="form-control">

                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            placeholder="Enter your Confirm Password" required="required" class="form-control">

                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration"
                            value="Register">
                        <div class="small fw-bold mt-2 pt-1">Do you already have an account? <a href="admin_login.php"
                                class="link-danger">Login</a> </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
</body>

</html>

<!-- php -->
<?php
if (isset($_POST['admin_registration'])) {
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $confirm_user_password = $_POST['confirm_password'];


    //select the all the data from databse
    $select_query = "Select * from `admin_tabel` where admin_name='$user_username' or admin_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    if ($rows_count > 0) {
        echo "<script>alert('Admin Name and Email Already Exist')</script>";
    } elseif ($user_password != $confirm_user_password) {
        echo "<script>alert('Passwords do not match')</script>";
    }

    //insert to the admin database
    else {
        $insert_query = "insert into `admin_tabel` (admin_name,admin_email,admin_password) 
            values('$user_username','$user_email','$hash_password')";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($insert_query) {
            echo "<script>alert('Data insert sucsessfully')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        }

    }

}

?>