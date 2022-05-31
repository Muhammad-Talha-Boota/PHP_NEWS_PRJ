<?php include "header.php";
if($_SESSION['u_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                include "config.php";
                // start code for pagination
                $limit = 5;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
                // End Code for pagination and set LIMIT in Query that carry all data.

                $sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset},{$limit}";
                $result = mysqli_query($conn, $sql) or die('Query Faild');
                if (mysqli_num_rows($result) > 0) {

                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Category id</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
                            $cat = $row['category_id'];
                            $sql1 = "SELECT COUNT('post') AS total FROM post WHERE category = {$cat};";
                            $result1 = mysqli_query($conn, $sql1) or die('Query Faild');
                            $totalPosts = mysqli_fetch_assoc($result1);
                            ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td class='id'><?php echo $row['category_id']?></td>
                                    <td><?php echo $row['category_name']?></td>
                                    <!-- <td><?php echo $row['post']?></td> -->
                                    <td><?php echo $totalPosts['total']?></td>
                                    <td class='edit'><a href="update-category.php?id=<?php echo $row['category_id']?>"><i class='fa fa-edit'></i></a></td>
                                    
                                    <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>
                <?php
                }
                // start Code for pagination
                $sql1 = "SELECT * FROM category";
                $result1 = mysqli_query($conn,$sql1) or die('Query Faild');
                if(mysqli_num_rows($result1)>0){
                    $total_record = mysqli_num_rows($result1);
                    $total_pages = ceil($total_record / $limit);

                    echo "<ul class='pagination admin-pagination'>";
                    if($page > 1){
                        echo '<li><a href="category.php?page=' . $page - 1 . '">Prev</a></li>';
                    }
                    for($i=1; $i <= $total_pages; $i++){
                        if($i == $page){
                            $active = "active";
                        }else{
                            $active = "";
                        }
                        echo '<li class="' . $active . '" ><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($total_pages > $page){
                        echo '<li><a href="category.php?page=' . $page  + 1 . '" >Next</a></li>';
                    }
                    echo "</ul>";
                }
                // End code for pagination
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>