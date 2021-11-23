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
echo "Connected successfully to: " . $servername."<br><br>";

/* change character set to utf8 */
$conn->set_charset("utf8");

echo "Packing list for order ".$_POST["authNumPass"];
// Collects data from "parts" table 
$sql = "SELECT number, quant FROM partsordered WHERE authNum=".$_POST["authNumPass"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// print header
	Print "<table border>"; 
	Print "<tr>"; 
	Print "<th>Part number</th><th>Quant</th>";
	Print "</tr>";
	while($row = $result->fetch_assoc()) { 
		Print "<tr>"; 
		Print "<td>".$row['number'] . "</td> "; 
		Print "<td>".$row['quant'] . " </td>";  
	} 
	Print "</table>"; 
} else {
	Print "0 records found";
}







?>