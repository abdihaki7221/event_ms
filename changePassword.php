<?php
session_start();

include 'db_connect.php';
$msg = "";
$msg_success = "";



if (isset($_POST['Change_Password'])) {
    // Code verification logic
    $password = mysqli_real_escape_string($conn,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);
    $username = $_SESSION['username'];

    $pass = md5($password);





    if ($password == $confirm_password) {


        $updateCodeQuery = mysqli_query($conn, "UPDATE users SET password=$pass WHERE email='$username'");

        $msg_success = "successfully changed the password. please Login!";

    //if the update is successful then   $msg_success = "Your password has been changed successfully!";


  } else {
      $msg = "passwords dont match";
  }

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <style>
        .transparent-button {
            background: transparent;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row ">
            <!-- IMAGE CONTAINER BEGIN -->
            <div class="col-lg-6 col-md-6 d-none d-md-block infinity-image-container"></div>
            <!-- IMAGE CONTAINER END -->

            <!-- FORM CONTAINER BEGIN -->
            <div class="col-lg-6 col-md-6 infinity-form-container">
                <div class="col-lg-9 col-md-12 col-sm-9 col-xs-12 infinity-form">
                    <!-- Company Logo -->
                    <div class="text-center mb-3 mt-5">
                        <img src="logo.png" width="150px">
                    </div>

                    <div class="text-center text-light">
                        <p>Please change Your Password</p>
                    </div>

                    <!-- Form -->
                    <form class="px-3" method="post">
                        <div class="text-center alert-danger ms-5 mb-2" style="border-radius:5px;">
                            <?php echo $msg ?>
                        </div>

                        <div class="text-center alert-success ms-5 mb-2" style="border-radius:5px;">
                            <?php echo $msg_success ?>
                        </div>
                        <!-- Input Box -->
                        <div class="form-input">
                            <span><i class="fa fa-pencil"></i></span>
                            <input type="text" name="new_password" placeholder="Enter new Password" tabindex="10" required>
                        </div>

                        <div class="form-input">
                            <span><i class="fa fa-pencil"></i></span>
                            <input type="text" name="confirm_password" placeholder="Confirm Your password" tabindex="10" required>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-3">
                            <button type="submit" name="Change_Password" class="btn btn-block">Change</button>
                        </div>

                        <!--<div class="text-left mb-5 text-white">Don't have an account?
                            <a class="register-link" href="register.html">Register here</a>
                        </div>-->
                    </form>

                </div>
            </div>
            <!-- FORM CONTAINER END -->
        </div>
    </div>
</body>
</html>
