<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Customer</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="aStar Fashion Template Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.3/bootstrap.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap-4.1.3/popper.js"></script>
<script src="styles/bootstrap-4.1.3/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/Isotope/fitcolumns.js"></script>
<script src="js/custom.js"></script>
<script src="js/checkout.js"></script>
</head>
<body>
<?php
        	require("dbconnection.php");
  			$link = mysqli_connect($server, $username, $password);
        	mysqli_select_db($link, $dbname)
			or die("Couldn't open $dbname: ".mysqli_error($link));
		?>
<div class="super_container">
<?php include 'header.php';?>
	<!-- Content Page -->
	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/product_background.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="home_content">
				<div class="home_title">Add Customer</div>
				<div class="breadcrumbs">
					<ul class="d-flex flex-row align-items-center justify-content-start">
						<li><a href="#">To add a customer in Library Database</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- End -->
	<div class="checkout">
		<div class="section_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="checkout_container d-flex flex-xxl-row flex-column align-items-start justify-content-start">
							<div class="billing checkout_box">
							<div class="checkout_title">Fill below Customer Details</div>
								<div class="checkout_form_container">
									<form action="" id="checkout_form" class="checkout_form" method="POST">
										<div class="row">
											<div class="col-lg-6">
												<label for="checkout_name">First Name*</label>
												<input type="text" id="checkout_name" class="checkout_input" name="fname" required="required">
											</div>
											<div class="col-lg-6">
												<label for="checkout_last_name">Last Name*</label>
												<input type="text" id="checkout_last_name" class="checkout_input" name="lname" required="required">
											</div>
										</div>
										<div>
											<label for="checkout_phone">Phone no*</label>
											<input type="phone" id="checkout_phone" class="checkout_input" name="cphone" required="required">
										</div>
										<div>
											<label for="checkout_address">Address*</label>
											<input type="text" id="checkout_address" class="checkout_input" name="addr" required="required">
										</div>
                                        <div class="checkout_extra">
                                        <label class="checkbox_container">If already exists, add as new&nbsp;&nbsp;</label>
                                        <input type="checkbox" name="bcheck">
										</div>
										<button class="checkout_button trans_200" name="acus">Add Customer</button>
									</form>
									
									<div>
									<?php 
									if(isset($_POST['acus'])){ 
										$fname = ($_POST['fname']);
										$lname = ($_POST['lname']);
										$cphone = ($_POST['cphone']);
										$caddr = ($_POST['addr']);
										$result1 = mysqli_query($link, "SELECT * FROM CUSTOMER where fname = '$fname' and lname = '$lname'");
									    if (mysqli_num_rows($result1) != 0  && isset($_POST['bcheck']) != 1)
  									    {
									    	print "<br/>&nbsp;Exists, Select the checkbox and try again!";
									    }
									    else
									      {
  											$result2 = mysqli_query($link, "INSERT into CUSTOMER(FNAME, LNAME, TELEPHONE_NUMBER, MAILING_ADDRESS, DISCOUNT_CODE) values ('$fname','$lname','$cphone','$caddr',0)");
											if (!$result2){ 
   												print("ERROR: ".mysqli_error($link));
   											}else {
   												print "<br/><b>&nbsp;&nbsp;NEW CUSTOMER SUCCESSFULLY ADDED</b>";
   											 }
									  }}
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php';
mysqli_close($link);
?>
</div>
</body>
</html>