<!DOCTYPE html>
<html>
<head>
<head><meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<h3>
<form action="payment.php" metod="post">
	<label for="name">Name:</label><br>
	<input type="text" id="name" name="name" value="John Doe"><br>
	<label for="Address">Address:</label><br>
	<input type="text" id="Address" name="Address" value="123 Main St"><br>
	<label for="email">Email:</label><br>
	<input type="text" id="email" name="email" value="z1234@niu.edu"><br>
  	<input class="btn" type="submit" value="Purchase">
</form> 
</h3>


<?php

include 'custFunctions.php';    //for getCartData() function




//call getCartData() to load cartData array
$cartData = getCartData();
$numR = count($cartData);	//assign number of rows to numR
$total = 0.00;					// zero out total


$counter = 0;		//zero out counter.
if ($numR > 0) {
  // output data of each row
  while($counter < $numR) {
	  echo '<img src="' . $cartData[$counter]["pictureURL"] . '" width="460" height="345"><br>' .
		  "<h3>Product: " . $cartData[$counter]["description"] . 
		  "<br>" . "Unit Weight: " . $cartData[$counter]["weight"] .	
		  "<br> Quantity: " . $cartData[$counter]["quant"] . 
		"<br><br>" . "Unit Price: $" . $cartData[$counter]["price"].
		
		"</h3><form action= ". '"' . 'checkout_delete.php">' 
 
	. '<input type="hidden" id="num" name="num" value="' . $cartData[$counter]["partNum"] . '">'  
	. 	'<input class="btn" type="submit" value="Delete">' . '</form>';
  
		$total = ($cartData[$counter]["quant"] * $cartData[$counter]["price"]) + $total;	
		
		$counter = $counter + 1;
  }
} else {
  echo "0 results";
}

echo "<h3><br>Total: $" . $total . "<br><br></h3>";
?>

</body>
</html>



