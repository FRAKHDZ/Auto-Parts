<!DOCTYPE html>
<html>
<head>
<title>Print Shipping Label</title>
</head>
<body>

<?php

//First get info from
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

/* change character set to utf8 */
$conn->set_charset("utf8");

//Make a query to get customer name, order date, shipping address, and dateShipped
$sql = "SELECT date, name, shippingAddress FROM customerOrder WHERE authNum=".$_POST["authNumPass"]." LIMIT 1";  //Maybe add pictures
$result = $conn->query($sql) or die($conn->error);

// assign customer info to cust variables
$custInfo = $result->fetch_assoc();      //load the results into custInfo


// print our company info
echo "<h3>Order number: ".$_POST["authNumPass"];
echo "<br>Order Placed: ".$custInfo['date']."<br>";
echo "Date Shipped: ".date("Y/m/d")."<br>";
echo "Package weight: ".$_POST['shippingWeight']." lb</h3>";
echo "<h3>Warehouse information:</h3>";
echo "<h4>Company Name<br>Company address<br>etc.";
echo "</h4><br>";
// print customer into
echo "<h3>Ship to:</h3>";
echo "<h4>".$custInfo['name']."<br>"; //edit these
echo $custInfo['shippingAddress']."<br>";
echo "</h4>";


/*
//update the customerOrder table
$sql = "UPDATE customerOrder SET dateShipped = '".date("Y/m/d")."' WHERE authNum = ".$_POST["authNumPass"];

if ($conn->query($sql) === FALSE) {
    echo "Error updating record: " . $conn->error;
} 
*/

$conn->close();  // Disconnect from auto-parts database on localhost
?>

</body>
</html>