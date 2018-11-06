<?php
    $servername = "localhost";
    $username = "root";
    $password = "19971228";

    try
    {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        //set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE camagru";
        $conn->exec($sql);
        echo "SUCCESS<br>";
    }
    catch (PDOException $e)
    {
        echo $sql . "\n" . $e->getMessage();
    }
    $conn = NULL;
?>