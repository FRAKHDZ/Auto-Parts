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

echo "Enter Item ID Number and/or Description of Item <br>";
echo "ID Number: <input type='text' name='number'> <br>";
echo "Description: <input type='text' name='description'> <br> <br>";
echo "Enter Increment Quantity <br>";
echo "<input type='text' name='quantity'> <br> <br>";
echo "<input type='submit'>";

echo "</form>";

if (isset ($_POST['number'])){
  $num = $_POST['number'];
}
if (isset ($_POST['description'])){
  $dsc = $_POST['description'];
}
if (isset ($_POST['quantity'])){
  $qnt = $_POST['quantity'];
}


if ( (isset($qnt)) && $qnt == NULL){
  //A valid quantity to increment is required.
  echo "<br> Please enter a valid quantity";
}
elseif ( isset($num) && isset($dsc) && $num != NULL && $dsc != NULL){
  //Check if there is a valid item in the database. Fetch number counted and turn into integer.
  $count = $conn->query("SELECT COUNT(1) FROM inventory WHERE number = $num AND description = '$dsc'")->fetch_array()[0]; 
  //If so, update inventory and inform user.
  if ($count == 1){
    $sql = "UPDATE inventory SET quantity = quantity + $qnt WHERE number = $num AND description = '$dsc'";
    $conn->query($sql) or die($conn->error);
    echo "<br> Item #$num, '$dsc updated by $qnt!";
  }
  else 
    echo "<br> Item #$num, '$dsc' is an invalid item.";
}
elseif ( isset($num) && $num != NULL) {
  //Same as previous elseif
  $count = $conn->query("SELECT COUNT(1) FROM inventory WHERE number = $num")->fetch_array()[0]; 
  if ($count == 1){
    $sql = "UPDATE inventory SET quantity = quantity + $qnt WHERE number = $num";
    $conn->query($sql) or die($conn->error);
    echo "<br> Item #$num updated by $qnt!";
  }
  else
    echo "<br> Item #$num is an invalid item.";
}
elseif ( isset($dsc) && $dsc != NULL) {
  $count = $conn->query("SELECT COUNT(1) FROM inventory WHERE description = '$dsc'")->fetch_array()[0]; 
  if ($count == 1){
    $sql = "UPDATE inventory SET quantity = quantity + $qnt WHERE description = '$dsc'";
    $conn->query($sql) or die($conn->error);
    echo "<br> Item '$dsc' updated by $qnt!";
  }
  else 
    echo "<br> Item '$dsc' is an invalid item.";
}
else {
  //If nothing entered, inform user.
  echo "<br> Enter an item number, description, or both.";
}

unset($num);
unset($dsc);
unset($qnt);
unset($_POST['number']);
unset($_POST['description']);
unset($_POST['quantity']);

$conn->close();

?>

</body>
</html>