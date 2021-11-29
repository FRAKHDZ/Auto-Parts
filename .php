<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

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
