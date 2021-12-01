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

//echo $_POST['description'];

$rNum = 0;
//Increments the database by the amount set

/*
echo "<br>";
echo $_POST['number'];
echo "<br>";
echo $_POST['description'];
echo "<br>";
echo $_POST['quantity'];
*/

$num = $_POST['number'];
$dsc = $_POST['description'];
$qnt = $_POST['quantity'];

echo "<br> $dsc";


if ($num != NULL) {
  $sql = "UPDATE inventory SET quantity = quantity + $qnt WHERE number = $num";
  $rNum = 1;
}

if ($dsc != NULL) {
  $sql = "UPDATE inventory SET quantity = quantity + $qnt WHERE description = '$dsc'";
  $rNum = 2;
}
$conn->query($sql) or die($conn->error);

//$sql = "UPDATE inventory SET quantity = quantity + $qnt WHERE description = '$dsc'";


//else {
//  echo "<br> Invalid Number and Description";
//}


//Correct Code for string, I guess.
//$descBoy = "Wrench";
//$sql = "UPDATE inventory SET quantity = 500 WHERE description = '$descBoy'";
//$conn->query($sql) or die($conn->error);

//This worked: UPDATE `inventory` SET `quantity`=200 WHERE `description`="Wrench"


//if ($conn->query($sql) === TRUE) {
//    echo "Record updated successfully";
//  } else {
//    echo "Error updating record: " . $conn->error;
//}

if($rNum == 1){
  echo "<br> Item Number ";
  echo $_POST['number'];
  echo " updated by ";
  echo $_POST['quantity'];
  echo "! <br>";
}
if($rNum == 2){
  echo "<br>";
  echo $_POST['description'];
  echo " updated by ";
  echo $_POST['quantity'];
  echo "! <br>";
}

unset($num);
unset($dsc);
unset($qnt);
unset($_POST['number']);
unset($_POST['description']);
unset($_POST['quantity']);
unset($rNum);

$conn->close();

//echo "<br> The new value of description is ";
//echo $_POST["description"];

?>

</body>
</html>