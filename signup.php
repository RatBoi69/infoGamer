<!-- A PHP file that adds signed up users to the database
     Copyright: 2023
-->

<?php
    // displays any errors
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    // database information
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

    // getting user entered values
    $em = $_POST["email"];
    $use = $_POST["uname"];
    $pass = $_POST["psw"];

    // putting the user in the database
    $sql = "INSERT INTO usersList (Username, Password, Email)
    VALUES ('$use', '$pass', '$em')";
    
    // redirecting them based on if the insert passed or failed
    if ($conn->query($sql) === TRUE) {
        header('Location: login.html');
        $conn->close();
    } else {
        header('Location: signup.html');
        $conn->close();
    }
?>