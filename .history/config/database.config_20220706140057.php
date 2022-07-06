<!-- config file for database -->
<?php

    function connect(){

        $host = "localhost";
        $username = "root";
        $password = "root";
        $dbName = "thelibrary_db";
    
    
        // Create connection object
        $conn = new mysqli($host, $username, $password, $dbName);
    
        // Check connection
        if ($conn->connect_error) {
            //close connection in case of error
            die("Connection failed: db " . $conn->connect_error); 
        } 
        else {
            return $conn;
        }  

    }

?>