<?php
session_start();

require 'PHPMailer.php';
require 'SMTP.php';
include 'db_connect.php';
include 'head.php';

$msg = "";

function generateVerificationCode() {
    // Generate a random 4-digit code
    $code = rand(1000, 9999);
    return $code;
}

if (isset($_POST['signup'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $registerUserAs = mysqli_real_escape_string($conn, $_POST['register_user-as']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $name = $firstName . ' ' . $lastName;

    // Check if email already exists
    $checkEmailQuery = mysqli_query($conn, "SELECT * FROM users WHERE email='$username'");
    $numEmails = mysqli_num_rows($checkEmailQuery);

    if ($numEmails > 0) {
        $msg = "Email already exists!";
    } elseif ($password != $confirmPassword) {
        $msg = "Passwords do not match!";
    } else {
        $hashedPassword = md5($password);

        // Insert user data into the database with code column set to 0
        $verificationCode = generateVerificationCode(); // Generate the verification code
        $insertQuery = "INSERT INTO users (name, usertype, email, password, code) VALUES ('$name', '$registerUserAs', '$username', '$hashedPassword', '$verificationCode')";
        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
            $mail = new PHPMailer\PHPMailer\PHPMailer();
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
            $mail->Body = "Please verify your email using the code: $verificationCode";

            if ($mail->send()) {
                // Email sent successfully
                // Redirect the user to the verification page
                $_SESSION['username'] = $username;
                header("Location: verification.php");
                exit();
            } else {
                // Email sending failed
                $msg = "Error sending verification email. Please try again.";
                echo "Error: " . $mail->ErrorInfo;
            }
        } else {
            $msg = "Error registering user. Please try again.";
        }
    }
}
?>





<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
					<div class="text-center mb-1">
						<img src="logo.png" width="150px">
					</div>
					<div class="text-center mb-2">
			      <h4>Create your account</h4>
			    </div>
			    <!-- Form -->
					<form class="px-3" method="post">
						<div class="text-center alert-danger ms-5 mb-1" style="border-radius:5px;" >
                 <?php echo $msg ?>
            </div>
						<!-- Input Box -->

            <div class="form-input">
							<span><i class="fa fa-pencil"></i></span>
							<input type="text" name="firstname" placeholder="First Name" tabindex="10"required>
						</div>
            <div class="form-input">
							<span><i class="fa fa-pencil"></i></span>
							<input type="text" name="lastname" placeholder="Last Name" tabindex="10"required>
						</div>

  	<div class="form-input mb-3">
      <label for="register" class="text-light">Register As</label>
            <select class="form-select"  name="register_user-as" aria-label="Default select example">

            <option value="planner">Planner</option>
            <option value="attendee">Attendee</option>
            <option value="managers">Venue managers</option>
            <option value="vendor">vendor</option>
          </select>
        </div>

						<div class="form-input">
							<span><i class="fa fa-envelope-o"></i></span>
							<input type="email" name="username" placeholder="Email Address" tabindex="10"required>
						</div>
						<div class="form-input">
							<span><i class="fa fa-lock"></i></span>
							<input type="password" name="password" placeholder="Password" required>
						</div>
            <div class="form-input">
              <span><i class="fa fa-lock"></i></span>
              <input type="password" name="confirm_password" placeholder="Comfirm Password" required>
            </div>

			 	    <!-- Login Button -->
			      <div class="mb-3">
							<button type="submit" name="signup" class="btn btn-block">SignUp</button>
						</div>


            <div class="text-right ">
              <a href="login.php" class="forget-link">Already Registered? <span class="text-info">Login</span></a>
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
