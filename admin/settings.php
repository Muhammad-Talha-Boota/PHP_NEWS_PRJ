<?php
include "header.php";
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php

                include "config.php";

                $sql = "SELECT * FROM settings";

                $result = mysqli_query($conn, $sql) or die('Query Faild');
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <!-- Form for show edit-->
                        <form action="save_settings.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <label for="website_name">Website Name</label>
                                <input type="text" name="website_name" class="form-control" id="exampleInputUsername" value="<?php echo $row['websitename'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="logo">Website Logo</label>
                                <input type="file" name="logo">
                                <img src="images/<?php echo $row['logo'] ?>">
                                <input type="hidden" name="old-logo" value="<?php echo $row['logo'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="footer_desc">Footer Description</label>
                                <textarea class="form-control" type="text" name="footer_desc" id="footer_desc" cols="30" rows="5" require><?php echo $row['footerdesc'] ?></textarea>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" require />
                        </form>

                <?php
                    }
                } else {
                    echo 'Record not Found';
                }
                ?>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>