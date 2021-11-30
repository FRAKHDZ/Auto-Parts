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
$url = 'http://blitz.cs.niu.edu/CreditCard/';
$data = array(
	'vendor' => 'VE001-99',
	'trans' => '907-' . rand(123456,987654) . '321-997',
	'cc' => $_GET["CardNum"],
	'name' => $_GET["name"], 
	'exp' => $_GET["exp"], 
	'amount' => $_GET["total"]);

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
else {
	$i = 0;
	while ($result[$i] . $result[$i+1] != "au" ) {
		++$i;
	}
	

	$result = mb_strcut($result, $i+16, 5);
	
	echo "Order placed<br>";
	echo $result;
	echo "<br>" . $context;
}
?>
</h3>
</body>
</html>
<?php
$url = 'http://blitz.cs.niu.edu/CreditCard/';
$data = array(
	'vendor' => 'VE001-99',
	'trans' => '907-987654321-990',
	'cc' => $_GET["CardNum"],
	'name' => $_GET["name"], 
	'exp' => $_GET["exp"], 
	'amount' => '654.32');

$options = array(
    'http' => array(
        'header' => array('Content-type: application/json', 'Accept: application/json'),
        'method' => 'POST',
        'content'=> json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo($result);
?>

</body>
</html>
