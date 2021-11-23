<?php

    $user = 'root';
    $pass = '';
    $db = 'auto-parts';

    $db = new mysqli('localhost', $user, $pass, $db) or die("unable to connect");

    $query = "SHOW TABLES";
    $result = $db->query($query);
    echo "<plaintext>";
    var_dump($result->fetch_all());
    exit();







    echo "great work";

?>