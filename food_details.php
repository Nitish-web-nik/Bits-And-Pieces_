<?php
include('assets/connection.php');
include('assets/SecondHeader.php');
$username=$_SESSION['name'];
$postId=$_GET['id'];

?>



<!-- Breadcrumb Section Start -->
<div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="breadcrumb-title">
                    <h2 style=" font-size: 36px; font-weight: 700;color: pink;text-align: left;">Food Details</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!--Product section start-->

<div class="product-section section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50  pb-50 pb-lg-30 pb-md-20 pb-sm-10 pb-xs-0"
    style="padding:10px;background-color:white;margin:10px;border-radius:10px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM `posts` WHERE id='" . $_GET['id'] . "'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($query);
                    $path = "images/posts/" . $row['objectImg'];

                    $user_id = $row['user_id'];
                    $dType_id = $row['dType_id'];

                    $userSql = "SELECT * FROM `registeredusers` WHERE id='$user_id'";
                    $userQ = mysqli_query($conn, $userSql);
                    $detail = mysqli_fetch_assoc($userQ);

                    $userAddSql = "SELECT * FROM `userdetails` WHERE userId='$user_id'";
                    $userAddQ = mysqli_query($conn, $userAddSql);
                    $addDetail = mysqli_fetch_assoc($userAddQ);



                    ?>
                    <div class="product-details col-12 mb-50 mb-sm-40 mb-xs-30">
                        <div class="product-inner row">
                            <div class="col-md-6 col-12 mb-xs-30">
                                <div class="product-image-slider">
                                    <div class="item" ><a href="<?php echo $path; ?>" target="_blank" class="gallery-popup"><i
                                                class="pe-7s-search"></i><img style="margin-top:50px;" src="<?php echo $path; ?>" alt=""></a>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-6 col-12 ">
                                <div class="content details" style="padding: 20px;">
                                    <h3 class="title" style="font-weight: 600;color:blueviolet;">
                                        <?php echo $row['objectName'] ?></h4>
                                    </h3>


                                    <div class="product-meta" style="padding: 20px;">
                                        <span class="posted-in"><b>Name :</b> <?php echo $detail['name']; ?></span><br>
                                        <span class="tagged-as"><b>Email :</b>
                                            <?php echo $detail['emailId']; ?></span><br>
                                        <span class="tagged-as"><b>Mobile no :</b>
                                            <?php echo $detail['phone']; ?></span><br>
                                        <span class="tagged-as"><b>Address :</b>
                                        </span><?php echo $addDetail['address'] . "," . $addDetail['pincode']; ?></span>
                                    </div>



                                    <ul class="product-details-tab-list nav">
                                        <li><a class="active show" href="#product-description" data-toggle="tab"
                                                style="width: 200px; font-size: 20px; font-weight: 700;color:#cc7ccc;text-align: left;">short-Description</a>
                                        </li>
                                        <li><a href="#product-review" data-toggle="tab"
                                                style="width: 270px; font-size: 20px; font-weight: 700;color: #cc7ccc;text-align: left;margin-bottom:10px;"><small
                                                    style=" font-size: 12px; font-weight: 400;color:#999799;text-align: left;">Click
                                                    Here for</small> Complete-Detail</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="product-description" class="tab-pane active show"
                                            style="background-color: #edeef0; padding:15px;border-radius:10px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                            <h3
                                                style=" font-size: 22px; font-weight: 700;color:#784055;text-align: left;">
                                                Description in Short</h3>
                                            <hr>
                                            <div class="product-description" style="color: #6e6d6d;">
                                                <?php echo $row['shrt_desc'] ?>
                                            </div>
                                        </div><br>
                                        <div id="product-review" class="tab-pane">
                                            <div class="product-review"
                                                style="background-color: #edeef0; padding:15px;border-radius:10px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                                <h3
                                                    style=" font-size: 22px; font-weight: 700;color:#784055;text-align: left;">
                                                    Complete Description
                                                </h3>
                                                <hr>
                                                <div class="review-form" style="color: #6e6d6d;">
                                                    <?php echo $row['comp_desc'] ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    
                                    <hr>

                                    <div class="buttons">
                                        <?php if ($_SESSION['is_logged_in']==true && $detail['emailId'] == $_SESSION['email']) { ?>
                                        <button data-toggle="modal" data-target="#editModal">Edit</button>
                                        <button  data-toggle="modal" data-target="#deleteModal">Delete</button>
                                        <?php } ?>
                
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
</div>



<!-- Edit Modal -->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDIT POST</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- code for edit post -->
      <?php
        $pDetailSql="SELECT * FROM `posts` WHERE id='$postId'";
        $pDetailQ=mysqli_query($conn,$pDetailSql);
        $pDetailRow=mysqli_fetch_assoc($pDetailQ);
        $path="images/posts/".$pDetailRow['objectImg'];

        if (isset($_POST['editPost_btn']) && !empty($_POST['editDType'])) {
            $editDType=$_POST['editDType'];
            $editObjectName=$_POST['editObjectName'];
            $editObjectImg=$_FILES['editObjectImg']['name'];
            $editQuantity=$_POST['editQuantity'];
            $editDuration=$_POST['editDuration'];
            $edit_shrt_desc=$_POST['edit_shrt_desc'];
            $edit_comp_desc=$_POST['edit_comp_desc'];
    
            $user_id = $_SESSION['userId'];
    
    
            foreach ($editDType as $selected) {
                $donType = $selected;
                $dTypeSql = "SELECT * FROM `donationtype` WHERE dType='$donType'";
                $dTypeQ = mysqli_query($conn, $dTypeSql);
                $row = mysqli_fetch_assoc($dTypeQ);
                $dTypeId = $row['id'];
    
                $editPostSql="UPDATE `posts` SET `dType_id`='$dTypeId',`objectName`='$editObjectName',`objectImg`='$editObjectImg',`quantity`='$editQuantity',`shrt_desc`='$edit_shrt_desc',`comp_desc`='$edit_comp_desc',`duration`='$editDuration' WHERE id='$postId'";
    
                if (mysqli_query($conn, $editPostSql)) {
                    if($donType!==null){
                    if (move_uploaded_file($_FILES["editObjectImg"]["tmp_name"], "images/posts/" . $editObjectImg));
    
                    echo "<script>alert('updated successfully!! '); window.location='food_details.php?id=$postId';</script>";
                    }else{
                        echo "<script>alert('please select donation type!! '); window.location='food_details.php?id=$postId';</script>";

                    }
                } else {
                    echo "<script>alert('Post Can not be Updated... please retry!!');window.location='food_details.php?id=$postId'; </script>";
                }
            }
        }

        if(isset($_POST['editBlog_btn'])){
            


        }
      ?>
      <form action="" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        
      <div class="form">
            <label for="fname">Donation Type:</label>
            <div class="select">

                <select name="editDType[]" required>
                    <option value="" disabled selected>Select donation type</option>
                    <?php
                        $selDType = "SELECT * FROM `donationtype` ORDER BY `donationtype`.`id` ASC";
                        $qDtype = mysqli_query($conn, $selDType);
                        while ($rowDType = mysqli_fetch_array($qDtype)) {
                        ?>
                    <option value="<?php echo $rowDType['dType']; ?>"><?php echo $rowDType['dType']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form">
            <label for="fname">Name of Object:</label>
            <input type="text" class="input" name="editObjectName" placeholder="Name of the object or food you are donating"
                required value="<?php echo $pDetailRow['objectName'];?>">
        </div>

        <div class="form">
            <div class="file-input">
                <label for="file">Picture of item to be Donated</label>
                <input type="file" id="file" class="file" name="editObjectImg" accept="image/*" required value="<?php echo $pDetailRow['objectImg'];?>">
                <a href="<?php echo $path?>" target="_blank">Click here to see the image</a>
            </div>
        </div>
        <div class="form">
            <label for="fname">Quantity:</label>
            <input type="number" min="1" class="input" name="editQuantity" placeholder="Quantity of item" required value="<?php echo $pDetailRow['quantity'];?>">
        </div>
        <div class="form">
            <label for="fname">Enter Time Duration <small>(as long it is safe to use)</small>(In Hours)</label>
            <input type="number" min="1" class="input" name="editDuration" placeholder="Time Duration" required value="<?php echo $pDetailRow['duration'];?>">
        </div>
        <div class="form">
            <label for="fname">Short Description:</label>
            <textarea class="textarea" maxlength="500" name="edit_shrt_desc"
                placeholder="Short Description(not more than 100words)" required ><?php echo $pDetailRow['shrt_desc'];?></textarea>
        </div>
        <div class="form">
            <label for="fname">Complete Description:</label>
            <textarea class="textarea" maxlength="2000" name="edit_comp_desc"
                placeholder="Complete Description(not more than 400 words)" required ><?php echo $pDetailRow['comp_desc'];?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="editPost_btn">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Modal End-->


<!-- Delete Modal -->
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DELETE POST</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Are You Sure You Want to Delete the Post?
        <?php 
            if(isset($_POST['delPost_btn'])){
                $delSql="DELETE FROM `posts` WHERE id='$postId'";
                $delQ=mysqli_query($conn,$delSql);
                if($delQ>0){
                    echo "<script>alert('Post Deleted Successfully!!');window.location='index.php?username=$username';</script>";

                }else{
                    echo "<script>alert('Post can not be Deleted Successfully!!');window.location='index.php?username=$username';</script>";

                }
            }
        ?>
      </div>
      <form action="" method="post">

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" name="delPost_btn">DELETE</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!-- Delete Modal End -->


<!--Product section end-->

<?php
include("assets/footer.php");

?>