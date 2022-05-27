<?php

include "config.php";

$u_id = $_GET['id'];

$sql = "DELETE FROM post WHERE post_id = {$u_id}";
if(mysqli_query($conn,$sql)){
    header("Location: {$hostname}/admin/post.php");
}




?>