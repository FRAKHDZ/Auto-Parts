<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Page Title</title>

<link rel="stylesheet" href="style.css">
</head>
<body>

<ul class="topnav">
	<li class="active"><a  href="index.php">All Parts</a></li>
 
	<li class="right"><a href="cart.php">Cart</a></li>
</ul> 
<br></br>
<h1 class="title">
Huskie Auto Parts</h1>

<hr class="titleHR">

<form action="proc.php" method="post">
<h3><label for="CardNum">Card: </label>
<br>	<input type="text" id="CardNum" name="CardNum" value="6011 1234 4321 1234"><br>
	<label for="name">Name on Card:</label><br>
	<input type="text" id="cardName" name="cardName" value="John Doe"><br>
	<label for="exp">Expiration Date:</label><br>
	<input type="text" id="exp" name="exp" value="12/2024"><br>
	<label for="email">Email:</label><br>
	<input type="text" id="email" name="email" value="z1234@niu.edu"><br>
<?php
include 'custFunctions.php';    //for getCartData() function

$cartData = getCartData();
$numR = count($cartData);	//assign number of rows to numR
$total = 0.00;

$counter = 0;
while($counter < $numR) {
	/*echo "Product: " . $row["description"] . "Quantity: " . $row["quantity"] .
	" Price: " . $row["price"] .  " Total: " . $row["quantity"] * $row["price"] . "<br></br>";
	 */
	$total = ($cartData[$counter]["quant"] * $cartData[$counter]["price"]) + $total;

	$counter = $counter + 1;
}

echo "Total: " . $total . "<br></br>";


echo '<input type="hidden" id="total" name="total" value="' . $total . '">';
	

?></h3>

	<input class="btn" type="submit" value="purchase">
	<?php
	echo '<input type="hidden" id="name" name="name" value="'.$_POST['name'].'">';
	echo '<input type="hidden" id="shippingAddress" name="shippingAddress" value="'.$_POST['address'].'">';
	echo '<input type="hidden" id="email" name="email" value="'.$_POST['email'].'">';
	?>
</form>

</body>
</html>



