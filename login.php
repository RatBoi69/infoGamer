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

    $use = $_POST["uname"];
    $pass = $_POST["psw"];
    $sql = "SELECT * from users WHERE username='$use' AND password='$pass'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        
        // the user logged in successfully
        $cookie_name = "ArcadeLegacyUID";
        $cookie_value = $row["id"];
        setcookie($cookie_name, $cookie_value);
        header('Location: index_logged_in.html');
        $conn->close();
        
    } else {
        header('Location: index.html');
        $conn->close();
        
    }
?>
