<!DOCTYPE html>
<html lang="en">
<head>
<title>Cancel Transaction</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="aStar Fashion Template Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.3/bootstrap.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
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
				<div class="home_title">Cancel Transaction</div>
				<div class="breadcrumbs">
					<ul class="d-flex flex-row align-items-center justify-content-start">
						<li><a href="#">Cancel the provided transaction if it occured within last 30days from Library Database</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- End -->
		<!-- Show table data -->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="cart_extra_content cart_extra_coupon">
					<div class="cart_extra_title">Enter Transaction id below</div>
						<div class="coupon_form_container">
							<form action="" id="coupon_form" class="coupon_form" method="POST">
								<input type="text" class="coupon_input" required="required" name="deltxt">
								<button class="coupon_button" name="deletetr">Cancel Transaction</button>
							</form>
						</div>
						<div><br/></div>
						<div class="cart_bar">
							<ul class="align-items-center">
								<li>
								<?php
									if(isset($_POST['deletetr'])){
									$deltable = ($_POST['deltxt']);
									$result1 = mysqli_query($link, "select * from TRANSACTIONS where tid = '$deltable' and DATEDIFF(NOW(), DATE_OF_TRANS) < 30");
									$rowcount = mysqli_num_rows($result1);
								 if ($rowcount==0)
									{
										print("&nbsp;&nbsp;ERROR: Transaction ID: $deltable doesn't exist or older than 30days to delete.".mysqli_error($link));
									}
									else {
											$result2 = mysqli_query($link, "select ITEM_ID FROM ITEM_TRANSACTION where tid = '$deltable'");
											$item_del = mysqli_fetch_row($result2);
											$result3 = mysqli_query($link, "delete from ITEM_TRANSACTION where tid = '$deltable'");
											$result2 = mysqli_query($link, "select ITEM_ID FROM ITEM_TRANSACTION where tid = '$deltable'");
											while ($item_del = mysqli_fetch_row($result2)) {
											foreach ($item_del as $field)
											$result4 = mysqli_query($link, "delete from ITEM where _id = '$field'");
											}
											$result5 = mysqli_query($link, "delete from TRANSACTIONS where tid = '$deltable'");
											print "&nbsp;&nbsp;Below Transaction has been deleted successfully!<br/><br/>";
										}
									}	
							?>
							</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div><br/></div>
		<!-- End -->

<?php 
	include 'footer.php';
	mysqli_close($link);
?>
</div>
</body>
</html>