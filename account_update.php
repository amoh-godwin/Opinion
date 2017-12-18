<?php
/**
 * Created by PhpStorm.
 * Date: 9/16/2017
 * Time: 11:28 AM
 */
  session_start();
  include "function.php";
  include 'conn.php';
    if(isset($_POST['submit'])) {
        $data_url = $_POST['hidden'];

        $folder = 'images/';
        $break = explode('64,', $data_url);
        $no = '1';
        $base64_only = $break[$no];
        $code = base64_decode($base64_only);
        $name = urldecode($_COOKIE['imageName']);
        $list = explode('.', $name);
        $last_i = count($list) - 1;
        $file_format = $list[$last_i];
        $temp = 'temp.txt';

        chdir($folder);

        if(is_file($name)) {
            $new_name = $name;
        } else {

            $new_name = getDomainName() . '_' . time() . '.' . $file_format;
            $file = fopen($temp, 'wb');
            fwrite($file, $code);
            fclose($file);

            rename($temp, $new_name);

        }

        $id = $_SESSION['id'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $image = $folder.$new_name;
        if(isset($_SESSION['user_fake_image'])) {
            if($data_url != '') {
                $_SESSION['user_fake_image'] = null;
                $_SESSION['user_image'] = $image;
            } else {
                $image = '';
            }
        } else {
            if ($data_url == '') {
                $image = $_SESSION['user_image'];
            } else {
                $_SESSION['user_image'] = $image;
            }
        }
        $_SESSION['user_image'] = $image;
        $pass_length = strlen($pass);
        $stwotsrd = substr($pass,-2,2);
        $hash_pass = crypt_pass($pass);
        $sql = "UPDATE users SET email='$email', password_length=$pass_length, stwotsrd='$stwotsrd', hashed_password='$hash_pass', image='$image' WHERE id=$id";

        if($run = $conn->query($sql)) {
            echo '<link href="css/w3.css" rel="stylesheet" />';
            echo '<p class="w3-blue w3-center w3-padding-small w3-margin-0">'. 'Success' .'</p>';
            echo '<p class="w3-deep-orange w3-center w3-padding-small w3-margin-0"><a href="index.php">Click Here to go back</a></p>';
            $_SESSION['id'] = $id;
        }

    } else {
        echo '<p class="w3-deep-orange w3-center w3-padding-small w3-margin-0">' .'Thank you King Eternal' . '</p>';
    }
    ?>