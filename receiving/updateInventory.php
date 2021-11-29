<!DOCTYPE html>
<html>
<head>
<title>Receiving Desk</title>
</head>
<body>

<?php 

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
//echo "Connected successfully to: " . $servername;

/* change character set to utf8 */
$conn->set_charset("utf8");

//Actual Program

echo "<h1>Receiving Desk</h1>";

echo "<form action='' method='post'>";

echo "Enter Number or Description of Item <br>";
echo "Number: <input type='text' name='number'> <br>";
echo "Description: <input type='text' name='description'> <br> <br>";
echo "Enter Increment Quantity <br>";
echo "<input type='text' name='quantity'> <br> <br>";
echo "<input type='submit'>";

echo "</form>";

//Increments the database by the amount set
$sql = "UPDATE inventory SET quantity = quantity + '".$_POST["quantity"]."' WHERE number = ".$_POST["number"];

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
}

echo "<br>";
echo $_POST['number'];
echo " updated by ";
echo $_POST['quantity'];
echo "! <br>";


?>

</body>
</html>