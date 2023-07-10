
<?php

$msg="";

require 'PHPMailer.php';
require 'SMTP.php';
		include 'db_connect.php';

  session_start();
// Check if the form is submitted
if (isset($_POST['check-email'])) {
    // Retrieve the email address from the form
    $email = $_POST['username'];



    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Email does not exist in the users table
        $msg = "Email does not exist";
    } else {
        // Email exists, generate and store a random code in the users table
        $code = generateRandomCode(); // Implement your own function to generate a random code
        $updateSql = "UPDATE users SET code = '$code' WHERE email = '$email'";
        $conn->query($updateSql);

        // Send the code to the email address

				$mail = new PHPMailer\PHPMailer\PHPMailer();
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 587;
				$mail->SMTPAuth = true;
				$mail->Username = 'kainosmartevents@gmail.com';
				$mail->Password = 'qrfnrkxldfzsqana';
				$mail->SMTPSecure = 'tls';

				$mail->setFrom('kainosmartevents@gmail.com', 'Paradise Planning');
				$mail->addAddress($email);

				$mail->Subject = 'Password Reset code from Paradise Planning';
				$mail->Body = "Please Use these reset code: $code to recover your account" ;

				if ($mail->send()) {
						// Email sent successfully
						// Redirect the user to the verification page
						$_SESSION['username'] = $email;
						  header("Location: confirm_code.php");
						exit();
				} else {
						// Email sending failed
						$msg = "Error sending verification email. Please try again.";
						echo "Error: " . $mail->ErrorInfo;
				}

    }

    $conn->close();
}

function generateRandomCode() {
	// Generate a random 4-digit code
	$code = rand(1000, 9999);
	return $code;
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Reset</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<!-- IMAGE CONTAINER BEGIN -->
			<div class="col-lg-6 col-md-6 d-none d-md-block infinity-image-container"></div>
			<!-- IMAGE CONTAINER END -->


			<!-- FORM CONTAINER BEGIN -->
			<div class="col-lg-6 col-md-6 infinity-form-container">
				<div class="col-lg-8 col-md-12 col-sm-8 col-xs-12 infinity-form">
					<div class="text-center mb-3 mt-5">
						<img src="logo.jpg" width="150px">
					</div>
        	<div class="reset-form d-block">
				    <form class="reset-password-form px-3" method="post">

							<div class="text-center alert-danger ms-5 mb-1" style="border-radius:5px;" >
									 <?php echo $msg ?>
							</div>

				      <h4 class="mb-3">Reset Your password</h4>
				  		<p class="mb-3 text-white">
				        Please enter your email address and we will send you a password reset link.
				      </p>



				      <div class="form-input">
								<span><i class="fa fa-envelope"></i></span>
								<input type="email" name="username" placeholder="Email Address" tabindex="10"required>
							</div>
				      <div class="mb-3">
								<button type="submit" name="check-email" class="btn">Send Reset Link</button>
							</div>
				    </form>
				  </div>


			<!-- FORM CONTAINER END -->
		</div>
	</div>



</body>
</html>
