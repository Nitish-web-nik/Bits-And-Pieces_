<?php
include('assets/SecondHeader.php');
?>
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="breadcrumb-title">
                    <h2 style=" font-size: 36px; font-weight: 700;color: pink;text-align:center;">Blog Details</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->


<div class="container">

    <!--Blog section start-->
    <div style="padding:30px 50px;background-color:white;margin:50px 10px;border-radius:10px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"
        class="blog-section section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-100 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">

            <div class="row">
                <?php
                $sql = "SELECT * FROM `blogs` WHERE id='" . $_GET['id'] . "'";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query);
                $path = "images/blog/" . $row['image'];
                ?>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <!-- Single Blog Start -->
                            <div class="blog post-full-item mb-30 col-lg-12">
                                <div class="blog-inner heading-color">
                                    <div class="blog-image" style="margin-top: 20px;">
                                        <a href="#" class="image"><img src="<?php echo $path; ?>" alt=""
                                                height="500px"></a>
                                        <ul class="meta theme-color" style="list-style: none;">
                                            <li><i class="fa fa-clock-o"></i><?php echo $row['createdat']; ?></li>
                                            <li><i class="fa fa-comments"></i>0</li>
                                        </ul>
                                    </div>
                                    <div class="content blog-grid-content">
                                        <h3 class="title"><?php echo $row['title'] ?></h3>
                                        <blockquote>
                                            <p><?php echo $row['msg']; ?></p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Blog End -->


                        </div>
                    </div>
                    <div class="col-lg-3 mt-sm-3 mt-xs-3">
                        <div class="sidebar"
                            style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
                            <h3 class="sidebar-title">Recent Posts</h3>
                            <?php
                            $sel = "SELECT * FROM `blogs` ORDER BY `blogs`.`id` DESC";
                            $q = mysqli_query($conn, $sel);
                            while ($row1 = mysqli_fetch_array($q)) {
                                $path = "images/blog/" . $row1['image'];
                            ?>
                            <div class="sidebar-blog"
                                style="background: linear-gradient(to bottom left, #e9a3ad 40%, #e2c6b5 100%);padding:5px;border-radius:5px;transition:all 300ms;box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;margin:10px; height:160px;width:150px;text-align:center;"
                                onmouseover="this.style.transform='scale(1.03)'"
                                onmouseout="this.style.transform='scale(1)'">

                                <a href="blog_details.php?id=<?php echo $row1['id']; ?>" class="image"><img
                                        src="<?php echo $path; ?>" alt=""
                                        style="width: 115px;height:80px;margin-left: 10px;"></a>
                                <div class="content" style="height:70px;">
                                    <h5><a
                                            href="blog_details.php?id=<?php echo $row1['id']; ?>"><?php echo $row1['title']; ?></a>
                                    </h5>
                                    
                                </div>

                            </div>
                            <?php }  ?>


                            <hr>

                            <?php
                            if ($_SESSION['is_logged_in'] == true && $row['user_id'] == $_SESSION['userId']) {
                            ?>
                            <div class="edit_del_blog buttons">
                                <button class="btn1" data-toggle="modal" data-target="#editBlogModal">Edit
                                    Blog</button>&nbsp;
                                <button class="btn1 " data-toggle="modal" data-target="#deleteBlogModal"
                                    style="background: linear-gradient(to bottom left, #e9a3ad 40%, #e2c6b5 100%);">Delete
                                    Blog
                                </button>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!--Blog section end-->

    </div>


    <!-- EDIT BLOG MODAL starts-->

    <?php
    $blogId = $_GET['id'];
    $edit = "SELECT * FROM `blogs` WHERE id='" . $_GET['id'] . "'";
    $fetch = mysqli_fetch_assoc(mysqli_query($conn, $edit));
    $path = "images/blog/" . $fetch['image'];
    if (isset($_POST['editBlog_btn'])) {
        $editblogImg = $_FILES['editblogImg']['name'];
        $editblogTitle = $_POST['editblogTitle'];
        $editblogMsg = $_POST['editblogMsg'];
        $updateEdit = "UPDATE `blogs` SET `title`='" . $editblogTitle . "',`image`='" . $editblogImg . "',`msg`='" . $editblogMsg . "' WHERE id='" . $_GET['id'] . "'";
        if (mysqli_query($conn, $updateEdit)) {
            if (move_uploaded_file($_FILES["editblogImg"]["tmp_name"], "images/blog/" . $editblogImg));

            echo "<script>alert('Blog edited successfully!!');window.loaction='blog_details.php?id=$blogId';</script>";
        } else {
            echo "<script>alert('Can't edit Blog!!Please Retry...');window.loaction='bog_details.php?id=$blogId';</script>";
        }
    }
    ?>




    <!-- Modal -->
    <div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Your Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Image:</label>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editblogImg" name="editblogImg"
                                            accept="image/*">
                                        <label class="custom-file-label" for="editblogImg">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <a href="<?php echo $path; ?>"><img src="images/editPic.png" alt=""
                                        style="width: 60px;height:60px;">Click
                                    Here to see
                                    Image</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editblogTitle" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="editblogTitle" name="editblogTitle"
                                value="<?php echo $fetch['title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editblogMsg" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="editblogMsg" name="editblogMsg"
                                rows="10"><?php echo $fetch['msg']; ?></textarea>
                        </div>

                    </div>
                    <div class="modal-footer buttons">
                        <button type="button" class="btn1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn1" name="editBlog_btn"
                            style="background: linear-gradient(to bottom left, #e9a3ad 40%, #e2c6b5 100%);">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- EDIT BLOG MODAL ends-->

    <!-- Delete Blog Modal starts-->

    <!-- Modal -->
    <div class="modal fade" id="deleteBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Your Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure, you want to delete this blog?

                    <?php

                    if (isset($_POST['delBlog_btn'])) {
                        $blogId = $_GET['id'];
                        $del = "DELETE FROM `blogs` WHERE id='" . $_GET['id'] . "'";
                        if (mysqli_query($conn, $del)) {
                            echo "<script>alert('Your Blog is deleted successfully!!');window.location='blog.php?id=$blogId';</script>";
                        }
                    }
                    ?>

                </div>
                <div class="modal-footer buttons">
                    <button type="button" class="btn1" data-dismiss="modal">Cancel</button>
                    <form action="" method="post">
                        <button type="submit" class="btn1" name="delBlog_btn"
                            style="background: linear-gradient(to bottom left, #e9a3ad 40%, #e2c6b5 100%);">Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Blog Modal ends-->



</div>


<?php
include("assets/footer.php");

?>