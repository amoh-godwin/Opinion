<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 8/31/2017
 * Time: 3:48 PM
 */
session_start();
include 'conn.php';
if(isset($_GET['email'])) {

    $email = $_GET['email'];

    $find_user_query = "SELECT * FROM users WHERE email = '$email'";

        if($find_user_data = $conn->query($find_user_query)) {

        while($find_user = $find_user_data->fetch_assoc()) {

            $sess_user = base64_encode($find_user['username']);
            $sess_password_length = $find_user['password_length'];
            $sess_stwotsrd = $find_user['stwotsrd'];
            $sess_hashed_password = $find_user['hashed_password'];
            setcookie('user', $sess_user, time() + 86400, '/');
            setcookie('password_length', $sess_password_length, time() + 86400, '/');
            setcookie('stwotsrd', $sess_stwotsrd, time() + 86400, '/');
            $user_image = $find_user['image'];

            if($user_image != "") {

                $_SESSION['user_image'] = $find_user['image'];
                setcookie('user_image', $find_user['image'], time() + 86400, '/');

            } else {

                $_SESSION['user_fake_image'] = $find_user['username'][0];
                setcookie('user_fake_image', $find_user['username'][0], time() + 86400, '/');

            }

            echo $find_user['username'];

        }

    }


} else {
    return ' Thank you King Eternal';
}