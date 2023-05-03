<!-- A PHP file to check what rating a user has given a game and update the database accordingly
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
    // retrieve cookie
    $cookie_name = "ArcadeLegacyUID";
    if(!isset($_COOKIE[$cookie_name])) {
        header('Location: login.php');
        $conn->close();
    }
    $identify = $_COOKIE[$cookie_name];

    // get target game ID
    $gid = $_POST['hiddenVal'];

    // get rid of users previous rating of this game
    $delRate = "DELETE FROM ratings WHERE User_ID=$identify and Game_ID=$gid";
    $conn->query($delRate);

    //determine their rating
    $rating = $_POST['rate'];

    //putting the necessary data into the ratings table
    $submitRating = "INSERT INTO ratings (User_ID, Game_ID, rating) VALUES ($identify, $gid, $rating)";
    $conn->query($submitRating);

    // getting all user ratings and calculating the average of them
    $getAllRates = "SELECT * from ratings WHERE Game_ID=$gid";
    $x = 0;
    $result = $conn->query($getAllRates);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $x += $row['rating'];
        }
        $x = $x / $result->num_rows;
    } 
  
    // insert found average into game data table
    $updateRating = "UPDATE games set Game_Rating=$x where Game_ID=$gid";
    $conn->query($updateRating);

    header('Location: indexlogin.php');
?>