

<?php
include('assets/connection.php');
if ($_SESSION['is_logged_in'] == true) {
    include('assets/SecondHeader.php');

    $select="SELECT * FROM `userdetails` WHERE userId='".$_SESSION['userId']."'";
    $query=mysqli_query($conn,$select);
    $no=mysqli_num_rows($query);
    $rw=mysqli_fetch_assoc($query);
    $path="images/profilePicture/".$rw['profilePic'];
    $username=$_SESSION['name'];


    if(isset($_POST['editProfile_btn'])){
        $editProfilePic=$_FILES['editProfilePic']['name'];
        $edit_alt_phn_no=$_POST['edit_alt_phn_no'];
        $editpinCode=$_POST['editpinCode'];
        $editcity=$_POST['editcity'];
        $editstate=$_POST['editstate'];
        $editaddress=$_POST['editaddress'];
        $editarea=$_POST['editarea'];
        $editlandMark=$_POST['editlandMark'];


                
        
            $update="UPDATE `userdetails` SET `profilePic`=$editProfilePic,`alt_phn_no`=$edit_alt_phn_no,`pincode`=$editpinCode,`city`=$editcity,`state`=$editstate,`address`=$editaddress,`area`=$editarea,`landMark`=$editlandMark, WHERE userId='".$_SESSION['userId']."'";

            if(mysqli_query($conn,$update)){
                if(move_uploaded_file($_FILES["editProfilePic"]["tmp_name"],"images/profilePicture/".$editProfilePic));

            echo "<script>alert('updated successfully!!'); window.location='profile.php?username=$username';</script>";
        }else{
            echo "<script>alert('can't update profile!!retry...')</script>";
        }
           
            

    }

    // change password code...
    if(isset($_POST['changePswd_btn'])){
        $currentPassword=$_POST['currentPassword'];
        $newPassword=$_POST['newPassword'];
        $confirmNewPassword=$_POST['confirmNewPassword'];

        $sel="SELECT * FROM `userregistration` WHERE id='".$_SESSION['userId']."' AND pswd='".$currentPassword."'";       
        if(mysqli_num_rows(mysqli_query($conn,$sel))){
            if($newPassword===$confirmNewPassword){
                $up="UPDATE `userregistration` SET `pswd`=$newPassword WHERE id='".$_SESSION['userId']."'";
                if(mysqli_query($conn,$up)){
                    echo "<script>alert('Password Changed Successfully!')</script>"; 
                }
            }else{
                echo "<script>alert('New Password And Confirm New Pasword does not match!!retry...')</script>";

            }

        }else{
            echo "<script>alert('Current Password is incorrect!!')</script>";
        }

    }


?>

<!-- Change Password Modal -->
<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change Your Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="post">

      <div class="modal-body">
        <!-- Change Password Form -->
            
                <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter Your Current Password">
                </div>
                <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter Your New Password">
                </div>
                <div class="form-group">
                <label for="confirmNewPassword">Confirm Your New Password</label>
                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Password">
                </div>
               

        <!-- ./Change Password Form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="changePswd_btn">Change Password</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!-- ./Change Password Modal -->

<!-- Edit Profile Modal -->

<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit your profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">

      <div class="modal-body">
        <!-- edit form -->

        <div class="col-md-12">
                <div class="row form-group">
                    <div class="col-sm-6">
                    <label for="editProfilePic">Upload Profile Picture</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="editProfilePic" name="editProfilePic" accept="image/*" required value="<?php echo $rw['profilePic'];?>">
                        <label class="custom-file-label" for="editprofilePic">Choose file</label>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?php echo $path;?>"><img src="assets/images/profilePicture/editPic.png" alt="" height="60px" width="40px">click to view image</a>
                    </div>
                    <div class="col-sm-6">
                    <label for="edit_alt_phn_no">Alternate Phone Number (optional)</label>
                    <input type="tel" class="form-control" name="edit_alt_phn_no" id="edit_alt_phn_no" maxlength="10" value="<?php echo $rw['alt_phn_no'];?>" >
                    </div>
                    <div class="col-sm-6">
                    <label for="editpinCode">PIN Code</label>
                    <input type="number" class="form-control" name="editpinCode" id="editpinCode" required value="<?php echo $rw['pincode'];?>">
                    </div>
                    <div class="col-sm-6">
                    <label for="editcity">City</label>
                    <input type="text" class="form-control" name="editcity" id="editcity" required value="<?php echo $rw['city'];?>">
                    </div>
                    <div class="col-sm-6">
                    <label for="editstate">State</label>
                    <input type="text" class="form-control" name="editstate" id="editstate" required value="<?php echo $rw['state']; ?>">
                    </div>
                    <div class="col-sm-12">
                    <label for="editaddress">Address</label>
                    <input type="text" class="form-control" name="editaddress" id="editaddress" required value="<?php echo $rw['address'];?>">
                    </div>
                    <div class="col-sm-12">
                    <label for="editarea">Road name,Area,Colony</label>
                    <input type="text" class="form-control" name="editarea" id="editarea" required value="<?php echo $rw['area'];?>">
                    </div>
                    <div class="col-sm-12">
                    <label for="editlandMark">Nearby Famous Shop/Mall/Landmark</label>
                    <input type="text" class="form-control" name="editlandMark" id="editlandMark" required value="<?php echo $rw['landMark'];?>">
                    </div>
                </div>
                </div>
        <!-- ./edit form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="editProfile_btn">Save changes</button>
      </div>
</form>
    </div>
  </div>
</div>

<!-- /.Edit Profile Modal -->

  <!-- Breadcrumb Section Start -->
  <div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="breadcrumb-title">
                        <h2 style=" font-size: 36px; font-weight: 700;color: pink;text-align: left;">Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section End -->
<div class="container" >

            <div 
    style=" padding:30px 50px;background-color:white;margin:50px 10px;border-radius:10px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    <div class="row align-items-top">
            
                <div class="col-md-2 profile-picture text-center" >
                
                   <?php if($no>0){?>
                    <img style="margin-top:70px; border-radius:150%; height:200px; width:200px;" src="<?php echo $path;?>" alt="">
                    <?php }else{ ?>
                        <img style="margin-top:70px; border-radius:150%; height:200px; width:200px;" src="images/profilePicture/avtar.png" alt="">

                    <?php } ?>
                    <!-- <p  class="text-center"><a href="" data-toggle="modal" data-target="#editProfileModal"><span class="fa fa-edit"> </span> EDIT PROFILE </a> </p> -->
                    <!-- <p  class="text-center"><a href="" data-toggle="modal" data-target="#changePasswordModal"><span class="fa fa-edit"> </span> CHANGE PASSWORD </a> </p> -->
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-8 user-detail">
                <div class="row">
                <div class="col-md-12">
                    <h3 style="text-align:center; padding:5px; margin-top:50px;"> Basic Details</h3>
                    <table class="table table-hover table-borderless" style=" background-color:white; border-radius:5px;">
                        <tbody>
                            <tr>
                                <th scope="row">Name:</th>
                                <td><?php echo $_SESSION['name'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email:</th>
                                <td><?php echo $_SESSION['email'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Contact:</th>
                                <td><?php echo $_SESSION['contact'];?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <?php 
                
                 if($no>0){?>
                <div class="col-md-12">
                <h3 style="text-align:center; padding:5px; margin-top:50px;">More Details</h3>
                <table class="table table-hover table-borderless" style=" background-color:white; border-radius:5px;">
                        <tbody>
                            <tr>
                                <th scope="row">Alternate Phone No.:</th>
                                <td><?php echo $rw['alt_phn_no'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">PIN Code:</th>
                                <td><?php echo $rw['pincode'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">City:</th>
                                <td><?php echo $rw['city'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">State:</th>
                                <td><?php echo $rw['state'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">House No.,Building Name:</th>
                                <td><?php echo $rw['address'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Road name,Area,Colony:</th>
                                <td><?php echo $rw['area'];?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nearby Famous Shop/Mall/Landmark:</th>
                                <td><?php echo $rw['landMark'];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php }else{
                    if(isset($_POST['uploadDetail_btn'])){
                        $userId=$_SESSION['userId'];
                        $profilePIC=$_FILES['profilePic']['name'];
                        $alt_phn_no=$_POST['alt_phn_no'];
                        $pinCode=$_POST['pinCode'];
                        $city=$_POST['city'];
                        $state=$_POST['state'];
                        $address=$_POST['address'];
                        $area=$_POST['area'];
                        $landMark=$_POST['landMark'];

                        $in="INSERT INTO `userdetails`(`userId`,`profilePic`, `alt_phn_no`, `pincode`, `city`, `state`, `address`, `area`, `landMark`) VALUES ('".$userId."','".$profilePIC."','".$alt_phn_no."','".$pinCode."','".$city."','".$state."','".$address."','".$area."','".$landMark."')";
                        if($qu=mysqli_query($conn,$in)){
                            // if(move_uploaded_file($_FILES["addVideo"]["tmp_name"],"php_assets/data/dailyCurrentAffairVideos/".$addVid));

                            if(move_uploaded_file($_FILES["profilePic"]["tmp_name"],"images/profilePicture/".$profilePIC));
                            echo "<script>alert('Profile Updated Successfully'); window.location='profile.php?username=$username';</script>";
                        }

                    } ?>
                    <div class="col-md-12">
                <h3 style="text-align:center; padding:5px; margin-top:50px;">Complete Your Profile</h3>
                <form action="" method="post" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col-sm-12">
                    <label for="profilePic">Upload Profile Picture</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="profilePic" name="profilePic" accept="image/*">
                        <label class="custom-file-label" for="profilePic">Choose file</label>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="alt_phn_no">Alternate Phone Number (optional)</label>
                    <input type="tel" class="form-control" name="alt_phn_no" id="alt_phn_no" maxlength="10" >
                    </div>
                    <div class="col-sm-6">
                    <label for="pinCode">PIN Code</label>
                    <input type="number" class="form-control" name="pinCode" id="pinCode" required>
                    </div>
                    <div class="col-sm-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" required>
                    </div>
                    <div class="col-sm-6">
                    <label for="state">State</label>
                    <input type="text" class="form-control" name="state" id="state" required>
                    </div>
                    <div class="col-sm-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                    </div>
                    <div class="col-sm-12">
                    <label for="area">Road name,Area,Colony</label>
                    <input type="text" class="form-control" name="area" id="area" required>
                    </div>
                    <div class="col-sm-12">
                    <label for="landMark">Nearby Famous Shop/Mall/Landmark</label>
                    <input type="text" class="form-control" name="landMark" id="landMark" required>
                    <input type="submit" style="border-radius:4px;margin-top: 20px;background: linear-gradient(to bottom left, #e9a3ad 40%, #e2c6b5 100%);box-shadow: rgba(79, 81, 82, 0.973) 0px 2px 4px 0px,
    rgba(165, 167, 167, 0.952) 0px 2px 16px 0px;  border: none;font-size: 20px;"
                                    onmouseover="this.style.background='linear-gradient(to bottom left, #e2c6b5 40%, #e9a3ad 100%)'"
                                    onmouseout="this.style.background='linear-gradient(to bottom left, #e9a3ad 40%, #e2c6b5 100%)'"
                                    class="btn mt-20 " name="uploadDetail_btn" value="Upload">
                    </div>
                </div>
                </form>
                </div>
                <?php } ?>
                </div>
                </div>   
            </div>
        </div>
  
        </div>


        <?php
    include('assets/footer.php'); ?>

<?php
} else {
    header("location:index.php?msg=not_allowed");
} ?>