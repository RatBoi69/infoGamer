<?php
    // These lines turn on error reporting to help with debugging.
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    
    // These lines define the database connection parameters.
    $servername = "sql.freedb.tech";
    $username = "freedb_cse201";
    $password = "?NHU8n?7FWyYUPK";
    $dbname = "freedb_cse201";

    // This code creates a new database connection using the defined parameters.
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // This code checks if the database connection was successful.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // This code checks if a specific cookie is set. If not, it redirects the user to the login page and closes the database connection.
    $cookie_name = "ArcadeLegacyUID";
    if(!isset($_COOKIE[$cookie_name])) {
        header('Location: login.php');
        $conn->close();
    }
    
    // This code retrieves the user ID from the cookie.
    $identify = $_COOKIE[$cookie_name];
        
    // This code deletes all the user's favorites from the database.
    $sql = "DELETE FROM favorites WHERE User_ID=$identify";
    $conn->query($sql);
    
    // This code retrieves the list of games the user wants to add to their favorites, and inserts them into the database.
    if(!empty($_POST['check_list'])){
        $game = $_POST['check_list'];
        foreach($game as $check_list){
            $sql = "INSERT INTO favorites (User_ID, Game_ID) VALUES ($identify, $check_list)";
            $conn->query($sql);
        }
    }
    
    // This code redirects the user to the favorites page.
    header('Location: favorites.php');
?>
