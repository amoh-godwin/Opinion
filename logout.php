<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 9/16/2017
 * Time: 12:41 PM
 */
session_start();

$_SESSION['admin'] = null;
$_SESSION['user_image'] = null;
header('Location: index.php');