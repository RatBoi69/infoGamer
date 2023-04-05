<html>
<body>
    <?php
    $conn = new mysqli("sql9.freesqldatabase.com", "sql9610600", "ZE1RGDLzSD");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $cookie_name = "ArcadeLegacyUID";
    if(!isset($_COOKIE[$cookie_name])) {
        header('Location: login.html');
        $conn->close();
        exit;
    } else {

        $_COOKIE[$cookie_name];
    }
    ?>  
</body>
</html>
