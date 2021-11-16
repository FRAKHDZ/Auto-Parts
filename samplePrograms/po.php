<html>
<head>
<title>Purchase Order Processing Test Page</title>
</head>
<body>
<h3>Purchase Order Processing Test Page via PHP</h3>

<?php
$url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
$data = array('order' => rand(123456,987654), 'name' => 'IBM Corporation', 'amount' => '7654.32');
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
