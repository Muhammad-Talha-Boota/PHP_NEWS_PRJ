<?php
include "config.php";
// start code for upload img
if(isset($_FILES['fileToUpload'])){
    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.',$file_name));
    $extensions = array('jpeg','jpg','png');

    if(in_array($file_ext,$extensions) === false)
    {
        $errors[] = "This extention file not allowed, Please choose a JPG or PNG file.";
    }

    if($file_size > 2097152)
    {
        $errors[] = "File Size must be 2MB or lower.";
    }
    $new_name = time() . "-" . basename($file_name);
    $target = "upload/".$new_name;
    $image_name = $new_name;

    if(empty($errors) == true){
        move_uploaded_file($file_tmp,$target);
    }else{
        print_r($errors);
        die();
    }
}

// end code for upload Imag

session_start();

$p_tittle = mysqli_real_escape_string($conn, $_POST['post_title']);
$p_desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$p_cat = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['u_id'];

$sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$p_tittle}','{$p_desc}',{$p_cat},'{$date}',{$author},'{$image_name}');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$p_cat}";
if(mysqli_multi_query($conn,$sql)){
// if(mysqli_multi_query($conn,$sql)){
    header("Location: {$hostname}/admin/post.php");
}else{
    echo "<div class='alert alert-danger'>Query Failed.</div>";
}
