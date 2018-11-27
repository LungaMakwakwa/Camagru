<?php
    include "database.php";

    try {
        $dbh = new PDO("mysql:host=$DB_DNS", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $dbh->exec("CREATE DATABASE IF NOT EXISTS camagru;")
        or die(print_r($dbh->errorInfo(), true));
        $dbh->exec("CREATE TABLE `camagru`.`users`(
            `user_id` INT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `name` VARCHAR(255) NOT NULL,
            `joined` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `email` VARCHAR(255) NOT NULL,
            `email_code` VARCHAR(255) NOT NULL,
            `activate` INT(64) NOT NULL DEFAULT 0,
            `notification` INT(64) NOT NULL DEFAULT 1,
            PRIMARY KEY(`user_id`)
        )");
        $dbh->exec("CREATE TABLE `camagru`.`gallery`(
            `img_id` INT(11) NOT NULL AUTO_INCREMENT,
            `img_name` VARCHAR(255) NOT NULL,
            `user_id` INT(255) NOT NULL,
            `time_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(`img_id`)  
        )");
        $dbh->exec("CREATE TABLE `camagru`.`comments`(
            `comment_id` INT(255) NOT NULL AUTO_INCREMENT,
            `comment` VARCHAR(255) NOT NULL,
            `img_id` INT(255) NOT NULL,
            `user_id` INT(255) NOT NULL,
            PRIMARY KEY(`comment_id`)
        )");
        $dbh->exec("CREATE TABLE `camagru`.`likes`(
            `like_id` INT(255) NOT NULL AUTO_INCREMENT,
            `img_id` INT(255) NOT NULL,
            `user_id` INT(255) NOT NULL,
            PRIMARY KEY(`like_id`)
        )");
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

?>