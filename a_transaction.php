<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Transaction</title>
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
				<div class="home_title">Add Transaction</div>
				<div class="breadcrumbs">
					<ul class="d-flex flex-row align-items-center justify-content-start">
						<li><a href="#">To add a new transaction in Library Database</a></li>
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
							<div class="checkout_title">Fill below Transaction Details</div>
								<div class="checkout_form_container">
									<form action="" id="checkout_form" class="checkout_form" method="POST">
									<div>
												<label for="checkout_company">Customer ID*</label>
												<input type="text" id="checkout_company" class="checkout_input" name="custId" required="required">
											</div>
										<div class="row">
											<div class="col-lg-6">
												<label for="checkout_name">Item ID* (Multiple Seperated by comma)</label>
												<input type="text" id="checkout_name" class="checkout_input" name="itemId" required="required">
											</div>
											<div class="col-lg-6">
												<label for="checkout_last_name">Item Price* (Multiple Seperated by comma)</label>
												<input type="text" id="checkout_last_name" class="checkout_input" name="itemPrice" required="required">
											</div></div>
											<button class="checkout_button trans_200" name="atran">Add Transaction</button>
										
									</form>
									<div class="order_text">
<?php
if(isset($_POST['atran']))
{
    $custID = ($_POST["custId"]);
    $itemID = ($_POST["itemId"]);
    $itemPrice = ($_POST["itemPrice"]);

    $result = mysqli_query($link, "SELECT * FROM CUSTOMER where cid='$custID'");
    if (mysqli_num_rows($result) == 0)
  	{
		print "<b><br/>&nbsp;Customer ID doesn't exist, try again or check the customer id for customer table!";
	}
	else
	{   
        $iArray = explode(',', $itemID);
        $iPriceArray = explode(',', $itemPrice);
        $totalPrice = 0;
        for ($i=0; $i < sizeof($iPriceArray); $i++) 
        { 
            $totalPrice = $totalPrice + $iPriceArray[$i];
        }

        $result1 = mysqli_query($link, "SELECT DISCOUNT_CODE FROM CUSTOMER where CID='$custID'");
		$dc_row = mysqli_fetch_row($result1);
		$var0 = $dc_row[0];
		$var1 = 1-2.5 * $var0/100;
		$sumtotalPrice = $totalPrice * $var1;
		$result2 = mysqli_query($link, "INSERT INTO TRANSACTIONS (date_of_trans, cid, total_price)  values (NOW(), '$custID', '$sumtotalPrice')");
		$tran_id=mysqli_insert_id($link);
		if (!$result2) 
		{
			print("&nbsp;Failed to update transaction, ERROR: ".mysqli_error($link));
		}
        else
        {	
			print "<b>&nbsp;<br/>TRANSACTION IS SUBMITTED SUCCESSFULLY!<br/></b>";
            $result3 = mysqli_query($link, "SELECT SUM(TOTAL_PRICE) FROM TRANSACTIONS WHERE CID='$custID'");
			$dcup_row = mysqli_fetch_row($result3);
			$var4 = $dcup_row[0];
            if($var4>=100 && $var4<200)
            {
                $result4 = mysqli_query($link, "UPDATE CUSTOMER SET DISCOUNT_CODE=1 WHERE CID='$custID'");
                if (!$result4)
                { 
                    print("&nbsp;Failed to update discount code for customer, ERROR: ".mysqli_error($link));
                }
            }
            if($var4>=200 && $var4<300)
            {
                $result4 = mysqli_query($link, "UPDATE CUSTOMER SET DISCOUNT_CODE=2 WHERE CID='$custID'");
                if (!$result4)
                { 
                    print("&nbsp;Failed to update discount code for customer, ERROR: ".mysqli_error($link));
                }
            }
            if($var4>=300 && $var4<400)
            {
                $result4 = mysqli_query($link, "UPDATE CUSTOMER SET DISCOUNT_CODE=3 WHERE CID='$custID'");
                if (!$result4)
                { 
                    print("&nbsp;Failed to update discount code for customer, ERROR: ".mysqli_error($link));
                }
            }
            if($var4>=400 && $var4<500)
            {
                $result4 = mysqli_query($link, "UPDATE CUSTOMER SET DISCOUNT_CODE=4 WHERE CID='$custID'");
                if (!$result4)
                { 
                    print("&nbsp;Failed to update discount code for customer, ERROR: ".mysqli_error($link));
                }
            }
            if($var4>=500)
            {
                $result4 = mysqli_query($link, "UPDATE CUSTOMER SET DISCOUNT_CODE=5 WHERE CID='$custID'");
                if (!$result4)
                { 
                    print("&nbsp;Failed to update discount code for customer, ERROR: ".mysqli_error($link));
                }
            }
            for ($i=0; $i < sizeof($iArray); $i++) 
            { 
				$result6 = mysqli_query($link, "INSERT INTO ITEM (_id, price) values ('$iArray[$i]','$iPriceArray[$i]')");
				$result5 = mysqli_query($link, "INSERT INTO ITEM_TRANSACTION (TID,ITEM_ID) values ('$tran_id','$iArray[$i]')");
				
            }
            if (!$result5 || !$result6)
            { 
                print("&nbsp;Failed to update item transaction, ERROR: ".mysqli_error($link));
            }
            else 
            {
                print "<b>&nbsp;<br/>ITEM ADDED IN TRANSACTION SUCCESSFULLY ADDED</b>";
            }
        }
    }
}
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
<?php 
	include 'footer.php';
	mysqli_close($link);
?>
</div>
</body>
</html>