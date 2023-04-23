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


 //to run PHP script on submit
    if(!empty($_POST['check_list'])){
    // Loop to store and display values of individual checked checkbox.
    foreach($_POST['check_list'] as $selected){
    echo $selected."</br>";
    }
    }
  



//if ($_POST["1"] == 'Yes') {
    //$sql = "INSERT INTO favorites (Favorite_ID, User_ID, Game_ID)
    //VALUES (NULL, $identify, 1)";
//}

?>