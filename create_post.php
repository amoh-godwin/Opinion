<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 7/16/2017
 * Time: 6:03 PM
 */
session_start();
include "conn.php";
include "function.php";

if (isset($_POST['startPHP'])) {
    $folder = 'images/';
    $name = '';
    $name = urldecode($_COOKIE['imageName']);
    $list = explode('.', $name);
    $last_i = count($list) - 1;
    $file_format = $list[$last_i];
    $data_url = $_POST['hidden'];
    if(empty($data_url)){/* no need to add the folder name */ $new_name = $name;} else {
        $break = explode('64,', $data_url);
        $base64_only = $break[1];
        $code = base64_decode($base64_only);

        chdir('images/');

        if (file_exists($name)) {

        } else {
            $name = getDomainName() . '_' . time() . '.' . $file_format;
            $temp = 'temp.txt';
            $file = fopen($temp, 'wb');
            fwrite($file, $code);
            fclose($file);

            rename($temp, $name);



        }

        // add the directory name to the image name
        $new_name = $folder . $name;
    }

    $title = badWordFilter($_POST['title']);
    $message = badWordFilter($_POST['message']);
    $time = time();

    $sql = "INSERT INTO post(title, message, image, created_date) VALUES ('$title', '$message', '$new_name', $time)";

    if ($run_code = $conn->query($sql)) {
        $_SESSION['last_inserted_id'] = $conn->insert_id;

        if(isset($_SESSION['last_inserted_id'])) {
            $redir = 'read_post.php?postid='.$_SESSION['last_inserted_id'];
            redirect_to($redir);
        }

    } else {

        echo $conn->error;

    }

} else {
    echo 'God will save me';
}