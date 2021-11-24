
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Items</h1>
<p>This is a paragraph.</p>
 
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

$sql = "SELECT * FROM parts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      while($row = $result->fetch_assoc()) {
        echo "Product: " . $row["description"] . "<br>" . "Price: $" . $row["price"].
        "<br><br>" . "<form action= ". '"' . '/Auto-Parts/Auto-Parts/checkout.html">' . '<input type="submit" value="Buy">' . '</form>';
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<!--
<form action="/Auto-Parts/Auto-Parts/checkout.html">
  <input type="checkbox" id="numID" name="numID" value="1">
  <label for="numID"> windshield w/ polymer</label><br>
  <input type="submit" value="Buy">
</form> 
-->

</body>
</html>

