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

    $use = $_POST["uname"];
    $pass = $_POST["psw"];
    $sql = "SELECT * from usersList WHERE Username='$use' AND Password='$pass'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        $cookie_name = "ArcadeLegacyUID";
        $cookie_value = $row["User_ID"];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");  
        
        // the user logged in successfully
        header('Location: indexlogin.php');
        $conn->close();
        
    } else {
        header('Location: signup.html');
        $conn->close();
        
    }
?>
