<?php
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    $servername = "sql9.freesqldatabase.com";
    $username = "sql9610600";
    $password = "ZE1RGDLzSD";
    $dbname = "sql9610600";
    
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