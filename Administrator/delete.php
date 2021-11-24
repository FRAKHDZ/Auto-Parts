<?php

$pdo = require_once "database.php";

$Weight = $_POST['Weight'];

$statement = $pdo->prepare("DELETE FROM shippingbrackets WHERE Weight = :Weight");
$statement->bindValue(':Weight', $Weight);
$statement->execute();

header('Location: WeightB.php');
?>