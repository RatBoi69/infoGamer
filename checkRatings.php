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

    $delRate = "DELETE FROM ratings WHERE User_ID=$identify and Game_ID=$gid";
    $conn->query($delRate);

//determine their rating
if(!empty($_POST['rate'])){
    $rating = $_POST['rate'];
    foreach($rating as $rate){
        echo $rating;
        //$sql = "INSERT INTO favorites (User_ID, Game_ID) VALUES ($identify, $check_list)";
        //$conn->query($sql);
    }
}


    $sql = "INSERT INTO ratings (User_ID, Game_ID, rating) VALUES ($identify, $gid, 0)";

    $sql = "SELECT * from ratings WHERE Game_ID=$gid";

       // if ($result->num_rows == 1) {
       //     $row = $result->fetch_assoc(); 
       // }










    //header('Location: indexLogin.php');
?>