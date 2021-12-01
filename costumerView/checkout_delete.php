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

<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auto-parts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
} 

/* change character set to utf8 */
$conn->set_charset("utf8");

// Collects data from "customers" table 
$sql = "UPDATE cart SET quantity=quantity-1 WHERE num=" . $_GET["num"];
$result = $conn->query($sql);
$conn->close();
?>
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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auto-parts";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cart WHERE quantity != 0";
$result = $conn->query($sql);
$total = 0.00;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  echo '<img src="' . $row["pictureURL"] . '" width="460" height="345"><br>' .
		  "<h3>Product: " . $row["description"] . 
		  "<br>" . "Weight: " . $row["weight"] .	
		  "<br> Quantity: " . $row["quantity"] . 
		"<br><br>" . "Price: $" . $row["price"].
		
		"</h3><form action= ". '"' . 'checkout_delete.php">' 
 
	. '<input type="hidden" id="num" name="num" value="' . $row["num"] . '">'  
	. 	'<input class="btn" type="submit" value="Delete">' . '</form>';
  
		$total = ($row["quantity"] * $row["price"]) + $total;	
  
  }
} else {
  echo "0 results";
}
$conn->close();
echo "<h3><br>Total: $" . $total . "<br><br></h3>";
?>

</body>
</html>



