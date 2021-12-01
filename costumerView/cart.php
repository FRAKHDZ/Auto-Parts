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


//edit to ping legacy database for all the jucy data!!!!!!!!

//This function returns a 2-D array named 
//cartData[index][field name] = (partNum, quant, price, weight, picUrl, description)
function getCartData()
{



	return $cartData;
}


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

// here we are getting partNum and quant from the cart table
$sql = "SELECT * FROM cart WHERE quant != 0";
$cartQueryReturn = $conn->query($sql); // store it in cartQueryReturn
$total = 0.00;					// zero out total
$counter = 0;					//zero out counter
if ($cartQueryReturn->num_rows > 0) {
	//set a var named numR as the number of rows in cartQueryReturn
	$numR = $cartQueryReturn->num_rows;
	// output data of each row into a array named cartData til there is no data left in cartQueryReturn
	while($row = $cartQueryReturn->fetch_assoc()) {
		//load data into cartData[counter][''] from row
		$cartData[$counter]['partNum'] = $row['partNum'];
		$cartData[$counter]['quant'] = $row['quant'];

		$counter = $counter + 1;
	}
}
$conn->close(); //close connection with local DB
// Now we have a 2D array named cartData = (partNum, quant)


// info for legacy database
$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die("unable to connect");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully to: " . $servername;

/* change character set to utf8 */
$conn->set_charset("utf8");











$conn->close(); //close connection with legacy DB
// Now we have a 2D array named cartData = (partNum, quant, price, weight, picUrl, description)




//if we need to go back to local then put it here




if ($cartData->num_rows > 0) {
  // output data of each row
  while($row = $cartData->fetch_assoc()) {
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
$conn->close(); //close connection with local DB
echo "<h3><br>Total: $" . $total . "<br><br></h3>";
?>

</body>
</html>



