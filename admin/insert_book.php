<?php
include('../includes/connect.php');
if(isset($_POST['insert_book'])){

    $book_name=$_POST['book_name'];
    $book_description=$_POST['book_description'];
    $book_keywords=$_POST['book_keywords'];
    $book_category=$_POST['book_category'];
    $book_price=$_POST['book_price'];
    $book_status='true';


    // accessing images
    $book_image1=$_FILES['book_image1'] ['name']; 
    $book_image2=$_FILES['book_image2'] ['name']; 
    $book_image3=$_FILES['book_image3'] ['name']; 

    // accessing image temporary name 
    $temp_image1=$_FILES['book_image1'] ['tmp_name'];
    $temp_image2=$_FILES['book_image2'] ['tmp_name'];
    $temp_image3=$_FILES['book_image3'] ['tmp_name'];

    // checking empty condition 
    if($book_name=='' or $book_description=='' or $book_keywords=='' or $book_category=='' or $book_price=='' or $book_image1=='' or $book_image2=='' or $book_image3==''){
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./book_images/$book_image1");
        move_uploaded_file($temp_image2,"./book_images/$book_image2");
        move_uploaded_file($temp_image3,"./book_images/$book_image3");

        //insert query 
        $insert_books="insert into `books` (book_name,book_description,book_keywords,category_id,book_image1,book_image2,book_image3,book_price,date,status) values('$book_name','$book_description','$book_keywords','$book_category','$book_image1','$book_image2','$book_image3','$book_price', NOW(),'$book_status')";
        $result_query=mysqli_query($con,$insert_books);
        if($result_query){
            echo "<script>alert('Successfully Inserted the Book')</script>";
            // echo "<script>window.open('../view_product.php','_self')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Books - Admin Dashboard</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Books</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- name -->
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="book_name" class="form-label">Book Name</lable>
                <input type="text" name="book_name" id="book_name" class="form-control" placeholder="Enter Book Name" autocomplete="off" required="required">
            </div>
            <!-- description --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="book_description" class="form-label">Book Description</lable>
                <input type="text" name="book_description" id="book_description" class="form-control" placeholder="Enter Book Description" autocomplete="off" required="required">
            </div>
            <!-- keywords --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="book_keywords" class="form-label">Book Keywords</lable>
                <input type="text" name="book_keywords" id="book_keywords" class="form-control" placeholder="Enter Book Keywords" autocomplete="off" required="required">
            </div>
            <!-- categories --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="book_category" id="" class="form-select">
                    <option value="">Select Book Category</option>
                    <?php
                    $select_query="Select * from `categories`";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_name=$row['category_name'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_name</option>";
                    }
                    ?>
                    <!-- <option value="">Category 01</option>
                    <option value="">Category 02</option>
                    <option value="">Category 03</option>
                    <option value="">Category 04</option> --> 
                </select>
            </div>
            <!-- Image1 --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="book_image1" class="form-label">Book Image 1</lable>
                <input type="file" name="book_image1" id="book_image1" class="form-control" required="required">
            </div>
            <!-- Image2 --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="book_image2" class="form-label">Book Image 2</lable>
                <input type="file" name="book_image2" id="book_image2" class="form-control" required="required">
            </div>
            <!-- Image3 --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="book_image3" class="form-label">Book Image 3</lable>
                <input type="file" name="book_image3" id="book_image3" class="form-control" required="required">
            </div>
            <!-- price --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="book_price" class="form-label">Book Price</lable>
                <input type="text" name="book_price" id="book_price" class="form-control" placeholder="Enter Book Price" autocomplete="off" required="required">
            </div>
            <!-- button --> 
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_book" class="btn btn-info mb-3 px-3" value="Insert Book">
            </div>
        </form>
    </div>
    
</body>
</html>