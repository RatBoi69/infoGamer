<?php
    $conn = new mysqli("sql9.freesqldatabase.com", "sql9610600", "ZE1RGDLzSD");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["uname"];
    $password = $_POST["psw"];

    $sql = "SELECT * from users WHERE username=$username AND password=$password";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // the user logged in successfully
        $cookie_name = "ArcadeLegacyUID";
        $cookie_value = $row["id"];
        setcookie($cookie_name, $cookie_value);
        header('Location: account.php');
        $conn->close();
        exit;
    } else {
        header('Location: login.html');
        $conn->close();
        exit;
    }
?>