<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 7/17/2017
 * Time: 8:55 AM
 */
include 'conn.php';
include 'function.php';
$sql = "SELECT * FROM post";
$result = $conn->query($sql);
?>

<!Doctype html>
<html>
<head>
    <link href="../youthalive/css/w3.css" rel="stylesheet" />
    <link href="../youthalive/css/admin-responsive.css" rel="stylesheet" />
    <link href="../youthalive/css/responsive.css" rel="stylesheet" />
    <link href="../youthalive/fa/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../youthalive/css/text.css" rel="stylesheet" />
    <link href="../youthalive/css/joshua.css" rel="stylesheet" />
    <link href="responsive-pad.css" rel="stylesheet" />
    <style>

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
            border-right: 1px solid;
            padding: 0 4px;
            opacity: 0.7;
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

    </style>
    <script src="appml.js"></script>
</head>
<body class="w3-light-grey">
<nav class="">
    <ul class="w3-dark-grey w3-opacity navbar w3-top" appml-data="json/menu.json">
        <li class="w3-hover-black" style="display: flex;" appml-repeat="menu">
            <a href="{{link}}">{{name}}</a>
        </li>
    </ul>
</nav>
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
                            <li ><a href = "" ><i class="fa fa-stack-overflow" ></i ></a ></li >
                            <li ><a href = "" ><i class="fa fa-paper-plane" ></i > Share</a ></li >
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