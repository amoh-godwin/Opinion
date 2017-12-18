<?php
/**
 * Created by PhpStorm.
 * Date: 7/17/2017
 * Time: 8:55 AM
 */
session_start();
include 'conn.php';
include 'function.php';
if(isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
} else {
    $admin = 0;
}

$post_length = 12;

$sql = "SELECT * FROM post ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!Doctype html>
<html>
<head>
    <link href="css/w3.css" rel="stylesheet" />
    <link href="css/admin-responsive.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <link href="css/fa/css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/text.css" rel="stylesheet" />
    <link href="css/joshua.css" rel="stylesheet" />
    <link href="css/responsive-pad.css" rel="stylesheet" />
    <link href="css/main-nav.css" rel="stylesheet" />
    <style>

        body, html {
            height: 100%;
        }

        a {
            display: block;
        }

        footer div {
            color: #626262;
        }

        footer div ul li {
            padding: 4px 0;
        }

        footer div ul li a {
            font-size: 0.97em;
            text-decoration: none;
        }

        footer div ul li a:hover {
            text-decoration: underline;
        }

        i {
            padding: 0 4px;
        }

        .share-menu ul {
            display: flex;
            flex-wrap: nowrap;
        }

        .share-menu li {
            display: flex;
            flex-wrap: nowrap;
        }

        .share-menu li a {
            display: block;
            padding: 4px;
        }

        .share-menu li a:hover {
            background-color: darkgrey;
            color: aliceblue;
        }

        .quarter {
            padding: 0px 8px 16px 8px;
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
    <script src="functions.js"></script>
    <script src="appml.js"></script>
    <script src="own.js"></script>
    <script src="nav.js"></script>
</head>
<body class="w3-light-grey" onload="checkAuthor()">
<div style="position: fixed; top: 0;width: 100%;">
        <nav style="width: 100%;">
            <ul class="nav w3-margin-0 w3-padding-0 w3-blue" style="">
                <li><a href="#"><b>Youth Alive</b> <i class="fa fa-book"></i></a></li>
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
<header class="head-64" style="">
    <img src="images/RE1oR3k.jpg" width="100%" height="100%" />
</header>
<div class="full main-54" style="">
    <?php

    while($post = $result->fetch_assoc()) {
        $post_id = $post['id'];
        $post_title = $post['title'];
        $post_message = $post['message'];
        $post_image = $post['image'];
        $post_date = smartTime($post['created_date']);
        echo '
        <div class="quarter" >
        <a href = "read_post.php?postid='.$post_id.'" >
            <div class="w3-white" style = "height: 300px" >
                <div style = "width: 100%; height: 200px" >
                    <img src = "'.$post_image.'" width = "100%" height = "100%" />
                </div >
                <div style = "padding: 8px;" >
                    <div class="full" >
                        <p class="w3-margin-0 w3-padding-0" ></p >
                    </div >
                    <div class="full" ><p class="w3-margin-0 w3-padding-0" >'.$post_title.'</p ></div >
                    <div class="share-menu full" style = "" >
                        <ul class="w3-padding-0 w3-margin-0" >
                            <li ><a href = "" ><i class="fa fa-stack-overflow" ></i ></a ></li>
                            <li ><a href = "" ><i class="fa fa-paper-plane" ></i > Share</a ></li>
                        </ul >
                    </div >
                </div >
            </div >
        </a >
    </div >
    ';
    }
    ?>




</div>
<div class="full w3-margin-0" style="padding: 12px 52px 24px 52px">

    <!--<div class="quarter">
    <div class="w3-red" style="height: 250px">
        <div style="height: 150px">
            <img src="images/RE1r2iO.jpg" width="100%" height="100%" />
        </div>
        <div style="padding: 8px">
            <h4 class="w3-margin-0">The Love of God</h4>
            <p class="w3-margin-0"><a href="">Read More</a></p>
        </div>
    </div>
    </div>-->

</div>

<div class="full">
    <?php
    $sql_count = "SELECT COUNT(title) FROM post";
    $result_count = $conn->query($sql_count)->fetch_row();
    $count = $result_count[0];
    $raw_entry_no = $count / $post_length;
    $rounded_entry_value = round($raw_entry_no);
    if($rounded_entry_value < $raw_entry_no) {
        $entries = $rounded_entry_value + 1;
    } else {
        $entries = $rounded_entry_value;
    }

    $current_entry_no = 1;
    if($current_entry_no > 1) {

        // left arrow

    }

    // the middle no

    if($current_entry_no < $entries) {

        // right arrow

    }

    ?>
</div>

<footer class="full w3-white" style="padding:40px 60px">
    <div class="third">
        <p class="w3-margin-0">Follow Us</p>
        <ul class="w3-margin-0 w3-padding-0 w3-small">
        </ul>
    </div>

    <div class="third">
        <p class="w3-margin-0">Contributors</p>
        <ul class="w3-margin-0 w3-padding-0 w3-small">
        </ul>
    </div>

    <div class="third">
        <p class="w3-margin-0">Series</p>
        <ul class="w3-margin-0 w3-padding-0 w3-small">
        </ul>
    </div>
</footer>
</body>
</html>