<?php
    include 'functions.php';    //for getOrderTotal($id) function

    $pdo = require_once "database.php";

    $transNum = $_GET['transNum'] ?? '';
    $price_min = $_GET['price_min'] ?? '';
    $price_max = $_GET['price_max'] ?? '';
    $date_min = $_GET['date_min'] ?? '';
    $date_max = $_GET['date_max'] ?? '';

    //initialize flag to 0
    $flag = 0;

    if($transNum && !$price_min && !$price_max && !$date_min && !$date_max)
    {
        //$statement = $pdo->prepare('SELECT transNum, Order_Date, Price FROM customerorder WHERE transNum = :transNum ORDER BY Order_Date DESC');
        $statement = $pdo->prepare('SELECT transNum, Order_Date FROM customerorder WHERE transNum = :transNum ORDER BY Order_Date DESC');
        $statement->bindValue(':transNum', $transNum);
    } 
    else if(!$transNum && $price_min && $price_max && !$date_min && !$date_max)
    {
        //$statement = $pdo->prepare('SELECT transNum, Order_Date, Price FROM customerorder WHERE Price BETWEEN :price_min AND :price_max ORDER BY Order_Date DESC');
        $statement = $pdo->prepare('SELECT transNum, Order_Date FROM customerorder ORDER BY Order_Date DESC');
        $flag = 1;
        //$statement->bindValue(':price_min', $price_min);
        //$statement->bindValue(':price_max', $price_max);
    }
    else if(!$transNum && !$price_min && !$price_max && $date_min && $date_max)
    {
        //$statement = $pdo->prepare('SELECT transNum, Order_Date, Price FROM customerorder WHERE Order_date BETWEEN :date_min AND :date_max ORDER BY Order_Date DESC');
        $statement = $pdo->prepare('SELECT transNum, Order_Date FROM customerorder WHERE Order_date BETWEEN :date_min AND :date_max ORDER BY Order_Date DESC');
        $statement->bindValue(':date_min', $date_min);
        $statement->bindValue(':date_max', $date_max);
    }
    else if(!$transNum && $price_min && $price_max && $date_min && $date_max)
    {
        //$statement = $pdo->prepare('SELECT transNum, Order_Date, Price FROM customerorder WHERE Order_date BETWEEN :date_min AND :date_max AND Price BETWEEN :price_min AND :price_max ORDER BY Order_Date DESC');
        $statement = $pdo->prepare('SELECT transNum, Order_Date FROM customerorder WHERE Order_date BETWEEN :date_min AND :date_max ORDER BY Order_Date DESC');
        $flag = 1;
        $statement->bindValue(':date_min', $date_min);
        $statement->bindValue(':date_max', $date_max);
        //$statement->bindValue(':price_min', $price_min);
        //$statement->bindValue(':price_max', $price_max);
    }
    else
    {
        //Get this one to work then do the rest
        $statement = $pdo->prepare('SELECT transNum, Order_Date FROM customerorder ORDER BY Order_Date DESC');
    }

    $statement->execute();
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;        //to close out connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
    <title>Order list</title>
</head>
<body>
    <a href="Admin.php">Administrator Page</a>
    <a href="WeightB.php">Weight Bracket Page</a>
    <br><br>
    <h4>Filter Option</h4>
    <form>
        <div class = "input-group" style="Width: 500px;"> 
            <span style="Width: 120px;" class="input-group-text">Transaction#</span>
            <input type="number" class="form-control" placeholder="Enter an transNum#" name="transNum">
        </div>
        <div class = "input-group" style="Width: 500px;">
            <span style="Width: 120px;" class="input-group-text">Price Range</span>
            <input type="number" class="form-control" name="price_min">
            <input type="number" class="form-control" name="price_max">
        </div>
        <div class = "input-group" style="Width: 500px;">
            <span style="Width: 120px;" class="input-group-text">Date Range</span>
            <input type="date" class="form-control" name="date_min">
            <input type="date" class="form-control" name="date_max">
        </div>
            <button class="btn btn-outline-primary" type="submit">Search</button>
            <a href='Order.php' type="button" class="btn btn-outline-secondary">Refresh</a>
    </form>
    <br><br>
    <h1>Order List:</h1>
    <table class="table table-success table-striped">
        <thead>
            <tr>
            <th scope="col">Transaction #</th>
            <th scope="col">Order Date</th>
            <th scope="col">Order Price</th>
            <th scope="col">Order Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order):
                $num = getOrderTotal($order['transNum']);
                if ((($price_min <= $num) and ($num <= $price_max)) or ($flag == 0) )
                {
                    echo '<tr>';
                        echo '<td>'.$order['transNum'].'</td>';
                        echo '<td>'.$order['Order_Date'].'</td>';
                        echo '<td>';
                        //print price
                        echo $num;
                        echo '</td>';
                        echo '<td>';
                        echo '<form action="/auto-parts/Administrator/detail.php" method="post">';
                        echo "<input type='hidden' name='transNum' id='transNum' value='".$order['transNum']."'>";
                        echo '<input type="submit" class="btn btn-sm btn-outline-primary" value="Check">';
                        echo '</form>';
                        echo '</td>';
                    echo '</tr>';
                }
            endforeach; ?>
        </tbody>
    </table>
</body>
</html>