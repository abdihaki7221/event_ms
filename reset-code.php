<?php require_once "controller_data.php"; ?>
<?php
$email = $_SESSION['username'];
if($email == false){
  header('Location: login.php');
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

				      <h4 class="mb-3">Link Was Sent</h4>
				  		<p class="mb-3 text-white">
				        Please, check your inbox for a password reset link..
				      </p>

              <?php
                      if(isset($_SESSION['info'])){
                          ?>
                          <div class="alert alert-success text-center">
                              <?php echo $_SESSION['info']; ?>
                          </div>
                          <?php
                      }
                      ?>
                      <?php
                      if(count($errors) > 0){
                          ?>
                          <div class="alert alert-danger text-center">
                              <?php
                              foreach($errors as $showerror){
                                  echo $showerror;
                              }
                              ?>
                          </div>
                          <?php
                      }
                      ?>

				      <div class="form-input">
								<span><i class="fa fa-envelope"></i></span>
								<input type="number" name="otp" placeholder="Enter verification code" tabindex="10"required>
							</div>
				      <div class="mb-3">
								<button type="submit" name="check-reset-otp"  class="btn">Submit</button>
							</div>
				    </form>
				  </div>


			<!-- FORM CONTAINER END -->
		</div>
	</div>



</body>
</html>
