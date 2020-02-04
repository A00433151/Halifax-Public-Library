	<!-- Sidebar -->

	<div class="sidebar">
		
		<!-- Info -->
		<div class="info">
			<div class="info_content d-flex flex-row align-items-center justify-content-start">
				
				<!-- Language -->
				<div class="info_languages has_children">
					<div class="dropdown_text">DATE</div>
					<div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
					
					<!-- Language Dropdown Menu -->
					 <ul>
					 	<li><a href="">
							<div class="dropdown_text">
							<script>
								var currentDate = new Date()
								var day = currentDate.getDate()
								var month = currentDate.getMonth() + 1
								var year = currentDate.getFullYear()
								document.write("" + day + "-" + month + "-" + year + "")
							</script></div>
					 	</a></li>
					 </ul>

				</div>

				<!-- Currency -->
				<div class="info_currencies has_children">
					<div class="dropdown_text">TIME</div>
					<div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

					<!-- Currencies Dropdown Menu -->
					 <ul>
					 	<li><a href=""><div class="dropdown_text">
						<script>
								var currentDate = new Date()
								var hr = currentDate.getHours()
								var min = currentDate.getMinutes() + 1
								var sec = currentDate.getSeconds()
								document.write("" + hr + ":" + min + ":" + sec + "")
							</script></div></a></li>
					 </ul>

				</div>

			</div>
		</div>

		<!-- Logo -->
		<div class="sidebar_logo">
			<a href="index.php"><div>H<span>SL</span></div></a>
		</div>

		<!-- Sidebar Navigation -->
		<nav class="sidebar_nav">
			<ul>
				<li><a href="index.php">home<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				<li><a href="s_tables.php">Show Tables<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				<li><a href="a_article.php">Add Article<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				<li><a href="a_customer.php">Add Customer<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				<li><a href="a_transaction.php">Add Transaction<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				<li><a href="d_transaction.php">Cancel Transaction<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
			</ul>
		</nav>

		
		<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> 
    </script> 
  
    <script> 
        $.getJSON("https://api.ipify.org?format=json", 
                                          function(data) { 
  
            $("#getip").html(data.ip); 
        }) 
    </script> 

		<!-- Cart -->
		<div class="cart d-flex flex-row align-items-center justify-content-start">
			<div class="cart_text">Your IP Address: <p id="getip" align-items-center><p></div>
		</div>
	</div>