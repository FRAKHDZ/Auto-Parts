<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Check out</h1>
<p>This is a paragraph.</p>

<form action="/Auto-Parts/Auto-Parts/proc.php" metod="post">
	<label for="CardNum">Card: </label>
	<input type="text" id="CardNum" name="CardNum" value="6011 1234 4321 1234"><br>
	<label for="name">Name on Card:</label><br>
	<input type="text" id="name" name="name" value="John Doe"><br>
	<label for="exp">Expiration Date:</label><br>
	<input type="text" id="exp" name="exp" value="12/2024"><br>
	<label for="email">Email:</label><br><!DOCTYPE html>
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

<form action="proc.php" metod="post">
<h3><label for="CardNum">Card: </label>
<br>	<input type="text" id="CardNum" name="CardNum" value="6011 1234 4321 1234"><br>
	<label for="name">Name on Card:</label><br>
	<input type="text" id="name" name="name" value="John Doe"><br>
	<label for="exp">Expiration Date:</label><br>
	<input type="text" id="exp" name="exp" value="12/2024"><br>
	<label for="email">Email:</label><br>
	<input type="text" id="email" name="email" value="z1234@niu.edu"><br>
<?php
$servername = "localhost";
$username = "student";
$password = "student";
$dbname = "auto-parts";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$sql = "SELECT * FROM cart WHERE NOT quantity='0';";

$result = $conn->query($sql);
$total = 0.00;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "Product: " . $row["description"] . "Quantity: " . $row["quantity"] .
		" Price: " . $row["price"] .  " Total: " . $row["quantity"] * $row["price"] . "<br></br>";
		$total = ($row["quantity"] * $row["price"]) + $total;
	}
}
echo "Total: " . $total . "<br></br>";
$conn->close();

echo '<input type="hidden" id="total" name="total" value="' . $total . '">
<input class="btn" type="submit" value="purchase">
</form>'	

?></h3>
</body>
</html>




	<input type="text" id="email" name="email" value="z1234@niu.edu"><br>
  	<input type="submit" value="Purchase">
</form> 

</body>
</html>



