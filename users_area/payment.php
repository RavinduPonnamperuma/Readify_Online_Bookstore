<?php
 include('../includes/connect.php');
 include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
        .paymentimage{
            width:100%;
            margin:auto;
            display:block;
            
        }
    </style>
</head>
<body>
    <!--php code to access user id-->
    <?php
    $user_ip=getIPAddress();
    $get_user="Select * from `user_table` where user_ip='$user_ip'";
    $result=mysqli_query($con,$get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query['user_id'];


    ?>
   <div class="container">
    <h2 class="text-center text-info">Pay With</h2>
    <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="col-md-6">
        <a href="https://www.payhere.lk" target="_blank"><img src="../image/payherelogo.png" alt="" width="250" class="paymentimage"/></a>
        </div>
        <div class="col-md-6">
        <a href="orders.php?user_id=<?php echo $user_id?>"><img src="../image/cashondelivery.jpg" alt="" class="paymentimage"></a>
        </div>
    </div>
   </div>
</body>
</html>