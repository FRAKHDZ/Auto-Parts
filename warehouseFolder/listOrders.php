<!DOCTYPE html>
<html>
<head>
<title>Warehouse Interface</title>
</head>
<body>	

<form action='/warehouseFolder/partsOrdered.php' method='post'>
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
//echo "Connected successfully to: " . $servername;

/* change character set to utf8 */
$conn->set_charset("utf8");

// Collects data from "parts" table 
$sql = "SELECT * FROM customerorder WHERE dateShipped IS NULL ORDER BY Order_Date";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// print header
	Print "<h1>Choose a order to start packing</h1><br>";
	Print "<table border>"; 
	Print "<tr>"; 
	Print "<th>Order to pack</th><th>transNum</th><th>Order Date</th><th>name</th><th>email</th><th>shippingAddress</th>";
	Print "</tr>";
	//	loop til all orders are printed
	while($row = $result->fetch_assoc()) { 
		// add a radio button to replace the text box 
		Print "<tr>"; 
		Print "<td><input type='radio' name='transNumPass' value='".$row['transNum']."'> </td>";
		Print "<td>".$row['transNum']."</td>";
		Print "<td>".$row['Order_Date']."</td>"; 
		Print "<td>".$row['name']." </td>"; 
		Print "<td>".$row['email']." </td>"; 
		Print "<td>".$row['shippingAddress'] . " </td>";  
		Print "</tr>";
	} 
	Print "</table>"; 
} else {
	Print "0 records found";
}
$conn->close();

?> 

    <input type="submit" value="Submit">
</form>

</body>
</html>
