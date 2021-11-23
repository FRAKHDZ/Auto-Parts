<!DOCTYPE html>
<html>
<head>
<title>CSCI467/567 Access to Legacy Database Test Page</title>
</head>
<body>	
<h3>Parts Database Content</h3>
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auto-parts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die("unable to connect");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully to: " . $servername;

/* change character set to utf8 */
$conn->set_charset("utf8");

// Collects data from "parts" table 
$sql = "SELECT * FROM customerorder";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// print header
	Print "<table border>"; 
	Print "<tr>"; 
	Print "<th>authNum</th><th>name</th><th>email</th><th>shippingAddress</th><th>orderStatus</th>";
	Print "</tr>";
	while($row = $result->fetch_assoc()) { 
		Print "<tr>"; 
		Print "<td>".$row['authNum'] . "</td> "; 
		Print "<td>".$row['name'] . " </td>"; 
		Print "<td>".$row['email'] . " </td>"; 
		Print "<td>".$row['shippingAddress'] . " </td>"; 
		Print "<td>".$row['orderStatus'] . " </td></tr>"; 
	} 
	Print "</table>"; 
} else {
	Print "0 records found";
}
$conn->close();

?> 

<form action="/warehouseFolder/partsOrdered.php" method="post">
	<label>authNum:</label> <br>
    <input type="text" name="authNumPass" value="12345" /> <br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
