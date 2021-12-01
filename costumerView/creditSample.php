<html>
<head>
<title>Credit Card Authorization Test Page</title>
</head>
<body>
<h3>Credit Card Authorization Test Page via PHP</h3>

<?php
$url = 'http://blitz.cs.niu.edu/CreditCard/';
$data = array(
    'vendor' => 'VE001-99',
    'trans' => '907-987664321-296',
    'cc' => '6011 1234 4321 1234',
    'name' => 'John Doe', 
    'exp' => '12/2024', 
    'amount' => '654.32');

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo($result);
?>

</body>
</html>
