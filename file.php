<?php
if (isset($_POST['btnsave'])) {
    

    $imgFile = $_FILES['user_img']['name'];
    $tmp_dir = $_FILES['user_img']['tmp_name'];
    $imgSize = $_FILES['user_img']['size'];


    if (empty($imgFile)) {
        $errorMSG = "Please select an image";
    } else {
        $upload_dir = 'user_images/'; //upload directory
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
        $valid_extentions = array('jpeg', 'jpg', 'png', 'gif');
        //  $userpic = rand(1000, 100000000) . "." . $imgExt;

        if (in_array($imgExt, $valid_extentions)) {
            if ($imgSize < 400 * 1024) {
                move_uploaded_file($tmp_dir, $upload_dir . $imgFile);
            } else {
                $errorMSG = "Sorry, your file is too large";
            }
        } else {
            $errorMSG = "Sorry, only jpeg, jpg,png,gif files are allowed";
        }
    }
}



?>


<!DOCTYPE html>
<html>

<head>
    <title> Image Uploading File </title>
    <style>
    fieldset {
    font: 1em Verdana, Geneva, sans-serif;
    text-transform: none;
    color: #00F;
    background: gainsboro;
    border: thin solid #333;
    }

    err {
        color: red;
    }
    </style>
</head>

<body>
<fieldset>

    <div>

        <?php

        //error_reporting(~E_NOTICE);

        if (isset($errorMSG)) {

        ?>

            <div>
                <span></span><b class="err"><?php echo $errorMSG; ?></b>

            </div>
        <?php
        } else if (isset($successMSG)) {

        ?>
            <div>
                <b><span></span><?php echo $successMSG; ?></b>
            </div>
        <?php
        }

        ?>

        <form method="post" enctype="multipart/form-data">

            <table>

                <tr>
                    <td><label> Choose Your Uploading Image File</label></td>
                    <td>
                        <input type="file" name="user_img" accept="image/*">
                    </td>
                </tr>

                <tr>
                    <td>
                        <button type="submit" name="btnsave">
                            <span></span>&nbsp;save
                        </button>
                    </td>
                </tr>

                <tr>
                    <td><img src="user_images/<?php echo $imgFile ?>"></td>
                </tr>
            </table>



        </form>
    </div>
    </fieldset>

</body>

</html>