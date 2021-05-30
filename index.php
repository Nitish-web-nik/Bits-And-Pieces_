<?php
include('assets/mainHeader.php');




?>

<div class="container">
    <div class="landing-text">
        <h1><b>Bits and Pieces<b></h1>
        <h6>We serve your Safety</h6>
    </div>


    <!--cards-->
    <div class="main">
        <h1 id="About">About</h1>
        <ul class="cards">
            <li class="cards_item" data-aos="fade-up-left" data-aos-delay="100" data-aos-duration="1000"
                data-aos-offset="300">
                <div class="card">
                    <div class="card_image"><img src="images/300254_feeding123.jpg"></div>
                    <div class="card_content">
                        <h2 class="card_title" style="font-size: 16px;">About Food Donation</h2>
                        <p class="card_text" style="font-size:13px;">Donate And Save Life</p>
                        <button class="btn card_btn"><a href="about1.php">Read More</a></button>
                    </div>
                </div>
            </li>
            <li class="cards_item" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1000"
                data-aos-offset="300">
                <div class="card">
                    <div class="card_image"><img src="images/oxygen.jpg"></div>
                    <div class="card_content">
                        <h2 class="card_title" style="font-size: 16px;">About Covid Resource</h2>
                        <p class="card_text" style="font-size:13px;">Donate Covid Safety Resources to save Humanity</p>
                        <button class="btn card_btn"><a href="about2.php">Read More</a></button>
                    </div>
                </div>
            </li>
            <li class="cards_item" data-aos="fade-up-right" data-aos-delay="100" data-aos-duration="1000"
                data-aos-offset="300">
                <div class="card">
                    <div class="card_image"><img src="images/feeding_dogs.jpg"></div>
                    <div class="card_content">
                        <h2 class="card_title" style="font-size: 16px;">About Street Animals Feeding</h2>
                        <p class="card_text" style="font-size:13px;">Donate food to save Every Creature</p>
                        <button class="btn card_btn"><a href="about3.php">Read More</a></button>
                    </div>
                </div>
            </li>


        </ul>
    </div>


    <!--posts-->
    <div class="post">
        <h2><u>Available Foods..</u></h2>
        <div class="line"></div>
        <div class="cards">
            <?php
            $username = $_SESSION['name'];
            $selData = "SELECT * FROM `posts`";
            $dataQ = mysqli_query($conn, $selData);
            while ($row = mysqli_fetch_array($dataQ)) {
                $objectName = $row['objectName'];
                $objectImgPath = "images/posts/" . $row['objectImg'];
                $shrt_desc = $row['shrt_desc'];
                $quantity =$row['quantity'];

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

                if ($dTypeDetail['dType'] == "Food") {
            ?>



            <div class="card" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500"
                data-aos-offset="400">
                <div class="card-item">
                    <div class="card-image"><img src="<?php echo $objectImgPath; ?>" style="height:350px" alt=""></div>
                    <div class="card-content">
                        <div class="card-title"><span>Object Name: </span><?php echo $objectName; ?></div>
                        <div class="card-text"><span>Quantity(for people): </span>
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

                <!-- timer section -->
                        
                <div>

                    <p id="response">
                    This Item is Safe to Use.
                    </p>

                </div>
                <!-- timer section end -->
                
            </div>

            <?php }
            } ?>
        </div>


    </div>

</div>




<?php
include('assets/footer.php');

?>