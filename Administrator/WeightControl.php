<?php
    $pdo = require_once "database.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Weight = $_POST['Weight'];
        $Price = $_POST['Price'];

        $statement = $pdo->prepare("INSERT INTO shippingbrackets (Weight, Price) VALUES(:Weight , :Price)");
        $statement->bindValue(':Weight', $Weight);
        $statement->bindValue(':Price', $Price);
        $statement->execute();
        header("Location: WeightB.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
    <title>Create New Bracket</title>
  </head>
  <body>
  <a href="WeightB.php">Weight Bracket</a>
      <h4>Create New Bracket</h4>
    <form action="" method="POST">
        <div class="mb-3">
            <label>LB</label>
            <input type="integer" name="Weight" class="form-control">
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="Price" step=".01" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>