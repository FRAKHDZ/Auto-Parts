<?php

//access legacy database
$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT number, description FROM parts";
$resultLegacy = $conn->query($sql);
$conn->close();

$numR = $resultLegacy->num_rows;


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


$row = $resultLegacy->fetch_assoc();
$row = $resultLegacy->fetch_assoc();
$row = $resultLegacy->fetch_assoc();
$row = $resultLegacy->fetch_assoc();
$row = $resultLegacy->fetch_assoc();


$counter = 6;
while ($counter < $numR)
{
    $row = $resultLegacy->fetch_assoc();
    $sql = "INSERT INTO inventory (number, description, quantity) VALUES (".$row['number'].", '".$row['description']."', 0)";
    $conn->query($sql);

    $counter = $counter + 1; //incrment counter
}
$conn->close();




?>