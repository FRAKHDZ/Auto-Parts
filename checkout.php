<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Check out</h1>
<p>This is a paragraph.</p>

<?php 

$servername = "localhost";
$username = "student";
$password = "student";
$dbname = "auto-parts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully to: " . $servername;

/* change character set to utf8 */
$conn->set_charset("utf8");

// Collects data from "customers" table 
$sql = "INSERT INTO `cart`(`number`, `quantity`) VALUES ('". $_GET["num"] . "','1')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {  
	} 
	Print "</table>"; 
} else {
	Print "0 records found";
}
$conn->close();
?>

<form action="/Auto-Parts/Auto-Parts/payment.php" metod="post">
	<label for="numID">Quantity: </label>
	<input type="text" id="numID" name="numID" value="1"><br>
	<label for="name">Name:</label><br>
	<input type="text" id="name" name="name" value="John Doe"><br>
	<label for="Address">Address:</label><br>
	<input type="text" id="Address" name="Address" value="123 Main St"><br>
	<label for="email">Email:</label><br>
	<input type="text" id="email" name="email" value="z1234@niu.edu"><br>
  	<input type="submit" value="Purchase">
</form> 

</body>
</html>



