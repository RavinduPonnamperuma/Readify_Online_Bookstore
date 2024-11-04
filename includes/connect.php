<?php 

$con=mysqli_connect('localhost' , 'root' , '' , 'bookstore');
if(!$con){
    die(mysqli_error($con));
}
?>