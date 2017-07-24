<?php

include "db_connect.php";
include "owner.php";

session_start();

function redirect_to($new_lotion) {
    header('Location: '. $new_lotion);
}

function smartTime($time) {
    return date("d-m", $time);
}

function getBrowser() {
    $browserArray = array(
        'Windows Mobile' => 'IEMobile',
        'Android Phone' => 'Android',
        'IPhone Mobile' => 'iPhone',
        'Mozilla Firefox' => 'Firefox',
        'Google Chrome' => 'Chrome',
        'Internet Explorer' => 'MSIE',
        'Opera Browser' => 'Opera',
        'Safari' => 'Safari'
    );

    return $browserArray;
}

function getOs() {
    $osArray = array(
        'Windows 7' => 'Windows NT 6.1'
    );

    return $osArray;
}

function getSession() {
    $sessionArray = array("username", "browser", "os", "country", "referer", "views", "edits", "deletes", "authors", "series", "hours");
    
    return $sessionArray;
}

function getHardDrives() {
    $array = Array(
        0 => "A:",
        1 => "B:",
        2 => "C:",
        3 => "D:",
        4 => "E:",
        5 => "F:",
        6 => "G:",
        7 => "H:",
        8 => "I:",
        9 => "J:",
        10 => "K:",
        11 => "L:",
        12 => "M:",
        13 => "N:",
        14 => "O:",
        15 => "P:",
        16 => "Q:",
        17 => "R:",
        18 => "S:",
        19 => "T:",
        20 => "U:",
        21 => "V:",
        22 => "W:",
        23 => "X:",
        24 => "Y:",
        25 => "Z:"
    );
    return $array;
}

function getSessDbname() {
    $sessionDbnameArray = array("username", "browser", "os", "country", "referer", "views", "edits", "deletes", "authors", "series", "duration");
    
    return $sessionDbnameArray;
}

function uploadImage($name, $image_name) {
	
	$string = file_get_contents($_FILES[$name]['tmp_name']);
	$folder = "images/";
	chdir($folder);
	$temp = "temp.txt";
	$file = fopen($temp, 'w');
	fwrite($file, $string);
	fclose($file);
	$image_name = $image_name . rand();
	rename($temp, $image_name);
	chdir('../posts');
	return $folder.$image_name;
}

function colorArray() {}

function set_color($name) {
	$color_name = $name;
	return $color_name;
}

function badWordFilter($text) {
	$originals = array("'", '"');
	$replacements = array("\'", '\"');
	$cleaned_text = str_ireplace($originals, $replacements, $text);
	return $cleaned_text;
}

function postCookie($value) {
	setcookie("post_id", $value);
}

function insert_into_json($name, $data) {
	
	$file = fopen($name, 'w');
	file_put_contents($name, $data);
	fclose($file);
}