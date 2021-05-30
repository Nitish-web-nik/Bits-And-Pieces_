<?php
include('assets/connection.php');
if ($_SESSION['is_logged_in'] == true) {
    include('assets/SecondHeader.php');

    if (isset($_POST['donate_btn']) && !empty($_POST['dType'])) {
        $dType = $_POST['dType'];
        $objectName = $_POST['objectName'];
        $objectImg = $_FILES['objectImg']['name'];
        $quantity = $_POST['quantity'];
        $duration = $_POST['duration'];
        $shrt_desc = $_POST['shrt_desc'];
        $comp_desc = $_POST['comp_desc'];

        $user_id = $_SESSION['userId'];
        $username = $_SESSION['name'];


        foreach ($dType as $selected) {
            $donType = $selected;
            $dTypeSql = "SELECT * FROM `donationtype` WHERE dType='$donType'";
            $dTypeQ = mysqli_query($conn, $dTypeSql);
            $row = mysqli_fetch_assoc($dTypeQ);
            $dTypeId = $row['id'];

            $postInsert = "INSERT INTO `posts`(`user_id`, `dType_id`, `objectName`, `objectImg`, `quantity`,`duration`, `shrt_desc`, `comp_desc`) VALUES ('" . $user_id . "','" . $dTypeId . "','" . $objectName . "','" . $objectImg . "','" . $quantity . "','" . $duration . "','" . $shrt_desc . "','" . $comp_desc . "')";

            if (mysqli_query($conn, $postInsert)) {
                if (move_uploaded_file($_FILES["objectImg"]["tmp_name"], "images/posts/" . $objectImg));

                echo "<script>alert('uploaded successfully!! '); window.location='index.php?username=$username';</script>";
            } else {
                echo "<script>alert('Post Can not be Uploaded... please retry!!');window.location='post.php?username=$username'; </script>";
            }
        }
    }



?>


<div class="top">
    Donate and Save Lives...
</div>
<div class="form_area" style="background-color: #edeef0;" data-aos="zoom-in" data-aos-delay="100"
    data-aos-duration="1500" data-aos-offset="400">
    <div class="title">
        DONATE IF YOU CAN
    </div>
    <!--
    <div class="form">
        <label for="fname">Name:</label>
        <input type="text" class="input" placeholder="Your Name Here">
    </div>
    <div class="form">
        <label for="fname">Email:</label>
        <input type="email" class="input" placeholder="Your E-Mail Id ">
    </div>

    <div class="form">
        <label for="fname">Mobile No.:</label>
        <input type="number" class="input" max="10" placeholder="Contact Number">

    </div>

    <div class="form">
        <label for="fname">Address:</label>
        <textarea class="textarea" placeholder="Your Address Here"></textarea>

    </div>

    <div class="form">
        <label for="fname">City:</label>
        <input type="text" class="input" placeholder="City">
    </div>

    <div class="form">
        <label for="fname">State:</label>
        <input type="text" class="input" placeholder="State">
    </div>

    <div class="form">
        <label for="fname">Zip code:</label>
        <input type="number" max="6" class="input" placeholder="postal code">
    </div>
    -->
    <!-- 
These data should be getched from backend insted of asking from user again and again -->
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form">
            <label for="fname">Donation Type:</label>
            <div class="select">

                <select name="dType[]">
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
            <input type="text" class="input" name="objectName" placeholder="Name of the object or food you are donating"
                required>
        </div>

        <div class="form">
            <div class="file-input">
                <label for="file">Picture of item to be Donated</label>
                <input type="file" id="file" class="file" name="objectImg" accept="image/*" required>
            </div>
        </div>
        <div class="form">
            <label for="fname">Quantity:</label>
            <input type="number" min="1" class="input" name="quantity" placeholder="Quantity of item" required>
        </div>
        <div class="form">
            <label for="fname">Enter Time Duration <small>(as long it is safe to use)</small>(In Hours)</label>
            <input type="number" min="1" class="input" name="duration" placeholder="Time Duration" required>
        </div>
        <div class="form">
            <label for="fname">Short Description:</label>
            <textarea class="textarea" maxlength="500" name="shrt_desc"
                placeholder="Short Description(not more than 100words)" required></textarea>
        </div>
        <div class="form">
            <label for="fname">Complete Description:</label>
            <textarea class="textarea" maxlength="2000" name="comp_desc"
                placeholder="Complete Description(not more than 400 words)" required></textarea>
        </div>
        <div class="submit">
            <input type="submit" class="button" value="DONATE" name="donate_btn">
        </div>

    </form>

</div>




<?php
    include('assets/footer.php'); ?>

<?php
} else {
    header("location:index.php?msg=not_allowed");
} ?>