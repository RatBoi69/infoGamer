<!-- A PHP file that makes cookies for users logging in and checks if they exist
     Copyright: 2023
-->

<?php
    // displaying any errors
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

    // getting user entered data
    $use = $_POST["uname"];
    $pass = $_POST["psw"];
    // finding the user if they exist
    $sql = "SELECT * from usersList WHERE Username='$use' AND Password='$pass'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        // making a cookie with UID for the user
        $cookie_name = "ArcadeLegacyUID";
        $cookie_value = $row["User_ID"];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");  
        
        // the user logged in successfully
        header('Location: indexlogin.php');
        $conn->close();
        
    } else {
        // the user did not login successfully
        header('Location: signup.html');
        $conn->close();
        
    }
?>
