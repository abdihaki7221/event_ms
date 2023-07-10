<?php
session_start();

include 'db_connect.php';
$msg = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $pass = md5($password);

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$username' && password='$pass'");
    $num = mysqli_num_rows($sql);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($sql);
        $_SESSION['username'] = $username;

        // Check if the code retrieved from the users table is equal to "1"
        if ($row['code'] != 1) {
            // Redirect to verification.php if the code is not "1"
            header("Location: verification.php");
            exit();
        } else {
            // Retrieve the usertype of the user from the database
            $usertype = $row['usertype'];

            // Redirect the user based on their usertype
            switch ($usertype) {
                case 'planner':
                    // Redirect to event_planner_dashboard.php for planners
                    header("Location: event_planner_dashboard.php");
                    exit();
                case 'attendee':
                    // Redirect to attendeedashbaord.php for attendees
                    header("Location: attendeedashboard.php");
                    exit();
                case 'managers':
                    // Redirect to managerDashboard.php for managers
                    header("Location: managerDashboard.php");
                    exit();
                case 'vendor':
                    // Redirect to vendordashboard.php for vendors
                    header("Location: vendordashboard.php");
                    exit();
                default:
                    // Handle other user types here or redirect to a default page
                    break;
            }
        }
    } else {
        $msg = "Incorrect username or password!";
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
					<div class="text-center mb-4">
			      <h4>Login into your account</h4>
			    </div>
			    <!-- Form -->
					<form class="px-3" method="post">
						<div class="text-center alert-danger ms-5 mb-2" style="border-radius:5px;" >
                 <?php echo $msg ?>
            </div>
						<!-- Input Box -->
						<div class="form-input">
							<span><i class="fa fa-envelope-o"></i></span>
							<input type="email" name="username" placeholder="Email Address" tabindex="10"required>
						</div>
						<div class="form-input">
							<span><i class="fa fa-lock"></i></span>
							<input type="password" name="password" placeholder="Password" required>
						</div>

			 	    <!-- Login Button -->
			      <div class="mb-3">
							<button type="submit" name="login" class="btn btn-block">Login</button>
						</div>
						<div class="text-left ">
			        <a href="reset.php" class="forget-link">Forgot password?</a>
			      </div>

            <div class="text-right ">
              <a href="user_registration.php" class="forget-link">Not Registered? <span class="text-info">SignUp</span></a>
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
