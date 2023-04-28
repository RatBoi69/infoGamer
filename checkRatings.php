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
    $gid = $_POST['hiddenVal'];

    echo $gid;

   // $delRate = "DELETE FROM ratings WHERE User_ID=$identify and Game_ID=$gid";
  //  $conn->query($delRate);


  //  $sql = "SELECT * from usersList WHERE User_ID=$identify";
   //     $result = $conn->query($sql);

   //     if ($result->num_rows == 1) {
   //         $row = $result->fetch_assoc(); 
   //     }










    //header('Location: indexLogin.php');
?>