<?php
// including connect file


// getting books
function getbooks(){
  global $con;
  // condition to check isset or not
  if(!isset($_GET['category'])){
    $select_query="Select * from `books` order by rand()";
                $result_query=mysqli_query($con,$select_query);
                //$row=mysqli_fetch_assoc($result_query);
                //echo $row['book_name'];
                while($row=mysqli_fetch_assoc($result_query)){
                  $book_id=$row['book_id'];
                  $book_name=$row['book_name'];
                  $book_description=$row['book_description'];
                  $book_image1=$row['book_image1'];
                  $book_price=$row['book_price'];
                  $category_id=$row['category_id'];
                  echo "<div class='col-md-4 mb-2'>
                  <div class='card'>
                      <img src='./admin/book_images/$book_image1' class='card-img-top' alt='$book_name'>
                      <div class='card-body'>
                      <h5 class='card-title'>$book_name</h5>
                      <p class='card-text'>$book_description</p>
                      <p class='card-text'>Price : $book_price/-</p>
                      <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Add to Cart</a>
                      <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>View More</a>
                      </div>
                  </div>
                  </div>";
                }
}
}

//getting all books
function get_all_books(){
  global $con;
  // condition to check isset or not
  if(!isset($_GET['category'])){
    $select_query="Select * from `books` order by rand()";
                $result_query=mysqli_query($con,$select_query);
                //$row=mysqli_fetch_assoc($result_query);
                //echo $row['book_name'];
                while($row=mysqli_fetch_assoc($result_query)){
                  $book_id=$row['book_id'];
                  $book_name=$row['book_name'];
                  $book_description=$row['book_description'];
                  $book_image1=$row['book_image1'];
                  $book_price=$row['book_price'];
                  $category_id=$row['category_id'];
                  echo "<div class='col-md-4 mb-2'>
                  <div class='card'>
                      <img src='./admin/book_images/$book_image1' class='card-img-top' alt='$book_name'>
                      <div class='card-body'>
                      <h5 class='card-title'>$book_name</h5>
                      <p class='card-text'>$book_description</p>
                      <p class='card-text'>Price : $book_price/-</p>
                      <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Add to Cart</a>
                      <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>View More</a>
                      </div>
                  </div>
                  </div>";
                }
}

}

//getting unique categories
function get_unique_categories(){
  global $con;
  // condition to check isset or not
  if(isset($_GET['category'])){
    $category_id=$_GET['category'];
    $select_query="Select * from `books` where category_id=$category_id";
                $result_query=mysqli_query($con,$select_query);
                $num_of_rows=mysqli_num_rows($result_query);
                if($num_of_rows==0){
                  echo "<h2 class='text-center text-danger'>No books found for this category</h2>";
                }
                //$row=mysqli_fetch_assoc($result_query);
                //echo $row['book_name'];
                while($row=mysqli_fetch_assoc($result_query)){
                  $book_id=$row['book_id'];
                  $book_name=$row['book_name'];
                  $book_description=$row['book_description'];
                  $book_image1=$row['book_image1'];
                  $book_price=$row['book_price'];
                  $category_id=$row['category_id'];
                  echo "<div class='col-md-4 mb-2'>
                  <div class='card'>
                      <img src='./admin/book_images/$book_image1' class='card-img-top' alt='$book_name'>
                      <div class='card-body'>
                      <h5 class='card-title'>$book_name</h5>
                      <p class='card-text'>$book_description</p>
                      <p class='card-text'>Price : $book_price/-</p>
                      <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Add to Cart</a>
                      <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>View More</a>
                      </div>
                  </div>
                  </div>";
                }
}
}


//displaying categories in side navigation bar 
function getcategories(){
  global $con;
  $select_categories="Select * from `categories`";
            $result_categories=mysqli_query($con,$select_categories);
            //$row_data=mysqli_fetch_assoc($result_categories);
            //echo $row_data['category_name'];
            while($row_data=mysqli_fetch_assoc($result_categories)){
                $category_name=$row_data['category_name'];
                $category_id=$row_data['category_id'];
                echo "<li class='nav-item'>
                <a href='index.php?category=$category_id' class='nav-link text-light'>$category_name</a>
                </li>";
            }
            
}

//searching books
function search_book(){
  global $con;
  if(isset($_GET['search_data_book'])){
    $search_data_value=$_GET['search_data'];
      $search_query="Select * from `books` where book_keywords like '%$search_data_value%'";
                $result_query=mysqli_query($con,$search_query);
                $num_of_rows=mysqli_num_rows($result_query);
                if($num_of_rows==0){
                  echo "<h2 class='text-center text-danger'>No books found for this category</h2>";
                }
                while($row=mysqli_fetch_assoc($result_query)){
                  $book_id=$row['book_id'];
                  $book_name=$row['book_name'];
                  $book_description=$row['book_description'];
                  $book_image1=$row['book_image1'];
                  $book_price=$row['book_price'];
                  $category_id=$row['category_id'];
                  echo "<div class='col-md-4 mb-2'>
                  <div class='card'>
                      <img src='./admin/book_images/$book_image1' class='card-img-top' alt='$book_name'>
                      <div class='card-body'>
                      <h5 class='card-title'>$book_name</h5>
                      <p class='card-text'>$book_description</p>
                      <p class='card-text'>Price : $book_price/-</p>
                      <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Add to Cart</a>
                      <a href='book_details.php?book_id=$book_id' class='btn btn-secondary'>View More</a>
                      </div>
                  </div>
                  </div>";
                }
}
}
//view details function
function view_details(){
  global $con;
  // condition to check isset or not
  if(isset($_GET['book_id'])){
  if(!isset($_GET['category'])){
    $book_id=$_GET['book_id'];
    $select_query="Select * from `books` where book_id=$book_id";
                $result_query=mysqli_query($con,$select_query);
                //$row=mysqli_fetch_assoc($result_query);
                //echo $row['book_name'];
                while($row=mysqli_fetch_assoc($result_query)){
                  $book_id=$row['book_id'];
                  $book_name=$row['book_name'];
                  $book_description=$row['book_description'];
                  $book_image1=$row['book_image1'];
                  $book_image2=$row['book_image2'];
                  $book_image3=$row['book_image3'];
                  $book_price=$row['book_price'];
                  $category_id=$row['category_id'];
                  echo "<div class='col-md-4 mb-2'>
                  <div class='card'>
                      <img src='./admin/book_images/$book_image1' class='card-img-top' alt='$book_name'>
                      <div class='card-body'>
                      <h5 class='card-title'>$book_name</h5>
                      <p class='card-text'>$book_description</p>
                      <p class='card-text'>Price : $book_price/-</p>
                      <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Add to Cart</a>
                      <a href='index.php' class='btn btn-secondary'>Go Home </a>
                      </div>
                  </div>
                  </div>
                  
                  <div class='col-md-8'>
                    <!-- related images --> 
                        <div class='row'>
                            <div class='col-md-12'>
                                <h4 class='text-center text-info mb-5'>Related Images</h4>
                            </div>
                            <div class='col-md-6'>
                                <img src='./admin/book_images/$book_image2' class='card-img-top' alt='$book_name'>
                            </div>
                            <div class='col-md-6'>
                                <img src='./admin/book_images/$book_image3' class='card-img-top' alt='$book_name'>
                            </div>
                        </div>
                 </div>
                  ";
                }
}
}
}
// get ip address function   
function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
   return $ip;  
}  
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip; 

    //cart function 
    function cart(){
      if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_address = getIPAddress();
        $get_book_id=$_GET['add_to_cart'];

        $select_query="Select * from `cart_details` where ip_address='$get_ip_address' and book_id=$get_book_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
                if($num_of_rows>0){
                  echo "<script>alert('This item is already added to the cart')</script>";
                  echo "<script>window.open('index.php','_self')</script>";
                }else{
                  $insert_query="Insert into `cart_details` (book_id,ip_address,quantity) values($get_book_id,'$get_ip_address',0)";
                  $result_query=mysqli_query($con,$insert_query);
                  echo "<script>alert('This book is added to the cart')</script>";
                  echo "<script>window.open('index.php','_self')</script>";
                }
      }
    }
    //function to get cart item numbers
    function cart_item(){
      if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_address = getIPAddress();
        $select_query="Select * from `cart_details` where ip_address='$get_ip_address'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
                
                }else{
                  global $con;
                  $get_ip_address = getIPAddress();
                  $select_query="Select * from `cart_details` where ip_address='$get_ip_address'";
                  $result_query=mysqli_query($con,$select_query);
                  $count_cart_items=mysqli_num_rows($result_query);
                }
                echo $count_cart_items;
      }
      //total price function 
      function total_cart_price(){
        global $con;
        $get_ip_address=getIPAddress();
        $total_price=0;
        $cart_query="Select * from `cart_details` where ip_address='$get_ip_address'";
        $result=mysqli_query($con,$cart_query);
        while($row=mysqli_fetch_array($result)){
          $book_id=$row['book_id'];
          $select_books="Select * from `books` where book_id='$book_id'";
          $result_books=mysqli_query($con,$select_books);
          while($row_book_price=mysqli_fetch_array($result_books)){
              $book_price=array($row_book_price['book_price']);
              $book_values=array_sum($book_price);
              $total_price+=$book_values;
          }
        }
        echo $total_price;
      }
      // get user order details 
      function get_user_order_details(){
        global $con;
        $username=$_SESSION['username'];
        $get_details="Select * from `user_table` where user_name='$username'";
        $result_query=mysqli_query($con,$get_details);
        while($row_query=mysqli_fetch_array($result_query)){
          $user_id=$row_query['user_id'];
          if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
              if(!isset($_GET['delete_account'])){
              $get_orders="Select * from `user_orders` where user_id=$user_id and order_status='pending'";
              $result_order_query=mysqli_query($con,$get_orders);
              $row_count=mysqli_num_rows($result_order_query);
              if($row_count>0){
                echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
              }else{
                echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                <p class='text-center'><a href='../index.php' class='text-dark'>Explore Books</a></p>";
              }
              }
            }
          }
        }
      }
?>