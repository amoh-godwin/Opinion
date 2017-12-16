<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 7/17/2017
 * Time: 6:27 PM
 */
session_start();
include "conn.php";
include "function.php";

if(isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
} else {
    $admin = 0;
}

if(isset($_GET['postid'])) {
    $request_id = $_GET['postid'];
    $sql = "SELECT * FROM post WHERE id=$request_id";
    if($response = $conn->query($sql)) {
        if ($post = $response->fetch_assoc()) {
            $post_title = $post['title'];
            $post_message = $post['message'];
            $post_image = $post['image'];
            $post_date = $post['created_date'];
        }
    } else {
        echo $conn->error;
    }
}

?>

<!Doctype html>
<html>
<head>
    <title>Youth Alive &#9679; <?php echo $post_title; ?></title>
    <link href="css/w3.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <link href="css/joshua.css" rel="stylesheet" />
    <link href="css/fa/css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/responsive-column.css" rel="stylesheet" />
    <link href="css/shadow.css" rel="stylesheet" />
    <link href="css/main-nav.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
        }
        .parallax {
            position: relative;
            background-image: url('<?php echo $post_image; ?>');
            height: 80%;

            background-attachment: fixed;
            background-position: center;
            /*background-repeat: no-repeat;
            /*background-size: cover;*/
        }

        .title {
        }

        .navbar {
            display: flex;
            list-style-type: none;
            overflow: hidden;
            padding: 0;
            margin: 0;
        }

        .navbar li {
            display: inline;
            padding: 8px 4px;
        }

        .navbar li a {
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 16px;
        }

        .navbar li a:hover {
            background-color: rgba(0,0,0,0.375);
            color: white;
        }

        .user-link {
            margin-left: auto;
        }


        .parallax ul:first-child {
            background-color: rgba(0,0,0,0.5);
            color: rgba(255,255,255,0.5);
        }


        .tt {
            position: relative;
            display: inline-block;
        }

        .tt .ttt {
            visibility: hidden;
            width: 200px;
            height: 250px;
            background-color: white;
            color: black;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            position: fixed;
            z-index: 1;
            top: 58px;
            right: 0;

            opacity: 0;
            transition: opacity 1s;
        }

        .tt .ttt::after {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent white transparent;
        }

        .tt:hover .ttt {
            cursor: pointer;
            visibility: visible;
            opacity: 1;
        }


    </style>

    <script src="appml.js"></script>
    <script src="functions.js"></script>
    <script src="own.js"></script>
    <script src="nav.js"></script>

</head>
<body onload="checkAuthor()">



<header class="parallax">
    <div style="position: fixed; top: 0;width: 100%;">
        <nav style="width: 100%;">
            <ul class="nav w3-margin-0 w3-padding-0 w3-blue" style="">
                <li><a href="index.php"><b>Youth Alive</b> <i class="fa fa-book"></i></a></li>
                <li style="margin-left: auto;" id="nav-icon" onclick="modalToggle()"><i class="fa fa-navicon"></i></li>
            </ul>
        </nav>

        <div class="w3-white menu w3-text-blue" style="height: 100%;" id="menu">
            <h3 class="w3-margin-0 w3-padding-32"><b>YA</b></h3>
            <?php
            if($admin > 0) {

                if (isset($_SESSION['user_fake_image'])) {
                    echo '
            <div class="circle-img w3-green w3-circle" style="">
                <a href="account.php" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <span class="w3-xxlarge">' . $_SESSION["user_fake_image"] . '</span>
                </a>
            </div>
            ';
                } else {
                    echo '
            <div class="circle-img">
                <a href="account.php" style="display: block; width: 100%; height: 100%;">
                    <img src="' . $_SESSION["user_image"] . '" width="100%" height="100%" class="w3-circle"/>
                </a>
            </div>
            ';
                }

            } else {
                echo '';
            }

            ?>

            <ul class="w3-margin-0 w3-padding-0 w3-center" style="">

                <li onclick="modalToggle()">Close</li>

                <?php

                if($admin == 0) {
                    $do_not_show = 100;
                } else {
                    $do_not_show = 4;
                }

                $get_menu_sql = "SELECT * FROM menu WHERE visible <= $admin AND id != $do_not_show";
                if($run_menu_sql = $conn->query($get_menu_sql)) {
                    while($db_menu = $run_menu_sql->fetch_assoc()) {
                        echo '<li><a href="'.$db_menu["link"].'">'.$db_menu["name"].'</a></li>';
                    }
                }

                ?>

            </ul>
        </div>
    </div>
</header>
<main style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center;">
    <div class="" style="width: 100%; display: flex; justify-content: center;">
    <h1 class="w3-margin-0 w3-center t-teal w3-padding-xlarge" id="title" style=""><?php echo $post_title; ?></h1>
    </div>
    <div class="w3-deep-orange w3-margin-0" style="height: 4px; width: 150px;"></div>
</main>
<article class="w3-padding-large lar-col">
    <?php echo $post_message; ?>
</article>
<div class="w3-padding-32"></div>
<footer>
    <div class="w3-bottom w3-card-2">
        <ul class="w3-navbar w3-white nav">
        </ul>
    </div>
    <div></div>
</footer>
</body>
</html>