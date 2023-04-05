<?php
    $conn = new mysqli("sql9.freesqldatabase.com", "sql9610600", "ZE1RGDLzSD");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $username = $_POST["uname"];
    $password = $_POST["psw"];

    $sql = "INSERT into users (email, username, password) VALUES($email, $username, $password)";

    if ($conn->query($sql) === TRUE) {
        // the user signed up successfully
        header('Location: login.html');
        $conn->close();
        exit;
    } else {
        header('Location: signup.html');
        $conn->close();
        exit;
    }
?>