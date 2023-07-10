<?php
session_start();
require 'PHPMailer.php';
require 'SMTP.php';
include 'db_connect.php';
$msg = "";
$msg_success = "";





function generateVerificationCode() {
    // Generate a random 4-digit code
    $code = rand(1000, 9999);
    return $code;
}

if (isset($_POST['confirm'])) {
    // Code verification logic
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $username = $_SESSION['username'];

    // Retrieve the stored code for the email
    $getCodeQuery = mysqli_query($conn, "SELECT code FROM users WHERE email='$username'");
    $row = mysqli_fetch_assoc($getCodeQuery);
    $storedCode = $row['code'];

    if ($code == $storedCode) {
      // Code matches, perform necessary actions

  $updateCodeQuery = mysqli_query($conn, "UPDATE users SET code=1 WHERE email='$username'");
      // Retrieve the usertype of the user from the database
      $getUserTypeQuery = mysqli_query($conn, "SELECT usertype FROM users WHERE email='$username'");
      $row = mysqli_fetch_assoc($getUserTypeQuery);
      $usertype = $row['usertype'];

      	$_SESSION['username'] = $username;

        header("Location: changePassword.php");



      $msg_success = "Code verification successful!";
  } else {
      $msg = "Invalid verification code!";
  }

} elseif (isset($_POST['resend'])) {
    // Resend verification code logic
    $username = $_SESSION['username'];

    // Generate a new verification code
    $newCode = generateVerificationCode();

        $mail =new PHPMailer\PHPMailer\PHPMailer();


        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'kainosmartevents@gmail.com';
        $mail->Password = 'qrfnrkxldfzsqana';
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('kainosmartevents@gmail.com', 'Paradise Planning');
        $mail->addAddress($username);

        $mail->Subject = 'Email Verification from Paradise Planning';
        $mail->Body = "Please verify your email using the code: $newCode";

      if (  $mail->send()) {
        $updateCodeQuery = mysqli_query($conn, "UPDATE users SET code='$newCode' WHERE email='$username'");
          $msg_success = "A new code has been sent to your email.";
        $_SESSION['username'] = $username;

      }else {
        $msg="failed to send";
      }



        // Email sent successfully
        // Redirect the user to the verification page


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
                        <p>A password Reset code has been sent to your email</p>
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
                            <input type="text" name="code" placeholder="Enter Code" tabindex="10" required>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-3">
                            <button type="submit" name="confirm" class="btn btn-block">Confirm</button>
                        </div>

                        <!--<div class="text-left mb-5 text-white">Don't have an account?
                            <a class="register-link" href="register.html">Register here</a>
                        </div>-->
                    </form>
                    <form method="post">
                    <div class="text-left">
                        <button type="submit" name="resend" class="btn text-light btn-primary">Resend Code?</button>
                    </div>
                  </form>

                </div>
            </div>
            <!-- FORM CONTAINER END -->
        </div>
    </div>
</body>
</html>
