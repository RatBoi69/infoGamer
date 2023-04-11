<html>
<body>
    <?php
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
        $servername = "sql9.freesqldatabase.com";
        $username = "sql9610600";
        $password = "ZE1RGDLzSD";
        $dbname = "sql9610600";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

    $cookie_name = "ArcadeLegacyUID";
    if(!isset($_COOKIE[$cookie_name])) {
        header('Location: login.html');
        $conn->close();
    } else {
        echo "Welcome" . $_COOKIE[$cookie_name];
    }
    ?>  
</body>
</html>
