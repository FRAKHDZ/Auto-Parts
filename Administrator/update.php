<?php
    $pdo = require_once "database.php";

    $Weight = $_GET['Weight'];

    $statement = $pdo->prepare('SELECT * FROM shippingbrackets WHERE Weight = :Weight');
    $statement->bindValue(':Weight', $Weight);
    $statement->execute();
    $bracket = $statement->fetch(PDO::FETCH_ASSOC);

    $Price = $bracket['Price'];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $Price = $_POST['Price'];

        $statement = $pdo->prepare("UPDATE shippingbrackets SET Price = :Price WHERE Weight = :Weight");
        $statement->bindValue(':Price', $Price);
        $statement->bindValue(':Weight',$Weight);
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
    <title>Update Bracket</title>
  </head>
  <body>
  <a href="WeightB.php">Weight Bracket</a>
      <h4>Update Bracket<b><?php echo ' '.$Weight.'lb'?></b> </h4>
    <form action="" method="POST">
        <div class="mb-3">
            <label>LB</label>
            <input type="integer" name="Weight" class="form-control" value="<?php echo $Weight ?>">
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="Price" step=".01" class="form-control" value="<?php echo $Price ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>