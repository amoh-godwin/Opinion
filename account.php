<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
} else {
    $admin = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account | <?php echo $_SESSION['author']; ?></title>
    <link href="css/w3.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <link href="css/pad.css" rel="stylesheet" />
    <link href="css/fa/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/main-nav.css" rel="stylesheet" />

    <style>
        .shadow {
            box-shadow: 0 0 4px 1px rgba(0,0,0,0.1);
        }

        .radius {
            border-radius: 2px 2px;
        }

        .nav {
            display: flex;
        }

        .nav li {
            display: inline;
            list-style-type: none;
            padding: 16px 24px 16px 24px;
        }

        .nav li:hover {
            background-color: lightgrey;
            color: black;
        }

        .search-div {
            padding: 2px;
        }

        .search-btn {
            padding: 2px !important;
            background-color: dodgerblue;
            color: white;
            border: 0;
        }

    </style>

    <script src="nav.js"></script>
    <script src="functions.js"></script>
    <script>
        var On = false;

        function toggleView(id) {
            var el = document.getElementById(id);
            if(On) {
                el.type = 'password';
                On = false;
                return;
            } else {
                el.type = 'text';
                On = true;
                return;
            }
        }
    </script>
    <script>
        function getImage(e) {
            var input_file = document.getElementById('file');
            var prof = document.getElementById('pp');
            var hidden = document.getElementById('hidden');
            var d = new Date();
            var fr = new FileReader();

            fr.readAsDataURL(input_file.files[0]);
            fr.onloadend = function (e) {
                var dataUrl = e.target.result;
                var splits = dataUrl.split('64,/');
                var base64_only = splits[1];
                prof.src = dataUrl;
                hidden.value = dataUrl;
                var dir_and_name = input_file.value.split('\\');
                var len = dir_and_name.length - 1;
                var ori_name = dir_and_name[len];
                var time = d.getTime();
                var name = ori_name;
                document.cookie = "imageName=" + encodeURI(name);
            }

        }
    </script>

</head>
<body class="w3-light-grey" style="" onload="">

<div style="position: fixed; top: 0;width: 100%;">
    <nav style="width: 100%;">
        <ul class="nav w3-margin-0 w3-padding-0 w3-blue" style="">
            <li><a href="index.php"><b>Youth Alive</b> <i class="fa fa-book"></i></a></li>
            <li style="margin-left: auto;" id="nav-icon" onclick="modalToggle()"><i class="fa fa-navicon"></i></li>
        </ul>
    </nav>

    <div class="w3-white menu w3-text-blue" style="height: 100%; z-index: 2;" id="menu">
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


<div class="w3-light-grey T-52" style="" id="main">

    <form action="account_update.php" method="post">
        <?php
        $id = $_SESSION['id'];
        $find_password_sql = "SELECT * FROM users WHERE id=$id";

        if ($find_password = $conn->query($find_password_sql)) {

            while ($user = $find_password->fetch_assoc()) {

                $email = $user['email'];
                $_SESSION['password_length'] = $user['password_length'];
                $stwotsrd = $user['stwotsrd'];
            }
        }
        ?>
    <div class="T-52" style="display: flex; justify-content: center;">
        <div style="width: 64px; height: 64px; position: relative; display: flex">
            <div style="position:absolute; top: 0px; left: 48px; display: flex; align-items: center">
                <div style="position: relative">
                    <i class="w3-tiny fa fa-edit w3-aqua w3-opacity w3-round-large" onclick="setImage()"
                       style="position: absolute; top: 0; bottom: 0; right: 0; left: 0; width: 100%; height: 100%;">
                    </i>
                    <div style="position: absolute; top: 0; right: 0; left: 0; bottom: 0; width: 100%; height: 100%; opacity: 0;">
                        <input type="file" id="file" onchange="getImage(event)" style="width: 100%; height: 100%;"/>
                    </div>
                </div>
            </div>
            <?php
            if($admin > 0) {

                if (isset($_SESSION['user_fake_image'])) {
                    echo '
            <div class="w3-green w3-circle" style="">
                <a href="" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <span class="w3-xxlarge">' . $_SESSION["user_fake_image"] . '</span>
                </a>
            </div>
            ';
                } else {
                    echo '
            <div class="">
                <a href="" style="display: block; width: 100%; height: 100%;">
                    <img src="' . $_SESSION["user_image"] . '" width="100%" height="100%" class="w3-circle" id="pp"/>
                </a>
            </div>
            ';
                }

            } else {
                echo '';
            }

            ?>
        </div>
    </div>

    <div class="w3-padding-8">
        <div class="shadow radius w3-white w3-padding-12 w3-padding-large">
            <div class="" style="display: flex; justify-content: space-between">
                <span class="w3-text-blue w3-medium">Email</span>
                <span class="w3-small" style=""><?php echo $email; ?></span>
            </div>
            <div class="w3-padding-8">
                <input type="text" name="email" class="w3-border-0" style="width: 100%; color: #bdbdbd;" placeholder="<?php echo $email; ?>" value="" id="email-field" />
            </div>
        </div>
    </div>

    <div class="w3-padding-8">
        <div class="shadow radius w3-white w3-padding-12 w3-padding-large">
            <div class="" style="display: flex; justify-content: space-between;">
                <span class="w3-text-blue w3-medium">Password</span>
                <span class="w3-small" id="pass-phold">
                </span>
                <script>
                    var i;
                    var dots = '';
                    var len = <?php echo $_SESSION['password_length']; ?> - 2;
                    var stwotsrd = '<?php echo $stwotsrd; ?>';
                    var placeholder = document.getElementById('pass-phold');
                    for (i = 0; i < len ; i++) {
                        dots += '&#9679;';
                    }
                    placeholder.innerHTML = dots + stwotsrd;
                </script>
            </div>
            <div class="w3-padding-8" style="display: flex">
                <input name="pass" type="password" class="w3-border-0" style="width: 100%" value="0000" id="pass-field" />
                <li class="w3-hover-opacity" onmouseover="toggleView('pass-field')"><i class="fa fa-eye-slash"></i></li>
            </div>
        </div>
    </div>

    <div class="w3-padding-24" style="display: flex; justify-content: center;">
        <div>

                <input type="submit" class="w3-btn w3-blue radius" style="" value="Save" name="submit" />
                <input type="hidden" id="hidden" name="hidden" value="" />
        </div>
    </div>

    </form>
</div>

</body>
</html>