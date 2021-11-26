<!DOCTYPE html>
<html>
<head>
<title>Print Invoice</title>
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

/* change character set to utf8 */
$conn->set_charset("utf8");

// zero out counter
$counter = 0;
// Collects data from "parts" table 
$sql = "SELECT number, quant FROM partsordered WHERE authNum=".$_POST["authNumPass"];
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



//put query for customer info here
$sql = "SELECT date, name, email, shippingAddress FROM customerOrder WHERE authNum=".$_POST["authNumPass"]." LIMIT 1";  //Maybe add pictures
$result = $conn->query($sql) or die($conn->error);

// assign customer info to cust variables
$row = $result->fetch_assoc();      //load row
$custDate = $row['date'];
$custName = $row['name'];
$custEmail = $row['email'];
$custAddress = $row['shippingAddress'];



//put weight class query here
$priceShipping = 1.00;
$from = 0;    
$to = 0;

// Collects data from "parts" table 
$sql = "SELECT weight, price FROM shippingbrackets";
$result = $conn->query($sql);
// assign weight bracket values to the from and to values.
// also set priceShipping
if ($result->num_rows > 0) {
    // To get the bottom of the weight bracket:
    // Loop through result while theres still data in result
    // AND while shipping weight (passed from POST) is greater than than the weight of current bracket.
	while($row = $result->fetch_assoc() and ($_POST["shippingWeight"] > $row['weight'])) { 
        $from = $row['weight'];             // Set the bottom of weight bracket (from) to weight of current row
	}

    // The current $row['weight'] should hold the top of weight bracket.
    $to = $row['weight'];               // Assign this value to the top of weight bracket (to)
    // This row will also hold how much will be charged for shipping
    $priceShipping = $row['price'];     // Assign this price to the priceShipping value

} else {
	Print "0 records found";
}
$conn->close();  // Disconnect from auto-parts database on localhost





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

/* change character set to utf8 */
$conn->set_charset("utf8");

// zero out counter
$counter = 0;
while ($counter < $numR) {
	// make a sql query that gets the description and price of each part in data array
	$sql = "SELECT description, price FROM parts WHERE number=".$data[$counter]['number']." LIMIT 1";  //Maybe add pictures
	//$result = $conn->prepare($sql);
	//$result->execute;
	$result = $conn->query($sql) or die($conn->error);

	//echo $result; //for testing
	// assign description and price to data array
	$row = $result->fetch_assoc();
	$data[$counter]['description'] = $row['description']; 
	$data[$counter]['price'] = $row['price'];   

	// incrment counter val
	$counter = $counter + 1;
}
$conn->close(); // Disconnect from blitz.cs.niu.edu


// print invoice header before table:
echo "<h1>Invoice</h1>";
// print our company info
echo "<h3>Order number: ".$_POST["authNumPass"];
echo "<br>Order Date".$custDate."</h3><br>";
echo "<h3>Warehouse information:</h3>";
echo "<h4>Company Name<br>Company address<br>etc.";
echo "</h4><br>";
// print customer into
echo "<h3>Ship to:</h3>";
echo "<h4>".$custName."<br>"; //edit these
echo $custEmail."<br>";
echo $custAddress."<br>";
echo "</h4><br>";

// Lets print the table to the screen.
// zero out counter again
$counter = 0;
// we will need a var to keep track of the total price
$totalP = 0;
if ($numR > 0) {
	// print header
	Print "<table border>"; 
	Print "<tr>"; 
	Print "<th>Part number</th><th>Part Description</th><th>Quantity</th><th>Price</th>";
	Print "</tr>";
	while($counter < $numR) { 
		Print "<tr>"; 
		Print "<td>".$data[$counter]['number']."</td> "; 		//print part number
		Print "<td>".$data[$counter]['description']."</td>";	//print part description
		Print "<td>".$data[$counter]['quant']."</td>";			//print quantity of part

		// Store the product of price and quantity in recordW
		$recordP = $data[$counter]['quant'] * $data[$counter]['price'];
		// Add recordW to totalW
		$totalP = $totalP + $recordP;
		
		Print "<td>$".$recordP."</td>";							//print the Price (quant * unit Price)

		Print "</tr>";

		$counter = $counter + 1;
	} 

    //Print subTotal (price before adding shipping)
    Print "<tr><td>Total Weight</td>";                  //label
    Print "<td>".$_POST["shippingWeight"]."</td>";      //total weight
	Print "<td>Sub Total:</td>";				        //label
	Print "<td>$".$totalP."</td>";				        //total price
	Print "</tr>";
    
    // Print the total price at bottom of the table.
	Print "<tr><td>Shipping Bracket:</td>";             //label
	Print "<td>".$from." lb - ".$to." lb</td>";			//weight bracket
    Print "<td>Shipping Price:</td>";                   //label
	Print "<td>$".$priceShipping."</td>";				//total shipping price
	Print "</tr>";

    //Add priceShipping to totalP.
    $totalP = $totalP + $priceShipping;
	
	// Print the total price at bottom of the table.
	Print "<tr><td></td><td></td>";
	Print "<td>Total Price:</td>";				//label
	Print "<td>$".$totalP."</td>";				//total price
	Print "</tr>";

	Print "</table>"; 
} else {
	Print "0 records found";
}


?>




</body>
</html>