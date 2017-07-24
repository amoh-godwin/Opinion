<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 7/17/2017
 * Time: 6:27 PM
 */

include "conn.php";
include "function.php";

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
    <link href="../youthalive/css/w3.css" rel="stylesheet" />
    <link href="../opinion/css/responsive.css" rel="stylesheet" />
    <link href="../youthalive/css/joshua.css" rel="stylesheet" />
    <link href="../youthalive/fa/css/font-awesome.min.css" rel="stylesheet" />
    <link href="responsive-column.css" rel="stylesheet" />
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


    </style>

    <script src="appml.js"></script>

</head>
<body>



<header class="parallax">
    <ul class="navbar w3-top w3-padding-0" appml-data="json/menu.json">
        <li appml-repeat="menu"><a href="{{link}}">{{name}}</a></li>
    </ul>
</header>
<main>
    <h1 class="w3-margin-0 t-teal w3-padding-large"><?php echo $post_title; ?></h1>
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