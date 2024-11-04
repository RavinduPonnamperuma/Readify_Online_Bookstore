<h3 class="text-center text-success">All books</h3>
<table class="table table-bordered mt-5 bg-info">
    <thead class="bg-info text-center">
        <tr>
            <th>Book ID</th>
            <th>Book Name </th>
            <th>Book Image</th>
            <th>Book Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light text-center">
    <?php
            $get_products="Select * from books";
            $result=mysqli_query($con,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $book_id=$row['book_id'];
                $book_name=$row['book_name'];
                $book_image1=$row['book_image1'];
                $book_price=$row['book_price'];
                $status=$row['status'];
                $number++;
                ?>
                <tr class='text-center'>
                <td> <?php echo $number; ?></td>
                <td><?php echo $book_name; ?></td>
                <td><img src='./book_images/<?php echo $book_image1; ?>' class='book_img'></td>
                <td><?php echo $book_price; ?>/-</td>
                <td><?php
                    $get_count="Select * from `orders_pending` where book_id=$book_id";
                    $result_count=mysqli_query($con,$get_count);
                    $rows_count=mysqli_num_rows($result_count);
                    echo $rows_count;
                ?></td>
                <td><?php echo $status; ?></td>
                <td><a href="adminindex.php?edit_product=<?php echo $book_id?>" class="text-black"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="adminindex.php?delete_product=<?php echo $book_id?>" class="text-black"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php
            }
        ?>
    </tbody>
</table>