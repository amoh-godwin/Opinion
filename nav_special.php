<?php
/**
 * Created by PhpStorm.
 * User: CHARITY PRODUCTIONS
 * Date: 9/13/2017
 * Time: 7:21 PM
 */
session_start();
include 'conn.php';
if(isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
} else {
    $admin = 0;
}

?>
<div style="position: fixed; top: 0; z-index:2; width:100%;">
    <nav style="width: 100%;">
        <ul class="nav w3-margin-0 w3-padding-0 w3-blue" style="">
            <li><a href="index.php"><b>Youth Alive</b> <i class="fa fa-book"></i></a></li>
            <li style="margin-left: auto;" id="nav-icon" onclick="modalToggle()"><i class="fa fa-navicon"></i></li>
        </ul>
    </nav>

    <div class="w3-white menu w3-text-blue" style="height: 100%;" id="menu">
        <h3 class="w3-margin-0 w3-padding-32"><b><a href="index.php">YA</a></b></h3>
        <?php
        if($admin > 0) {

            if (isset($_SESSION['user_fake_image'])) {
                echo '
            <div class="circle-img w3-green w3-circle" style="">
                <a href="account.php" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                    <span class="w3-xxlarge">' . $_SESSION["fake_image"] . '</span>
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