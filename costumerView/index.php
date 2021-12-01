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
<br>
<h1 class="title">
Huskie Auto Parts</h1>

<hr class="titleHR">
<?php


//access legacy database
$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM parts";
$result = $conn->query($sql);
$conn->close();

if (isset($_POST['num'])) {
	// add to the cart
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

	//check if part number is in cart
	$sql = "SELECT * FROM cart WHERE partNum=".$_POST['num'];
	$result2 = $conn->query($sql);
	//$row = $result->fetch_assoc();
	if($result2->num_rows == FALSE)
	{
		//if num_rows is false, insert it into cart table
		$sql = "INSERT INTO cart (partNum, quant) VALUES (".$_POST['num'].", ".$_POST['quant'].")";
		$result2 = $conn->query($sql);
	} else {
		//else update the record on the cart table by the quantity
		$sql = "UPDATE cart SET quant=".$_POST['quant']."+quant WHERE partNum=" . $_POST["num"];
		$result2 = $conn->query($sql);
	}
	$conn->close();
}



if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  echo '<img src="' . $row["pictureURL"] . '" width="320" height="80"><h3>' .
		  $row["description"] . 
		"<br>" . $row["weight"] .	
		  ' lB<br><br>$' . $row["price"].
		'<form action='. '"" method="post">'
	. '<input type="hidden" id="num" name="num" value="' . $row["number"] . '">';
	echo '<input type=text id="quant" name="quant" value=1>'; 
	echo '<input class="btnProduct" type="submit" value="Buy">' . '</form></h3><hr class="productHR"><br><br>';
  }
}

?>

</body>
</html>

 

