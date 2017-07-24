<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 7/16/2017
 * Time: 6:03 PM
 */

include "conn.php";

$title = $_POST['title'];
$message = $_POST['message'];
$img_src = $_POST['img_src'];
$time = time();

$sql = "INSERT INTO post(title, message, image, created_date) VALUES ('$title', '$message', '$img_src', $time)";
$run_code = $conn->query($sql);