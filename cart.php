<!-- connect file -->
<?php 
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readify E-Bookstore Cart</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
      .cart_image{
        width:80px;
        height:120px;
        object-fit:contain;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- firstchild -->
        <nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <img src="./image/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=".\users_area\user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- calling cart function --> 
<?php
  cart();
?>
<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
    <?php
    if(!isset($_SESSION['username'])){
      echo "<li class='nav-item'>
      <a class='nav-link' href='#'>Welcome to Readify E-Bookstore</a>
  </li>";
    }else{
      echo "<li class='nav-item'>
        <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
    </li>";
    }
    if(!isset($_SESSION['username'])){
      echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/user_login.php'>Login</a>
    </li>";
    }else{
      echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/logout.php'>Logout</a>
    </li>";
    }
    ?>
    </ul>
</nav>
<!-- third child -->
<div class="bg-light">
    <h3 class="text-center">Readify E-Bookstore</h3>
    <p class="text-center">A World of Books</p>
</div>
<!-- fourth child-table --> 
<div class="container">
    <div class="row">
      <form action="" method="post">
        <table class="table table-bordered text-center">
            
              <!-- php code to display dynamic data in cart --> 
              <?php
              
              $get_ip_address=getIPAddress();
              $total_price=0;
              $cart_query="Select * from `cart_details` where ip_address='$get_ip_address'";
              $result=mysqli_query($con,$cart_query);
              $result_count=mysqli_num_rows($result);
              if($result_count>0){
                  echo "<thead>
                  <tr>
                      <th>Book Name</th>
                      <th>Book Image</th>
                      <th>Quantity</th>
                      <th>Total Price</th>
                      <th>Remove</th>
                      <th colspan='2'>Operations</th>
                  </tr>
              </thead>
              <tbody>";
              
              while($row=mysqli_fetch_array($result)){
                $book_id=$row['book_id'];
                $select_books="Select * from `books` where book_id='$book_id'";
                $result_books=mysqli_query($con,$select_books);
                while($row_book_price=mysqli_fetch_array($result_books)){
                    $book_price=array($row_book_price['book_price']);
                    $price_table=$row_book_price['book_price'];
                    $book_name=$row_book_price['book_name'];
                    $book_image1=$row_book_price['book_image1'];
                    $book_values=array_sum($book_price);
                    $total_price+=$book_values;
                
              ?>
                <tr>
                    <td><?php echo $book_name ?></td>
                    <td><img src="./admin/book_images/<?php echo $book_image1 ?>" alt="" class="cart_image"></td>
                    <td><input type="text" name="qty" class="form-input w-50"></td>
                    <?php 
                      $get_ip_address=getIPAddress(); 
                      if(isset($_POST['update_cart'])){
                        $quantities=$_POST['qty'];
                        $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_address'";
                        $result_books_quantity=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantities;
                      }
                    ?>
                    <td><?php echo $price_table ?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $book_id?>"></td>
                    <td>
                        <!--<button class="bg-info border-0 px-3 py-2 mx-3">Update</button>--> 
                        <input type="submit" value="Update Cart" class="bg-info border-0 px-3 py-2 mx-3" name="update_cart">
                        <!--<button class="bg-info border-0 px-3 py-2 mx-3">Remove</button>--> 
                        <input type="submit" value="Remove Cart" class="bg-info border-0 px-3 py-2 mx-3" name="remove_cart">
                    </td>
                </tr>
                <?php
                  }
                }
              }
              else{
                echo "<h2 class='text-center text-danger'>Cart is Empty</h2>";
              }
                ?>
            </tbody>
        </table>
        <!--subtotal -->
        <div class="d-flex mb-5">
          <?php
            $get_ip_address=getIPAddress();
           
            $cart_query="Select * from `cart_details` where ip_address='$get_ip_address'";
            $result=mysqli_query($con,$cart_query);
            $result_count=mysqli_num_rows($result);
            if($result_count>0){
              echo "<h4 class='px-3'>Subtotal : <strong class='text-info px-3'> $total_price/-</strong></h4>
              <input type='submit' value='Continue Shopping' class='bg-info border-0 px-3 py-2 mx-3' name='continue_shopping'>
              <button class='bg-secondary border-0 px-3 py-2 text-light'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
            }else{
              echo "<input type='submit' value='Continue Shopping' class='bg-info border-0 px-3 py-2 mx-3' name='continue_shopping'>";
            }
            if(isset($_POST['continue_shopping'])){
              echo "<script>window.open('index.php','_self')</script>";
            }
          ?>

        </div>
    </div>
</div>
</form>
<!-- function to remove ite from the cart--> 
<?php
function remove_cart_item(){
  global $con;
  if(isset($_POST['remove_cart'])){
    foreach($_POST['removeitem'] as $remove_id){
      echo $remove_id;
      $delete_query="Delete from `cart_details` where book_id=$remove_id";
      $run_delete=mysqli_query($con,$delete_query);
      if($run_delete){
        echo "<script>window.open('cart.php','_self') </script>";
      }
    }
  }
}
echo $remove_item=remove_cart_item();

?>
<!-- last child--> 
<!-- include footer --> 
<?php include("./includes/footer.php")?>
</div>
<!-- bootstrap js link -->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>