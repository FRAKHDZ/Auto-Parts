<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Items</h1>
<p>This is a paragraph.</p>
 
 <?php
$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM parts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	echo "Product: " . $row["description"] . "<br>" . "Pr<html>
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
<?php
$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM parts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  echo '<img src="' . $row["pictureURL"] . '" width="320" height="80"><br>' .
		  "<h3>Product: " . $row["description"] . 
		"<br>" . "Weight: " . $row["weight"] .	
		  "<br><br>" . "Price: $" . $row["price"].
		"<form action= ". '"' . 'checkout.php">' 
	. '<input type="hidden" id="num" name="num" value="' . $row["number"] . '">' . 
	'<input class="btnProduct" type="submit" value="Buy">' . '</form></h3><hr class="productHR"><br><br>';
  }
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>



ice: $" . $row["price"]. 
	"<br><br>" . "<form action= ". '"' . '/Auto-Parts/Auto-Parts/checkout.php">' 
	. '<input type="hidden" id="num" name="num" value="' . $row["number"] . '">' . 
	'<input type="submit" value="Buy">' . '</form>';
  }
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>



