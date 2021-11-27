<?php
getPrice(int $transNum)
{




        //Get part numbers from partsOrdered table in auto-parts database
        // zero out counter
        $counter = 0;
        // Collects data from "parts" table 
        $sql = "SELECT number, quant FROM partsordered WHERE authNum=".$transNum;
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
        //now we have a array $data[index] = (number, quantity)




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
            $sql = "SELECT price FROM parts WHERE number=".$data[$counter]['number']." LIMIT 1";
            //$result = $conn->prepare($sql);
            //$result->execute;
            $result = $conn->query($sql) or die($conn->error);

            //echo $result; //for testing
            // assign description and weight to data array
            $row = $result->fetch_assoc();
            $data[$counter]['price'] = $row[$counter];   

            // incrment counter val
            $counter = $counter + 1;
        }
        $conn->close();

        $orderTotal = 0;
        $counter = 0;
        while($counter < $numR)
        {
            //multiply price by quantity and assign it to totals array.
            $total = $data[$counter]['price'] * $data[$counter]['quant'];
            $orderTotal = $orderTotal + $total
        }
        

        return $orderTotal;
    }
?>