<!DOCTYPE html>
<html>
<head>
<title>CSCI467/567 Access to Legacy Database Test Page</title>
</head>
<body>	
<h3>Parts Database Content</h3>
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
echo "Connected successfully to: " . $servername;

/* change character set to utf8 */
$conn->set_charset("utf8");

// Collects data from "parts" table 
$sql = "SELECT * FROM parts";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// print header
	Print "<table border>"; 
	Print "<tr>"; 
	Print "<th>Number</th><th>Description</th><th>Price</th><th>Weight</th><th>Picture</th>";
	Print "</tr>";
	while($row = $result->fetch_assoc()) { 
		Print "<tr>"; 
		Print "<td>".$row['number'] . "</td> "; 
		Print "<td>".$row['description'] . " </td>"; 
		Print "<td>".$row['price'] . " </td>"; 
		Print "<td>".$row['weight'] . " </td>"; 
		Print "<td><a href='".$row['pictureURL'] . "'>link</a> </td></tr>"; 
	} 
	Print "</table>"; 
} else {
	Print "0 records found";
}
$conn->close();
 	
?> 
</body>
</html>
