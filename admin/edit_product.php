<?php
if (isset($_GET['edit_product'])) {
    $edit_id = $_GET['edit_product'];
    $get_data = "Select * from books where book_id=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $book_name = $row['book_name'];
    $book_description = $row['book_description'];
    $book_keywords = $row['book_keywords'];
    $category_id = $row['category_id'];
    $book_image1 = $row['book_image1'];
    $book_image2 = $row['book_image2'];
    $book_image3 = $row['book_image3'];
    $book_price = $row['book_price'];

    //fetching category name 
    $select_category = "Select * from categories where category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_name = $row_category['category_name'];
    // echo $category_name;
}
?>
<div class="container mt-5">
    <h1 class="text-center">Edit Books</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="book_name" class="form-lable">Book Name</label>
            <input type="text" id="book_name" value="<?php echo $book_name ?>" name="book_name" class="form-control"
                required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="book_description" class="form-lable">Book Description</label>
            <input type="text" id="book_description" value="<?php echo $book_description ?>" name="book_description"
                class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="book_keywords" class="form-lable">Book Keywords</label>
            <input type="text" id="book_keywords" value="<?php echo $book_keywords ?>" name="book_keywords"
                class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <select name="book_category" class="form-select">
                <option value="<?php echo $category_name ?>"><?php echo $category_name ?></option>
                <?php
                $select_category_all = "Select * from categories";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_name = $row_category_all['category_name'];
                    $category_id = $row_category_all['category_id'];
                    echo "<option value='$category_id'>$category_name</option>";
                }
                ;
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="book_image1" class="form-lable">Book Image 1</label>
            <div class="d-flex">
                <input type="file" id="book_image1" name="book_image1" class="form-control w-90 m-auto"
                    required="required">
                <img src="./book_images/<?php echo $book_image1 ?>" alt="" class="book_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="book_image2" class="form-lable">Book Image 2</label>
            <div class="d-flex">
                <input type="file" id="book_image2" name="book_image2" class="form-control w-90 m-auto"
                    required="required">
                <img src="./book_images/<?php echo $book_image2 ?>" alt="" class="book_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="book_image3" class="form-lable">Book Image 3</label>
            <div class="d-flex">
                <input type="file" id="book_image3" name="book_image3" class="form-control w-90 m-auto"
                    required="required">
                <img src="./book_images/<?php echo $book_image3 ?>" alt="" class="book_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="book_price" class="form-lable">Book Price</label>
            <input type="text" id="book_price" value="<?php echo $book_price ?>" name="book_price" class="form-control"
                required="required">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" id="edit_product" name="edit_product" value="Update book"
                class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>

<!-- editing products -->
<?php
if (isset($_POST['edit_product'])) {
    $book_name = $_POST['book_name'];
    $book_description = $_POST['book_description'];
    $book_keywords = $_POST['book_keywords'];
    $book_category = $_POST['book_category'];
    $book_price = $_POST['book_price'];

    $book_image1 = $_FILES['book_image1']['name'];
    $book_image2 = $_FILES['book_image2']['name'];
    $book_image3 = $_FILES['book_image3']['name'];

    $tmp_image1 = $_FILES['book_image1']['tmp_name'];
    $tmp_image2 = $_FILES['book_image2']['tmp_name'];
    $tmp_image3 = $_FILES['book_image3']['tmp_name'];

    // checking for fields empty or not 
    if ($book_name == '' or $book_description == '' or $book_keywords == '' or $book_category == '' or $book_image1 == '' or $book_image2 == '' or $book_image3 == '' or $book_price == '') {
        echo "<script>alert('Pleease fill all the fields and continue the process')</script>";
    } else {
        move_uploaded_file($tmp_image1, "./book_images/$book_image1");
        move_uploaded_file($tmp_image2, "./book_images/$book_image2");
        move_uploaded_file($tmp_image3, "./book_images/$book_image3");

        //query to update products 
        $update_products = "Update books set book_name='$book_name',book_description='$book_description',
            book_keywords='$book_keywords',category_id='$category_name',book_image1='$book_image1',book_image2='$book_image2',
            book_image3='$book_image3',book_price='$book_price',date=NOW() where book_id=$edit_id";
        $result_update = mysqli_query($con, $update_products);
        if ($result_update) {
            echo "<script>alert('Book Updated Successfully')</script>";
            echo "<script>window.open('./insert_book.php','_self')</script>";
        }
    }
}
?>