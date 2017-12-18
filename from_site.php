<link href="../opinion/css/w3.css" rel="stylesheet" />
<link href="../opinion/css/responsive.css" rel="stylesheet" />
<style>
    .list {
        border: 2px solid white;
        cursor: pointer;
    }
</style>
<script>
    var temp_image_name = '';

    function select(no) {
        var lists = document.getElementsByClassName('list');
        var sum = lists.length;
        for(var i = 0; i<sum; i++) {
            if(i === no) {
                lists[i].style.border = "2px solid dodgerblue";
                temp_image_name = lists[i].firstElementChild.src;
            } else {
                lists[i].style.border = "2px solid white";
            }
        }

        useExistingImage();
    }

    function useExistingImage() {
        var el = frameElement;
        var splited = temp_image_name.split('images/');
        var image_name = 'images/' + splited[1];
        el.setAttribute('temp-image', image_name);
        parent.all();
    }

    function close_modal() {
        parent.closeModal();
    }

</script>
<body class="w3-padding-medium" style="position: relative; padding-bottom: 40px;">
<?php
$files = scandir('images/');
?>
<div class="full" style="display: flex; flex-wrap: wrap;">
    <?php
    for ($i = 0; $i<count($files); $i++) {
        if($i < 2) {} else {
            $no = $i - 2;
            echo '
            <div class="w3-padding-small list" onclick="select('.$no.')" style="width: 76px; height: 76px; ">
        <img src="images/'.$files[$no].'" width="100%" height="100%"/>
    </div>
            ';
        }
    }
    ?>
</div>
<div class="w3-padding-4 w3-white" style="position: fixed; bottom: 0; width: 100%;">
    <div class="w3-btn w3-padding-small w3-blue" style="" onclick="close_modal();">Ok</div>
</div>
</body>