<?php
include('assets/connection.php');
include('assets/SecondHeader.php');
?>

<div class="post">
    <h2><u>Available Covid Relief.</u></h2>
    <div class="cards">
        <?php
        $username = $_SESSION['name'];
        $selData = "SELECT * FROM `posts`";
        $dataQ = mysqli_query($conn, $selData);
        while ($row = mysqli_fetch_array($dataQ)) {
            $objectName = $row['objectName'];
            $objectImgPath = "images/posts/" . $row['objectImg'];
            $shrt_desc = $row['shrt_desc'];
            $quantity= $row['quantity'];

            $user_id = $row['user_id'];
            $dType_id = $row['dType_id'];

            $userSql = "SELECT * FROM `registeredusers` WHERE id='$user_id'";
            $userQ = mysqli_query($conn, $userSql);
            $detail = mysqli_fetch_assoc($userQ);

            $userAddSql = "SELECT * FROM `userdetails` WHERE userId='$user_id'";
            $userAddQ = mysqli_query($conn, $userAddSql);
            $addDetail = mysqli_fetch_assoc($userAddQ);

            $dTypeSql = "SELECT * FROM `donationtype` WHERE id='$dType_id'";
            $dTypeQ = mysqli_query($conn, $dTypeSql);
            $dTypeDetail = mysqli_fetch_assoc($dTypeQ);

            if ($dTypeDetail['dType'] !== "Food") {
        ?>



        <div class="card" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="400">
            <div class="card-item">
                <div class="card-image"><img src="<?php echo $objectImgPath; ?>" style="height:350px" alt=""></div>
                <div class="card-content">
                    <div class="card-title"><span>Object Name: </span><?php echo $objectName; ?></div>
                    <div class="card-text"><span>Quantity: </span>
                            <?php echo $quantity; ?>
                        </div>
                    <div class="card-text"><span>details: </span>
                        <?php echo $shrt_desc; ?>
                    </div>
                    <a href="food_details.php?id=<?php echo $row['id']; ?>"><i class="fa fa-hand-point-right"></i>
                        more details</a><br>
                    <h3>Complete Address</h3>
                    <div class="card-name"><span>Name : </span><?php echo $detail['name']; ?></div>
                    <div class="card-email"><span>Email : </span><?php echo $detail['emailId']; ?></div>
                    <div class="card-number"><span>Mobile No. : </span><?php echo $detail['phone']; ?></div>
                    <div class="card-address"><span>Complete Address :
                        </span><?php echo $addDetail['address'] . "," . $addDetail['pincode']; ?></div>
                    <br>

                </div>
            </div>
            <!-- timer -->
                <div>
                    This Item is Safe to Use
                    <p id="response"></p>
                </div>
            <!-- timer end -->
           
        </div>

        <?php }
        } ?>
    </div>
</div>




<?php
include('assets/footer.php');

?>