<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Page Title</title>


<link rel="stylesheet" href="style.css">
</head>
<body>

<ul class="topnav">
	<li class="active"><a  href="index.php">All Parts</a></li>
 
	<li class="right"><a href="cart.php">Cart</a></li>
</ul> 
<br></br>
<h1 class="title">
Huskie Auto Parts</h1>

<hr class="titleHR"><h3>
<?php
include 'custFunctions.php';    //for clearCart() function

$url = 'http://blitz.cs.niu.edu/CreditCard/';
$randomNum = rand(123456,987654);
$transNum = 207000000000000 + ($randomNum * 1000000) + 321997;
$data = array(
	'vendor' => 'VE001-99',
	'trans' => '207-' . $randomNum . '321-997',
	'cc' => $_POST["CardNum"],
	'name' => $_POST["cardName"], 
	'exp' => $_POST["exp"], 
	'amount' => $_POST["total"]);

$options = array(
    'http' => array(
	//'header' => "Content type: application/x-www-form-urlencoded\r\n",
	'header' => array('Content-type: application/json', 'Accept: application/json'),
        'method' => 'POST',
	//'content' => http_build_query($data)
	 'content'=> json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
//if ($result[130] . $result[131] . $result[132] . $result[133]  == "erro") {

$word = "error";
if (strpos($result, $word) !== false){
	echo"Order failed";
}
else{
	//load orderData array
	$orderData['transNum'] = $transNum;
	//$orderData['authNum'] = $result['authorization'];
	$orderData['name'] = $_POST['name'];
	$orderData['shippingAddress'] = $_POST['shippingAddress'];
	$orderData['email'] = $_POST['email'];
	$orderData['Order_Date'] = date('y-m-d');

	//add orderData to customerorder table
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

	/* change character set to utf8 */
	$conn->set_charset("utf8");


	$sql = "INSERT INTO customerorder (transNum, name, shippingAddress, email, Order_Date)".
	" VALUES (".$orderData['transNum'].", '".$orderData['name'].
	"', '".$orderData['shippingAddress']."', '".$orderData['email']."', '".$orderData['Order_Date']."') ;";
	$result = $conn->query($sql);  //run query

	//load cart into parts ordered
	$sql = "SELECT * FROM cart;";
	$result = $conn->query($sql);
	$counter = 0;	//zero out counter
	$numR = 0;
	if ($result->num_rows > 0) {
        //set a var named numR as the number of rows in result
        $numR = $result->num_rows;
        // output data of each row into a array named partOrder til there is no data left in result
        while($row = $result->fetch_assoc()) {
            //load data into partOrder[counter][''] from row
            $partOrder[$counter]['partNum'] = $row['partNum'];
            $partOrder[$counter]['quant'] = $row['quant'];

            $counter = $counter + 1;
        }
    }
	//insert into partsordered using transNum
	$counter = 0;
	while ($counter < $numR)
	{
		$sql = "INSERT INTO partsordered (number, transNum, quant) VALUES (".
		" ".$partOrder[$counter]['partNum'].", ".$transNum.", ".$partOrder[$counter]['quant'].");";
		$result = $conn->query($sql);  //run query

		$counter = $counter + 1;
	}
	

	//$result = mb_strcut($result, $i+16, 5);
		
		echo "Order placed<br>";
		echo "Email Sent";
		echo "<br>";


	//kill connection to local db
	$conn->close(); 
	//clear cart
	clearCart();
}





?>
</h3>
</body>
</html>


</body>
</html>
