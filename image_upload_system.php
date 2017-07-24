<?php


include "function.php";
$dir = getcwd();
setcookie("cur_dir", $dir, time() + 3600, "/");
if(isset($_GET['drive'])) {
    $dir = $_GET['drive'];
} else {
    if (isset($_GET['dir'])) {
        $dir = $_GET['dir'];
    } else {
		$list = array('.');
		$drives = getHardDrives();
        foreach($drives as $k => $value) {
                if(is_dir($value)) {
					array_push($list, $value);
                }
            }
            $drive = True;
        $contents = $list;
    }
}
if(!isset($contents)) {
chdir($dir);
$contents = scandir($dir);
}

$currWorkD = getcwd();
$directory_array = explode("\\", $currWorkD);
$directory_array_length = count($directory_array);
$drives = getHardDrives();

?>
<?php
if(isset($_POST['done'])) {
    $file = getcwd()."\\".$_COOKIE['imageName'];
    $string = file_get_contents($file);
    $cur_dir = $_COOKIE['cur_dir'];
    $folder = "/images/";
    $currentDir = $cur_dir.$folder;
    chdir($currentDir);
    $file = rand() . $_COOKIE['imageName'];
    if(fopen("temp.txt", "w")) {
        file_put_contents("temp.txt", $string);
        if(rename("temp.txt",$file)) {
            $folder = 'images/';
            $file = $folder.$file;
        }
    }

}
?>

<!Doctype html>
<html>
	<head>
		<link href="../youthalive/css/w3.css" rel="stylesheet" />
		<link href="../youthalive/fa/css/font-awesome.min.css" rel="stylesheet" />
		<style>
            
            form {
                display: inline;
            }
            
			@keyframes slide {
				from {left: 100px; opacity: 0;}
				to {left: 0px; opacity: 1;}
				
			}
			
			@keyframes uncover {
				from {height: 25%}
				to {height: 100%}
			}

            #keyframe showUploader {
                from {top: 700px; opacity: 0;}
                to {top: 0px; opacity: 1;}
            }

            #uploader {
                position: relative;
                height: 100%;
            }
			
			.info-container {
				animation-name: uncover;
				animation-duration: 0.2s;
				animation-timing-function: ease-in-out;
			}
			
			.cont-container {
				position: relative;
				animation-name: slide;
				animation-duration: 0.5s;
				animation-timing-function: ease-out;
			}
			
			p, h2, h6, h4 ,h5 {
				margin: 0px !important;
				padding: 0px !important;
			}
			.box-b-shadow {
				box-shadow: 2px 2px 8px rgba(0,0,0,0.3)
			}
			
			/*.box-b-shadow::after {
				content: '';
				position: absolute;
				z-index: -1; /* hide shadow behind image */
				/*box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
				width: 70%;
				left: 15%; /* one half of the remaining 30% */
				/*height: 100px;
				bottom: 0;
			}*/
			
			.nav {
				margin: 0;
				height: auto;
				overflow: hidden;
			}
			
			.nav li {
				padding: 8px;
				display: inline;
				list-style-type: none;
			}
			
			.nav li a {
				padding: 8px 8px !important;
				border-bottom: 2px solid darkgrey !important;
			}

            .nav li a:visited {
                border-bottom: 4px solid aqua;
            }
			
			.nav li a:hover {
				border-bottom: 2px solid aqua !important;
			}

            .nav li a:active {
                border-bottom: 2px solid aqua !important;
            }
			
			.address {
				background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.02), rgba(0,0,0,0.0), rgba(0,0,0,0.0), rgba(0,0,0,0.02), rgba(0,0,0,0.1));
				border-radius: 4px;
				border: 1px solid rgba(0,0,0,0.3);
				overflow: hidden;
			}
			
			.folder {
                list-style-type: none;
				margin: 4px;
				overflow: hidden;
			}
			
			.folder h6 {
				
			}
			

			.history {
				padding: 18px 4px 2px;
			}
			
			.history li {
				display: inline;
				border: 1px solid lightgrey;
				border-radius: 3px;
				padding: 8px;
				box-shadow: 0px 0px 4px rgba(0,0,234, 0.3)
			}
			
			.contents {
				overflow-y: auto;
			}
			
			#info {
				position: relative;
				display: flex;
				justify-content: flex-end;
				margin: auto;
				padding-right: 8px;
				box-shadow: 0px -2px 4px rgba(0,0,0,0.3);
			}
			
			#info a {
				padding:0px 6px;
			}
			
			#info #content {
				position: absolute;
				bottom: 18px;
				z-index: 1;
				list-style-type: none;
				border-radius: 8px;
				box-shadow: 0px 0px 8px rgba(0,0,0, 0.4);
				background: white;
				overflow: hidden;
			}
			
			#info #content li {
				border: 1px solid rgba(0,0,5,0.1);
				padding: 2px 8px;
			}
			
			#info #content li:hover {
				border: 1px solid rgba(0,0,5,0.1);
				padding: 2px 8px;
				background-color: lightgrey;
			}
			
			#info #content li:first-child {
				border-top-left-radius: 8px;
				border-top-right-radius: 8px;
			}
			
			#info #content li:last-child {
				border-bottom-left-radius: 8px;
				border-bottom-right-radius: 8px;
			}
			
		</style>
        <script>

            function selectImage(id, name) {
                var el = document.getElementById(id);
                var button = document.getElementById('done');
                var div = document.getElementById('contents');
                div.style.opacity = 0.1;
                button.style.opacity = 1;
                el.style.opacity = 1;
                el.style.backgroundColor = "orangered";
                el.style.color = "white";



                document.cookie = "imageName="+name;
            }

            function screenSwitch() {
                var selector = document.getElementById('selector');
                var uploader = document.getElementById('uploader');
                selector.style.display = "none";
                uploader.style.display = "block";
                uploader.animation = "showUploader";
                uploader.animationDelay = "0.5s";
                uploader.animationTimingFunction = "ease-out";
            }

            function sendValue(val) {
                if(val) {
                    var i_frame = window.frameElement;
                    i_frame.setAttribute('value', val);
                    document.cookie = 'final_Image='+val;
                    var parentDocument = i_frame.parentNode.parentNode;
                    parentDocument.style.display = 'none';
                }
            }
        </script>
	</head>
	<body onload="sendValue('<?php echo $file; ?>');">
    <div id="selector" style="position: relative; height: 100%;">
		<div class="box-b-shadow nav" style="position: fixed; top: 0px; right: 0px; left: 0px;">
            <?php
            foreach($drives as $k => $value) {
                if(is_dir($value)) {
                    echo '<li><a href="image_upload_system.php?drive='.$value.'">'.$value.'</a></li>';
                }
            }
            ?>
			<li class=""><i class="fa fa-folder-open" style="padding-right:2px;"></i><span><?php echo $currWorkD; ?></span></li>
			<li class=""><a><i class="fa fa-backward"></i></a></li>
            <form method="post"><button name="done" id="done" class="w3-btn w3-blue" onclick="screenSwitch()" style="opacity: 0.4;">Upload</button></form>
			
		</div>
        <div class="history" style="position:fixed; top: 40px; right: 0px; left: 0px;">
            <?php
            for($i = 0; $i < ($directory_array_length - 1); $i++) {
                echo '<li><a>'.$directory_array[$i].'</a></li>';
            }
            ?>
        </div>
		<div class="" style="position: fixed; top: 94px; bottom: 0px; right: 0px; left: 0px; overflow: auto; z-index: -1;">
			<div class="w3-padding-large contents cont-container" id="contents" style="display: flex; flex-wrap: wrap;">
                <?php
                chdir("localhost/design");
                foreach($contents as $index => $name) {
                    if($name == ".") {

                    } else {
                        if($name == "..") {
                            echo '
                            <li style="" class="folder" id=""><a href="image_upload_system.php?dir='.$currWorkD.'\\'.$name.'">
                    <i class="fa fa-arrow-left"></i>Back</a></li>
                            ';
                        } else if(is_dir($name)) {

                            if($drive) {
                                echo '
                            <li style="" class="folder" id=""><a href="image_upload_system.php?drive=' . $name . '">
					<i class="fa fa-folder"></i>' . $name . '</a></li>
                            ';
                            } else {

                                echo '
                            <li style="" class="folder" id=""><a href="image_upload_system.php?dir=' . $currWorkD . '\\' . $name . '">
					<i class="fa fa-folder"></i>' . $name . '</a></li>
                            ';
                            }
                        } else {
                            $id = 'a'.$index;
                            echo '<li style="" class="folder" id="'.$id.'" onclick="selectImage(\''.$id.'\',\''.$name.'\')">
					<i class="fa fa-image"></i>
                            '.$name.'
				</li>';
                        }
                    }
                }
                ?>


			</div>
		</div>
    </div>

    <div id="uploader" style="display: none;">

    </div>
	</body>
</html>