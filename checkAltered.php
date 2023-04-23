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

    $cookie_name = "ArcadeLegacyUID";
    if(!isset($_COOKIE[$cookie_name])) {
        header('Location: login.php');
        $conn->close();
    }
    $identify = $_COOKIE[$cookie_name];
        
    $sql = "DELETE FROM favorites WHERE User_ID=$identify";
        $conn->query($sql);
        if(!empty($_POST['check_list'])){
            $game = $_POST['check_list'];
            foreach($game as $check_list){
                $sql = "INSERT INTO favorites (User_ID, Game_ID) VALUES ($identify, $check_list)";
                $conn->query($sql);
            }
        }
    header('Location: indexlogin.php');
?>