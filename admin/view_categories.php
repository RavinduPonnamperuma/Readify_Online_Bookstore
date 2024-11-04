<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <tr>
            <th>Serial No </th>
            <th>Category Name </th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light text-center">
        <?php
            $select_category="Select * from categories"; 
            $result=mysqli_query($con,$select_category);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $category_id=$row['category_id'];
                $category_name=$row['category_name'];
                $number++;
           
        ?>
        <tr>
            <td><?php echo $number;?></td>
            <td><?php echo $category_name;?></td>
            <td><a href='adminindex.php?edit_category=<?php echo $category_id?>' class='text-black'><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a href='adminindex.php?delete_category=<?php echo $category_id?>' class='text-black'><i class="fa-solid fa-trash"></i></a></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>