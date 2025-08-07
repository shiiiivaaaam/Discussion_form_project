<?php
    $host= 'localhost';
    $username= ''; // write username here 
    $password= ; // passwrod here .
    $dbname= 'discuss';

    $conn = new mysqli($host,$username,$password,$dbname);
    if ($conn->connect_error) {
        die('database connection error'. $conn->connect_error);
    }

?>
