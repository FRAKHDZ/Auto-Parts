<!DOCTYPE html">
<html>
<head>
<title>CSCI467/567 Access to Legacy Database Test Page</title>
</head>
<body>	
<h3>Customer Database Content</h3>
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

// Collects data from "customers" table 
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// print header
	Print "<table border>"; 
	Print "<tr>"; 
	Print "<th>Id</th><th>Name</th><th>City</th><th>Street</th><th>Contact</th>";
	Print "</tr>";
	while($row = $result->fetch_assoc()) { 
		Print "<tr>"; 
		Print "<td>".$row['id'] . "</td> "; 
		Print "<td>".$row['name'] . " </td>"; 
		Print "<td>".$row['city'] . " </td>"; 
		Print "<td>".$row['street'] . " </td>"; 
		Print "<td>".$row['contact'] . " </td></tr>"; 
	} 
	Print "</table>"; 
} else {
	Print "0 records found";
}
$conn->close();
 
?> 
</body>
</html>
