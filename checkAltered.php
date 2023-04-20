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
} else {
  $identify = $_COOKIE[$cookie_name];
}

$game = $_POST[$row["Game_ID"]];

$sql = "INSERT INTO favorites (Favorite_ID, User_ID, Game_ID)
    VALUES (NULL, $identify, $game)";
?>