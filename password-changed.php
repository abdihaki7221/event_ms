<?php require_once "controller_data.php"; ?>

<?php
if($_SESSION['info'] == false){
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
            <?php
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center mt-1">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
				    <form class="reset-password-form px-3" method="post">






				      <div class="mb-3">
								<button type="submit" name="login-now" class="btn">Login</button>
							</div>
				    </form>
				  </div>


			<!-- FORM CONTAINER END -->
		</div>
	</div>



</body>
</html>
