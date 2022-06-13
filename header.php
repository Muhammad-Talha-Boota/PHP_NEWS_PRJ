<?php

// echo "<h1>" . basename($_SERVER['PHP_SELF']) . "</h1>";

include "config.php";

$page = basename($_SERVER['PHP_SELF']);

switch ($page) {
    case 'single.php';
        if (isset($_GET['id'])) {
            $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
            $result_title = mysqli_query($conn, $sql_title) or die('Title Query Faild.');
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['title'];
        } else {
            $page_title = "single Page id Not found.";
        }
        break;
    case 'category.php';
        if (isset($_GET['cid'])) {
            $sql_category = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
            $result_category = mysqli_query($conn, $sql_category) or die('Category Query Faild.');
            $row_category = mysqli_fetch_assoc($result_category);
            $page_title = $row_category['category_name'] . " News";
        } else {
            $page_title = "Category id Not found.";
        }
        break;
    case 'author.php';
        if (isset($_GET['aid'])) {
            $sql_author = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
            $result_author = mysqli_query($conn, $sql_author) or die('Author Query Faild.');
            $row_author = mysqli_fetch_assoc($result_author);
            $page_title = "News By " . $row_author['username'];
        } else {
            $page_title = "Author id Not found.";
        }
        break;
    case 'search.php';
        if (isset($_GET['search'])) {
            $page_title = $_GET['search'];
        } else {
            $page_title = "Search Not found.";
        }
        break;
    default;
        $page_title = "News Site";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-offset-4 col-md-4">
                    <?php

                    include "config.php";

                    $sql = "SELECT * FROM settings";
                    $result = mysqli_query($conn, $sql) or die('Query Faild');
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['logo'] == "") {
                                echo '<a href="index.php"><h1>' . $row['websitename'] . '</h1></a>';
                            } else {
                                echo '<a href="index.php" id="logo"><img src="admin/images/' . $row['logo'] . '"></a>';
                            }
                    ?>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php
                    include "config.php";
                    if (isset($_GET['cid'])) {
                        $cat_id = $_GET['cid'];
                    }

                    $sql = "SELECT * FROM category WHERE post > 0";
                    $result = mysqli_query($conn, $sql) or exit('Query Faild : Category');
                    if (mysqli_num_rows($result) > 0) {
                        $active = "";
                    ?>
                        <ul class='menu'>

                            <li><a href='<?php echo $hostname ?>'>Home</a></li>

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                if (isset($_GET['cid'])) {
                                    if ($row['category_id'] == $cat_id) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }
                            ?>
                                <li><a class='<?php echo $active ?>' href='category.php?cid=<?php echo $row['category_id'] ?>'><?php echo $row['category_name'] ?></a></li>

                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div> <!-- /Menu Bar -->


</body>