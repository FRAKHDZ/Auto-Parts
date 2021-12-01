<?php
include 'functions.php';    //for getOrderWeight($id) function
$pdo = require_once "database.php";

$transNum = $_POST['transNum'];

 $statement = $pdo->prepare('SELECT * FROM customerorder WHERE transNum = :transNum');
 $statement->bindValue(':transNum', $transNum);
 $statement->execute();
 $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
 foreach($orders as $order)
 {
     //$status = $order['orderStatus'];
     $dateShipped = $order['dateShipped'];
     $email = $order['email'];
     $address = $order['shippingAddress'];
     $date = $order['Order_Date'];
     $name = $order['name'];
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
    <h2>Order transaction #<?php echo $transNum?></h2>
    <br>
    <h4>Customer Information:</h4>
    <p>Name: <?php echo $name?></p>
    <p>Order date: <?php echo $date?></p>
    <p>Date Shipped: <?php echo $dateShipped?></p>
    <p>Address: <?php echo $address?></p>
    <p>email: <?php echo $email?></p>
    <?php  
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "auto-parts";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname) or die("unable to connect");

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      /* change character set to utf8 */
      $conn->set_charset("utf8");

      // zero out counter
      $counter = 0;
      // Collects data from "parts" table 
      $sql = "SELECT number, quant FROM partsordered WHERE transNum=".$_POST["transNum"];
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // assign the number of rows to numR
        $numR = $result->num_rows;
        // assign number and quant to data array
        while($row = $result->fetch_assoc()) {  
          $data[$counter]['number'] = $row['number']; 
          $data[$counter]['quant'] = $row['quant'];  
          // incrment counter val
          $counter = $counter + 1;
        } 

      } else {
        Print "0 records found";
      }



      //put query for customer info here
      $sql = "SELECT Order_Date, name, email, shippingAddress FROM customerOrder WHERE transNum=".$_POST['transNum']." LIMIT 1";  //Maybe add pictures
      $result = $conn->query($sql) or die($conn->error);

      // assign customer info to cust variables
      $row = $result->fetch_assoc();      //load row
      $custDate = $row['Order_Date'];
      $custName = $row['name'];
      $custEmail = $row['email'];
      $custAddress = $row['shippingAddress'];



      //put weight class query here
      $priceShipping = 1.00;
      $from = 0;    
      $to = 0;

      // Collects data from "parts" table 
      $sql = "SELECT Weight, Price FROM shippingbrackets ORDER BY Weight ASC";
      $result = $conn->query($sql);
      // assign weight bracket values to the from and to values.
      // also set priceShipping
      if ($result->num_rows > 0) {
          // To get the bottom of the weight bracket:
          // Loop through result while theres still data in result
          // AND while shipping weight (passed from POST) is greater than than the weight of current bracket.
        while($row = $result->fetch_assoc() and (getOrderWeight($_POST['transNum']) > $row['Weight'])) { 
              $from = $row['Weight'];             // Set the bottom of weight bracket (from) to weight of current row
        }

          // The current $row['weight'] should hold the top of weight bracket.
          $to = $row['Weight'];               // Assign this value to the top of weight bracket (to)
          // This row will also hold how much will be charged for shipping
          $priceShipping = $row['Price'];     // Assign this price to the priceShipping value

      } else {
        Print "0 records found";
      }
      $conn->close();  // Disconnect from auto-parts database on localhost


    $servername = "blitz.cs.niu.edu";
    $username = "student";
    $password = "student";
    $dbname = "csci467";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname) or die("unable to connect");
    
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    /* change character set to utf8 */
    $conn->set_charset("utf8");
    
    // zero out counter
    $counter = 0;
    while ($counter < $numR) {
      // make a sql query that gets the description and price of each part in data array
      $sql = "SELECT description, price FROM parts WHERE number=".$data[$counter]['number']." LIMIT 1";  //Maybe add pictures
      //$result = $conn->prepare($sql);
      //$result->execute;
      $result = $conn->query($sql) or die($conn->error);
    
      //echo $result; //for testing
      // assign description and price to data array
      $row = $result->fetch_assoc();
      $data[$counter]['description'] = $row['description']; 
      $data[$counter]['price'] = $row['price'];   
    
      // incrment counter val
      $counter = $counter + 1;
    }
    $conn->close(); // Disconnect from blitz.cs.niu.edu
    
    
    // Lets print the table to the screen.
    // zero out counter again
    $counter = 0;
    // we will need a var to keep track of the total price
    $totalP = 0;
    if ($numR > 0) {
      // print header
      Print "<table border>"; 
      Print "<tr>"; 
      Print "<th>Part number</th><th>Part Description</th><th>Quantity</th><th>Price</th>";
      Print "</tr>";
      while($counter < $numR) { 
        Print "<tr>"; 
        Print "<td>".$data[$counter]['number']."</td> "; 		//print part number
        Print "<td>".$data[$counter]['description']."</td>";	//print part description
        Print "<td>".$data[$counter]['quant']."</td>";			//print quantity of part
    
        // Store the product of price and quantity in recordW
        $recordP = $data[$counter]['quant'] * $data[$counter]['price'];
        // Add recordW to totalW
        $totalP = $totalP + $recordP;
        
        Print "<td>$".$recordP."</td>";							//print the Price (quant * unit Price)
    
        Print "</tr>";
    
        $counter = $counter + 1;
      } 
    
        //Print subTotal (price before adding shipping)
        Print "<tr><td>Total Weight</td>";                  //label
        Print "<td>".getOrderWeight($_POST['transNum'])."</td>";      //total weight
        Print "<td>Sub Total:</td>";				        //label
        Print "<td>$".$totalP."</td>";				        //total price
        Print "</tr>";
        
        // Print the total price at bottom of the table.
        Print "<tr><td>Shipping Bracket:</td>";             //label
        Print "<td>".$from." lb - ".$to." lb</td>";			//weight bracket
        Print "<td>Shipping Price:</td>";                   //label
        Print "<td>$".$priceShipping."</td>";				//total shipping price
        Print "</tr>";
    
        //Add priceShipping to totalP.
        $totalP = $totalP + $priceShipping;
      
      // Print the total price at bottom of the table.
        Print "<tr><td></td><td></td>";
        Print "<td>Total Price:</td>";				//label
        Print "<td>$".$totalP."</td>";				//total price
        Print "</tr>";
    
      Print "</table>"; 
    } else {
      Print "0 records found";
    }

    ?>


  </body>
  <a href='Order.php'>Order Page</a>
</html>
