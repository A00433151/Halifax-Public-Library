
<!DOCTYPE html>
<html lang="en">
<head>
<title>Show Tables</title>
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
				<div class="home_title">Show Tables</div>
				<div class="breadcrumbs">
					<ul class="d-flex flex-row align-items-center justify-content-start">
						<li><a href="#">Show All the tables available in Library Database</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- End -->
	<!-- Show database table -->
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="checkout_button trans_200"><a href="#" onclick="myFunction()">Show Database Tables</a></div>
							<div style="display:none;" id="divshowtable">
							<div class="cart_bar">
									<?php
										$result1 = mysqli_query($link, "SELECT table_name FROM information_schema.tables where table_schema='$dbname'");
										if (!$result1) print("ERROR: ".mysqli_error($link));
										else 
										{
											$num_rows1= mysqli_num_rows($result1);
											print "<br/>&nbsp;&nbsp;&nbsp;<b>$num_rows1</b> tables are available in the database<br/><br/>";
											showtable($result1);
										}
										function showtable($atable) 
										{
        									print "<table border=0;>\n";
											while ($a_row = mysqli_fetch_row($atable)) 
											{
       											print "<tr>";
        											foreach ($a_row as $field) print "<td>&nbsp;&nbsp;&nbsp;$field</td>";
        										print "</tr>";
        									}
    										print "</table><br/>";
										}
        							?>
							</div></div>
					</div>
				</div>
			</div>
			<div><br/></div>
			<script>
			function myFunction() {
  			var x = document.getElementById("divshowtable");
  			if (x.style.display === "none") {
    			x.style.display = "block";
  			} else {
    			x.style.display = "none";
 		 	}
			}
			</script>
		<!-- End -->
		<!-- Show table data -->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="cart_extra_content cart_extra_coupon">
					<div class="cart_extra_title">Enter Table Name below</div>
						<div class="coupon_form_container">
							<form action="" id="coupon_form" class="coupon_form" method="POST">
								<input type="text" class="coupon_input" name="sdtable" required="required">
								<button class="coupon_button" name="showtable">show table</button>
							</form>
						</div>
						<div class="cart_bar">
							<?php
								if(isset($_POST['showtable'])){
									$clow = ($_POST['sdtable']);
									$sdtable = strtoupper($clow);
									$result2 = mysqli_query($link, "select * from $sdtable");
									if (!$result2) print("<br/>&nbsp;&nbsp;SQL Error: Table $dbname.$sdtable Doesn't Exist. <br/> Enter Tables from the list in Show Database Tables!");
									else {
									$num_rows2 = mysqli_num_rows($result2);
									print "<br/><b>&nbsp;$num_rows2&nbsp;&nbsp;</b> rows returned<br/><br/>";
									prtable($result2);
									}
								}
								function prtable($shtable) {
									print "<table border=1>\n";
									while ($a_row = mysqli_fetch_row($shtable)) {
										print "<tr>";
										foreach ($a_row as $field) print "<td>&nbsp;&nbsp;$field&nbsp;&nbsp;</td>";
										print "</tr>";
									}
									print "</table>";
								}
							?>
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