/*
*   Thank you KING ETERNAL
*/

function toggleCheckbox(king, group) {
	var checkboxes = document.getElementsByClassName(group);
	for(var i = 0; i< checkboxes.length; i++) {
		var cb = document.getElementById(checkboxes[i].id)
		cb.checked = king.checked;
	}
}

function post_edit_cookie(post_id, id) {
    var cb = document.getElementById(id);
    var btn = document.getElementById('edit-btn');
    if(cb.checked != false) {
        btn.style.backgroundColor = "dodgerblue";
        document.cookie = "post_cookie="+post_id;
    }
    else {
        btn.style.backgroundColor = "lightgrey";
    }
}

function makePageEditable() {
    var regions = document.getElementsByClassName('edit-region');
    var btn = document.getElementsByClassName('edit-btn-top');
    var btn1 = document.getElementsByClassName('edit-btn-bottom');
    var done_btn = document.getElementById('done-btn');
    var edit_btn = document.getElementById('edit-btn');
    for (var j=0; j < regions.length; j++) {
        if(regions[j]) {
            regions[j].style.border = "1px dashed dodgerblue";
        }
    }
    for (var i=0; i < btn.length; i++) {
        if(btn[i]) {
            btn[i].style.display = "block";
        }
    }
    for (var k=0; k < btn1.length; k++) {
        if(btn1[k]) {
            btn1[k].style.display = "block";
        }
    }
    done_btn.style.display = "inline";
    edit_btn.style.display = "none";
}

function makeEditable(id) {
    var block = document.getElementById(id);
    block.contentEditable = "true";
    block.classList = "editing";
}

function makeUnEditable(id) {
    var block = document.getElementById(id);
    block.contentEditable = "false";
    block.classList = "editable";
}

function sendIntoPages() {

    /**************************
     *                       **
     *  unused Elements      **
     * @type {Element}       **
     *                       **

    var edit_btn = document.getElementById('edit-btn');
    var done_btn = document.getElementById('done-btn');
    var regions = document.getElementsByClassName('edit-region');
    var btn = document.getElementsByClassName('edit-btn-top');
    var btn1 = document.getElementsByClassName('edit-btn-bottom');
    for (var j=0; j < regions.length; j++) {
        if(regions[j]) {
            regions[j].style.border = "none";
        }
    }
    for (var i=0; i < btn.length; i++) {
        if(btn[i]) {
            btn[i].style.display = "none";
        }
    }
    for (var k=0; k < btn1.length; k++) {
        if(btn1[k]) {
            btn1[k].style.display = "none";
        }
    }
    edit_btn.style.display = "inline";
    done_btn.style.display = "none";

     *********************************************************************/

    /****************
    * Data values   *
    *****************/
    var title = "";
    var message = "";
    var img_url = "";
    var h_ones = document.getElementsByTagName('h1');
    var ps = document.getElementsByTagName('p');
    var imgs = document.getElementsByTagName('header');

    for(var i = 0; i < h_ones.length; i++) {
        title += h_ones[i].innerHTML;
    }
    for(var j = 0; j < ps.length; j++) {
        message += ps[j].innerHTML;
    }

    for(var k = 0; k < imgs.length; k++) {
        if(imgs[k]) {
            img_url += imgs[k].style.backgroundImage;
        }
    }

    var img_eef1 = img_url.replace('url("', '');
    var img_href = img_eef1.replace('")', '');


    /*********************
    **     Ajax Call     *
    *********************/

    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "http://localhost/design/create_post.php?page=about_us", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            var response = ajax.responseText;
            var values = response.split(";");
            var new_title = values[0];
            var new_image = values[1];
            var new_message = values[2];
            title = new_title;
            message = new_message;
            img_href = new_image;
        }
    };


    ajax.send("title="+title+"&message="+message+"&img_src="+img_href);
    alert(title);
    alert(message);
    alert(img_href);
    alert('Thank you Father: Done');
}