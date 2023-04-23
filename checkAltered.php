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
  

    if(!empty($_POST['check_list'])){
    // Loop to store and display values of individual checked checkbox.
        $game = $_POST['check_list'];
    // clear favorites table where users = cookie
    $sql = "DELETE FROM favorites WHERE User_ID=$identify";

    foreach($game as $check_list){
        // pull from favorites where users = cookie and game id = this
        // if null add it
        
        $sql .= "INSERT INTO favorites (User_ID, Game_ID) VALUES ($identify, $check_list)";
    }
    }
    if ($mysqli -> multi_query($sql)) {
        do {
          // Store first result set
          if ($result = $mysqli -> store_result()) {
            
           $result -> free_result();
          }
          // if there are more result-sets, the print a divider
         
           //Prepare next result set
        } while ($mysqli -> next_result());
      }
      
      $mysqli -> close();


    header('Location: indexlogin.php');
?>