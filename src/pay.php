<?php
date_default_timezone_set('Africa/Nairobi');
session_start();
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");

$plan = $_GET['plan'];

$total_cost = 0;

$_SESSION['plan']=$plan;

if ($plan == "basic") {
	
	$total_cost = 700;
}
if ($plan == "pro") {

	$total_cost = 1500;
}
if ($plan == "advanced") {
	$total_cost = 1000;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,
			initial-scale=1.0" />
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
		}

		body {
			font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
			font-weight: bold;
		}

		.container {
			width: 100%;
			display: flex;
			flex-direction: column;
			flex-wrap: wrap;
			align-items: center;
			margin-top: 80px;
		}

		.header {
			background: white;
			font-size: 20px;
			width: 350px;

		}

		.text {
			text-align: left;
			margin-bottom: 20px;
		}

		.centre-content {
			width: 350px;
			display: flex;
			flex-direction: column;
			gap: 20px;
			flex-wrap: wrap;
		}

		.centre-content p {
			font-weight: 450;
		}


		.price {
			font-size: 20px;
			bottom: 15px;
			font-weight: 480;
		}

		.pay-now-btn {
			cursor: pointer;
			color: #fff;
			height: 50px;
			width: 100%;
			border-radius: 50px;
			border: none;
			font-size: 23px;
			background-color: royalblue;
		}

		.card-details p {
			margin: 20px 0 20px 0;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="header">
			<p class="text">
				Continue with Paypal
			</p>
		</div>

		<div class="centre-content">
			<h1 class="price"><?php echo ($total_cost . " /- "); ?><span>only</span></h1>

			<div class="card-details">
<!-- 			https://www.paypal.com/cgi-bin/webscr
 -->				<form action="<?php echo PAYPAL_URL; ?>" method="post">
					<input type="hidden" name="cmd" value="_cart">
					<input type="hidden" name="upload" value="1">
					<input type="hidden" name="business" value="jamesmuthiani981@gmail.com">
					<input type="hidden" name="item_name_1" value="Aggregated items">
					<input type="hidden" name="amount_1" value="<?php echo ($total_dollars); ?>">
					<input type="hidden" name="'cancel_url'" value="http://localhost/cancel.php">
					<input type="hidden" name="'return'" value="http://localhost/success.php">

					<button type="submit" class="pay-now-btn">
						Pay Now
					</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>