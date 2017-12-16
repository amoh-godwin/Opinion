<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_POST['pass'])) {

    $user_username = base64_decode($_COOKIE['user']);
    $password = $_POST['pass'];
    $find_password_sql = "SELECT * FROM users WHERE username='$user_username'";

    if ($find_password = $conn->query($find_password_sql)) {

        while ($user = $find_password->fetch_assoc()) {

            $existing_hash = $user['hashed_password'];
            $_SESSION['password_length'] = $user['password_length'];
            $stwotsrd = $user['stwotsrd'];
            $hash = crypt_pass($password, $existing_hash);

            if (crypt_pass($password, $existing_hash)) {

                $_SESSION['author'] = $user_username;
                setcookie('author', $user_username,time() + 86400, '/');
                $_SESSION['pass_error'] = null;
                setcookie('pass_error', 0, time() + 86400, '/');
                $_SESSION['stwotsrd'] = null;
                setcookie('stwotsrd', '', time() + 86400, '/');
                $_SESSION['admin'] = 1;
                $_SESSION['id'] = $user['id'];

            } else {

                $_SESSION['pass_error'] = $_SESSION['password_length'];
                setcookie('pass_error', $_SESSION['password_length'], time() + 86400, '/');
                $_SESSION['stwotsrd'] = $stwotsrd;
                setcookie('stwotsrd', $stwotsrd, time() + 86400, '/');
            }

        }
    }
}