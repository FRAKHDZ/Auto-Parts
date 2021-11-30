<!DOCTYPE html>
<html>
<head>
<title>CSCI467/567 Access to Legacy Database Test Page</title>
</head>
<body>

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
//echo "Connected successfully to: " . $servername."<br><br>";

/* change character set to utf8 */
$conn->set_charset("utf8");

// zero out counter
$counter = 0;
// Collects data from "parts" table 
$sql = "SELECT number, quant FROM partsordered WHERE transNum=".$_POST["transNumPass"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// assign the number of rows to numR
	$numR = $result->num_rows;
	// assign number and quant to data array
	while($row = $result->fetch_assoc()) {  
		$data[$counter]['number'] = $row['number']; 
		$data[$counter]['quant'] = $row['quant'];  
		// incrment counter val
		$counter = $counter + 1;
	} 

} else {
	Print "0 records found";
}


//Check if date is in post
if (isset($_POST['date'])) {
	//if yes then update the customerOrder table
	$sql = "UPDATE customerOrder SET dateShipped = '".date("Y/m/d")."' WHERE transNum = ".$_POST["transNumPass"];

	if ($conn->query($sql) === FALSE) {
    	echo "Error updating record: " . $conn->error;
	} 
}

$conn->close(); // disconnect from auto-parts on localhost






$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die("unable to connect");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully to: " . $servername."<br><br>";

/* change character set to utf8 */
$conn->set_charset("utf8");

// zero out counter
$counter = 0;
while ($counter < $numR) {
	// make a sql query that gets the description and weight of each part in data array
	//echo $data[$counter]['number'];
	$sql = "SELECT description, weight FROM parts WHERE number=".$data[$counter]['number']." LIMIT 1";
	//$result = $conn->prepare($sql);
	//$result->execute;
	$result = $conn->query($sql) or die($conn->error);

	//echo $result; //for testing
	// assign description and weight to data array
	$row = $result->fetch_assoc();
	$data[$counter]['description'] = $row['description']; 
	$data[$counter]['weight'] = $row['weight'];   

	// incrment counter val
	$counter = $counter + 1;
}
$conn->close();


// print opening message
echo "<h1>Parts in order ".$_POST["transNumPass"]."</h1>";
// Lets print the table to the screen.
// zero out counter again
$counter = 0;
// we will need a var to keep track of the total weight
$totalW = 0;
if ($numR > 0) {
	// print header
	Print "<table border>"; 
	Print "<tr>"; 
	Print "<th>Part number</th><th>Part Description</th><th>Quantity</th><th>Weight</th>";
	Print "</tr>";
	while($counter < $numR) { 
		Print "<tr>"; 
		Print "<td>".$data[$counter]['number']."</td> "; 		//print part number
		Print "<td>".$data[$counter]['description']."</td>";	//print part description
		Print "<td>".$data[$counter]['quant']."</td>";			//print quantity of part

		// Store the product of weight and quantity in recordW
		$recordW = $data[$counter]['quant'] * $data[$counter]['weight'];
		// Add recordW to totalW
		$totalW = $totalW + $recordW;
		
		Print "<td>".$recordW."</td>";							//print the weight (quant * unit weight)

		Print "</tr>";

		$counter = $counter + 1;
	} 
	
	// Print the total weight at bottom of the table.
	Print "<tr><td></td><td></td>";
	Print "<td>Total weight:</td>";				//label
	Print "<td>".$totalW."</td>";				//total weight
	Print "</tr>";

	Print "</table>"; 
} else {
	Print "0 records found";
}

if (isset($_POST['date'])) {
	echo "Shipped on ".$_POST['date'];
} else {
	// add buttons to print shipping label.
	echo "<form action='' method='post'>";
		echo "<input type='hidden' name='transNumPass' id='transNumPass' value='".$_POST["transNumPass"]."'> <br>";
		//submit button for packing list
		echo "Date shipped: <input type='text' name='date' id='date' value='".date("Y/m/d")."'> <br>";
		echo "<input type='submit' value='Mark order as Shipped'> <br>";
	echo "</form>";

}

echo "<br><h2>Select what you would like to print:</h2>";

// add buttons to print packing list.
echo "<form action='/auto-parts/warehouseFolder/printFiles/packinglist.php' method='post'>";
	echo "<input type='hidden' name='transNumPass' id='transNumPass' value='".$_POST["transNumPass"]."'> <br>";
	//submit button for packing list
	echo "<input type='submit' value='Packing List'> <br>";
echo "</form><br>";

// add buttons to print invoice.
echo "<form action='/auto-parts/warehouseFolder/printFiles/printInvoice.php' method='post'>";
	echo "<input type='hidden' name='transNumPass' id='transNumPass' value='".$_POST["transNumPass"]."'>";
	echo "<input type='hidden' name='shippingWeight' id='shippingWeight' value='".$totalW."'>";
	if (isset($_POST['date'])) {
		echo "<input type='hidden' name='shipDate' id='shipDate' value='".$_POST['date']."'>";
	}
	//submit button for packing list
	echo "<input type='submit' value='Invoice'>";
echo "</form>";

// add buttons to print shipping label.
echo "<form action='/auto-parts/warehouseFolder/printFiles/printShippingLabel.php' method='post'>";
	echo "<input type='hidden' name='transNumPass' id='transNumPass' value='".$_POST["transNumPass"]."'> <br>";
	//submit button for packing list
	echo "<input type='hidden' name='shippingWeight' id='shippingWeight' value='".$totalW."'>";
	echo "<input type='submit' value='Shipping Label'> <br>";
echo "</form>";

?>



</body>
</html>







