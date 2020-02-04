<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Article</title>
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
				<div class="home_title">Add Article</div>
				<div class="breadcrumbs">
					<ul class="d-flex flex-row align-items-center justify-content-start">
						<li><a href="#">To add an Article in Existing Magazine Volumes present in Library Database</a></li>
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
							<div class="checkout_title">Fill below Article Details</div>
								<div class="checkout_form_container">
									<form action="" id="checkout_form" class="checkout_form" method="POST">
										<div>
											<label for="checkout_company">Title*</label>
											<input type="text" id="checkout_company" class="checkout_input" name="atitle" required="required">
										</div>
										<div class="row">
											<div class="col-lg-6">
												<label for="checkout_name">Magazine ID*</label>
												<input type="text" id="checkout_name" class="checkout_input" name="amagid" required="required">
											</div>
											<div class="col-lg-6">
												<label for="checkout_last_name">Volume Number*</label>
												<input type="text" id="checkout_last_name" class="checkout_input" name="avol" required="required">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<label for="checkout_name">Pages*</label>
												<input type="text" id="checkout_name" class="checkout_input" name="apage" required="required">
											</div>
											<div class="col-lg-6">
												<label for="checkout_last_name">List of Authors*  (Multiple Seperated by comma)</label>
												<input type="text" id="checkout_last_name" class="checkout_input" name="alauthor" required="required">
											</div>
										</div>
										<button class="checkout_button trans_200" name="sarticle">Add Article</button>
									</form>
									<div class="order_text">
									<?php
if(isset($_POST['sarticle']))
{
    $title = ($_POST["atitle"]);
    $magid = ($_POST["amagid"]);
    $vol = ($_POST["avol"]);
    $page = ($_POST["apage"]);
    $author = ($_POST["alauthor"]);

    $result1 =mysqli_query($link, "SELECT * FROM VOLUME WHERE MAG_ID='$magid' and VOL_ID='$vol'");
    $result2 =mysqli_query($link, "SELECT * FROM AUTHOR WHERE _ID='$author'");
    if (mysqli_num_rows($result1) == 0 || mysqli_num_rows($result2) == 0)
    {
        print "<b><br/>&nbsp;Either the Magazine ID or the Volume Number or the list of Author (Author ID) doesn't exist, try again or check the Author Table or Magazine_Details for correct inputs!";
    }
    else
    {
        $aArray = explode(',', $author);
        $result3 =mysqli_query($link, "INSERT INTO ARTICLE (vol_id, mag_id, title, page_number)  values ('$vol','$magid','$title','$page')");
        if (!$result3) print("ERROR: ".mysqli_error($link));
		$tran_id=mysqli_insert_id($link);
        if ($result3 == 0)
        {
            echo "<b><br/>&nbsp;Article already exists! Try Again!</b>";
            exit;
        }
        else
        {
            for ($i=0; $i < sizeof($aArray); $i++) 
            {
                $result4 = mysqli_query($link, "INSERT INTO ARTICLE_AUTHOR (art_id, auth_id) values ('$tran_id','$aArray[$i]')");
            }
            if (!$result4)
            { 
                print("ERROR: ".mysqli_error($link));
            }
            else 
            {
                print "<b></br>&nbsp; AUTHOR and ARTICLE Details are now available</b>";
            }
        }
    }
}
?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
	include 'footer.php';
	mysqli_close($link);
	?>
</div>
</body>
</html>