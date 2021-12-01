<?php

//This function returns a 2-D array named 
//cartData[index][field name] = (partNum, quant, price, weight, picUrl, description)
function getCartData()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "auto-parts";



    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // here we are getting partNum and quant from the cart table
    $sql = "SELECT * FROM cart WHERE quant != 0";
    $cartQueryReturn = $conn->query($sql); // store it in cartQueryReturn
    $counter = 0;					//zero out counter
    if ($cartQueryReturn->num_rows > 0) {
        //set a var named numR as the number of rows in cartQueryReturn
        $numR = $cartQueryReturn->num_rows;
        // output data of each row into a array named cartDataArray til there is no data left in cartQueryReturn
        while($row = $cartQueryReturn->fetch_assoc()) {
            //load data into cartDataArray[counter][''] from row
            $cartDataArray[$counter]['partNum'] = $row['partNum'];
            $cartDataArray[$counter]['quant'] = $row['quant'];

            $counter = $counter + 1;
        }
    }
    $conn->close(); //close connection with local DB
    // Now we have a 2D array named cartDataArray = (partNum, quant)


    // info for legacy database
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
    //echo "Connected successfully to: " . $servername;

    /* change character set to utf8 */
    $conn->set_charset("utf8");

    $counter = 0;		//zero out counter
    //loop for each record in custData. ie numR
    while ($counter < $numR)
    {
        $sql = "SELECT description, price, weight, pictureURL FROM parts WHERE number=".$cartDataArray[$counter]['partNum']." LIMIT 1;";
        $cartQueryReturn = $conn->query($sql); // store it in cartQueryReturn
        $row = $cartQueryReturn->fetch_assoc();
        //assign the data to custData[counter] array
        $cartDataArray[$counter]['description'] = $row['description'];
        $cartDataArray[$counter]['price'] = $row['price'];
        $cartDataArray[$counter]['weight'] = $row['weight'];
        $cartDataArray[$counter]['pictureURL'] = $row['pictureURL'];
        
        
        $counter = $counter + 1;
    }

    $conn->close(); //close connection with legacy DB
    // Now we have a 2D array named cartDataArray = (partNum, quant, price, weight, picUrl, description)


    return $cartDataArray;
}

//unit test
//$ouput = getCartData();
//echo $output;


function clearCart() {
    //add orderData to customerorder table
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auto-parts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

/* change character set to utf8 */
$conn->set_charset("utf8");

//delete cart table
$sql = "DROP TABLE cart;";
$result = $conn->query($sql);  //run query
//re-create cart table
$sql = "CREATE TABLE `auto-parts`.`cart` ( `partNum` INT NOT NULL , `quant` INT NOT NULL , PRIMARY KEY (`partNum`)) ENGINE = InnoDB;";
$result = $conn->query($sql);  //run query



$conn->close(); 
}





?>