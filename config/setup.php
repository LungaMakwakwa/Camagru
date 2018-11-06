<?php
   $servername = "localhost";
   $username = "root";
   $password = "19971228";
   $dbname = "camagru";

   //connection
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   //check connection
   if (!$conn)
   {
       die("Connection failed" . mysqli_connect_error());
   }

   //sql to create table
   $sql = "CREATE TABLE `users` (
       `users_id` int(11) AUTO_INCREMENT PRIMARY KEY,
       `username` varchar(20),
       `passwrd` varchar(64),
       `salt` varchar(32),
       `name` varchar(50),
       `joined` datetime(),
       `groups` int(11)
   )";

    $sql = "CREATE TABLE `groups` (
    `ids` int(11) AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(20),
    `permissions` text()
    )";

    $sql = "CREATE TABLE `user_session` (
    `ids` int(11) AUTO_INCREMENT PRIMARY KEY,
    `users_id` int(11),
    `hash` varchar(50)
    )";

?>