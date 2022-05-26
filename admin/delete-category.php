<?php
include "config.php";

$c_id = $_GET['id'];
$sql = "DELETE FROM category WHERE category_id = {$c_id}";
if(mysqli_query($conn,$sql) or die('Query Faild')){
    header("Location: {$hostname}/admin/category.php");
}
mysqli_close($conn);
?>