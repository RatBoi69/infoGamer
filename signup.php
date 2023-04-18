<?php
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    $servername = "sql.freedb.tech";
        $username = "freedb_cse201";
        $password = "?NHU8n?7FWyYUPK";
        $dbname = "freedb_cse201";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $em = $_POST["email"];
    $use = $_POST["uname"];
    $pass = $_POST["psw"];

    $sql = "INSERT INTO usersList (Username, Password, Email)
    VALUES ('$use', '$pass', '$em')";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: login.html');
        $conn->close();
    } else {
        header('Location: signup.html');
        $conn->close();
    }
?>