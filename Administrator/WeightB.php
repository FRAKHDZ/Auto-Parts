<?php
    $pdo = require_once "database.php";

    $statement = $pdo->prepare('SELECT * FROM shippingbrackets ');
    $statement->execute();
    $brackets = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
    <title>Weight Bracket</title>
</head>
<body>
    <a href="Admin.php">Administrator Page</a>
    <a href="Order.php">Order Page</a>
    <h1>Weight Bracket</h1>

    <table class="table table-success table-striped">
        <thead>
            <tr>
            <th scope="col">Weigt(lb)</th>
            <th scope="col">Price($)</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($brackets as $bracket): ?>
                <tr>
                    <td><?php echo $bracket['Weight']?></td>
                    <td><?php echo $bracket['Price']?></td>
                    <td>

                            <a href="update.php?Weight=<?php echo $bracket['Weight']?>" type="button" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="delete.php" style="display: inline-block">
                                <input type="hidden" name="Weight" value="<?php echo $bracket['Weight'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="WeightControl.php" class="btn btn-success">Create Weight Bracket</a>
    <br>
</body>
</html>