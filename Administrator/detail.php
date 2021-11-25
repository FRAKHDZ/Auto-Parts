<?php
$pdo = require_once "database.php";

$transNum = $_GET['transNum'];

 $statement = $pdo->prepare('SELECT * FROM customerorder WHERE transNum = :transNum');
 $statement->bindValue(':transNum', $transNum);
 $statement->execute();
 $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
 foreach($orders as $order)
 {
     $status = $order['orderStatus'];
     $email = $order['email'];
     $address = $order['shippingAddress'];
     $date = $order['Order_Date'];
     $name = $order['name'];
 }

$statement1 = $pdo->prepare('SELECT * FROM partsordered WHERE transNum = :transNum');
$statement1->bindValue(':transNum', $transNum);
$statement1->execute();
$parts = $statement1->fetchAll(PDO::FETCH_ASSOC);
foreach($parts as $part)
{
    $partNum = $part['number'];
    $quant = $part['quant'];
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
    <title>Order Detail</title>
  </head>
  <body>
    <h2>Order transaction #<?php echo $transNum?>, Status: <?php echo $status?></h2>
    <br>
    <h4>Customer Information:</h4>
    <p>Name: <?php echo $name?></p>
    <p>Order date: <?php echo $date?></p>
    <p>Address: <?php echo $address?></p>
    <p>email: <?php echo $email?></p>
    <h4>Parts order:</h4>
    <p><?php echo $quant?></p>
    <p></p>


  </body>
  <a href='Order.php'>Order Page</a>
</html>