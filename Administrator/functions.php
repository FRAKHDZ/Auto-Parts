<?php

    function getOrderTotal($id) {
        
        // Set connection info and connect to auto-parts database
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
        //echo "Connected successfully to: " . $servername;
        
        /* change character set to utf8 */
        $conn->set_charset("utf8");


        //Get part numbers from partsOrdered table in auto-parts database
        // zero out counter
        $counter = 0;
        // Collects data from "parts" table 
        $sql = "SELECT number, quant FROM partsordered WHERE transNum=".$id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // assign the number of rows to numR
            $numR = $result->num_rows;
            // assign number and quant to data array
            while($counter < $numR) { 
                $row = $result->fetch_assoc();
                $data[$counter]['number'] = $row['number']; 
                $data[$counter]['quant'] = $row['quant'];  
                // incrment counter val
                $counter = $counter + 1;
            } 

        } else {
            Print "0 records found";
        }
        //now we have a array $data[index] = (number, quant)
        $conn->close(); // disconnect from localhost auto-parts database



        //Connect to legecy database
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
            // make a sql query that gets the description and weight of each part in data array
            //echo $data[$counter]['number'];
            $sql = "SELECT price, weight FROM parts WHERE number=".$data[$counter]['number']." LIMIT 1";
            //$result = $conn->prepare($sql);
            //$result->execute;
            $result = $conn->query($sql) or die($conn->error);

            //echo $result; //for testing
            // assign description and weight to data array
            $row = $result->fetch_assoc();
            $data[$counter]['price'] = $row['price'];
            $data[$counter]['weight'] = $row['weight'];

            // incrment counter val
            $counter = $counter + 1;
        }
        $conn->close(); //disconnect from legacy database
        //Now the data array has price and weight too
        
        

        //Find shipping weight (total weight of order)
        $shippingWeight = 0; //zero out shippingWeight
        $counter = 0;        //zero out counter
        while ($counter < $numR) {
            $shippingWeight = $shippingWeight + ($data[$counter]['quant'] * $data[$counter]['weight']);
            $counter = $counter + 1;
        }
        
        
        

        // Set connection info and connect to auto-parts database
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
        //echo "Connected successfully to: " . $servername;
        
        /* change character set to utf8 */
        $conn->set_charset("utf8");

        // Collects data from "parts" table 
        $sql = "SELECT Weight, Price FROM shippingbrackets ORDER BY Weight ASC";
        $result = $conn->query($sql);
        // assign weight bracket values to the from and to values.
        // also set priceShipping
        if ($result->num_rows > 0) {
            // To get the bottom of the weight bracket:
            // Loop through result while theres still data in result
            // AND while shipping weight (passed from POST) is greater than than the weight of current bracket.
            while($row = $result->fetch_assoc() and ($shippingWeight > $row['Weight'])) { 
                $shipping = 0;
            }

            // This row will also hold how much will be charged for shipping
            $shipping = $row['Price'];     // Assign this price to the shipping value

        } else {
            Print "0 records found";
        }
        $conn->close(); // disconnect from localhost auto-parts database



        

        $orderTotal = 0;
        $counter = 0;
        while($counter < $numR)
        {
            //multiply price by quantity and assign it to totals array.
            $total = $data[$counter]['price'] * $data[$counter]['quant'];
            $orderTotal = $orderTotal + $total;
            $counter = $counter + 1;
        }

        // also need to add shipping
        $orderTotal = $orderTotal + $shipping;
        

        return $orderTotal;
    }

    function getOrderWeight($id) {
        
        // Set connection info and connect to auto-parts database
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
        //echo "Connected successfully to: " . $servername;
        
        /* change character set to utf8 */
        $conn->set_charset("utf8");


        //Get part numbers from partsOrdered table in auto-parts database
        // zero out counter
        $counter = 0;
        // Collects data from "parts" table 
        $sql = "SELECT number, quant FROM partsordered WHERE transNum=".$id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // assign the number of rows to numR
            $numR = $result->num_rows;
            // assign number and quant to data array
            while($counter < $numR) { 
                $row = $result->fetch_assoc();
                $data[$counter]['number'] = $row['number']; 
                $data[$counter]['quant'] = $row['quant'];  
                // incrment counter val
                $counter = $counter + 1;
            } 

        } else {
            Print "0 records found";
        }
        //now we have a array $data[index] = (number, quant)
        $conn->close(); // disconnect from localhost auto-parts database



        //Connect to legecy database
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
            // make a sql query that gets the description and weight of each part in data array
            //echo $data[$counter]['number'];
            $sql = "SELECT price, weight FROM parts WHERE number=".$data[$counter]['number']." LIMIT 1";
            //$result = $conn->prepare($sql);
            //$result->execute;
            $result = $conn->query($sql) or die($conn->error);

            //echo $result; //for testing
            // assign description and weight to data array
            $row = $result->fetch_assoc();
            $data[$counter]['price'] = $row['price'];
            $data[$counter]['weight'] = $row['weight'];

            // incrment counter val
            $counter = $counter + 1;
        }
        $conn->close(); //disconnect from legacy database
        //Now the data array has price and weight too
        
        

        //Find shipping weight (total weight of order)
        $shippingWeight = 0; //zero out shippingWeight
        $counter = 0;        //zero out counter
        while ($counter < $numR) {
            $shippingWeight = $shippingWeight + ($data[$counter]['quant'] * $data[$counter]['weight']);
            $counter = $counter + 1;
        }
    
        

        return $shippingWeight;
    }

    //for testing
    //echo getOrderTotal(807987654321991);

?>
