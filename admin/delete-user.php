<?php

include "config.php";

$userid = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$userid}";
if(mysqli_query($conn,$sql)){
    header("Location: {$hostname}/admin/users.php");
}else{
    echo "<h3 style='color:red;text-align:center;margin:10px 0;'>Can't Delete User Record.</h3>";
}

mysqli_close($conn);

?>