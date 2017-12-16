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
    //var img_url = "";
    var h_ones = document.getElementsByTagName('h1');
    var ps = document.getElementsByTagName('p');

    for(var i = 0; i < h_ones.length; i++) {
        title += h_ones[i].innerHTML;
    }
    for(var j = 0; j < ps.length; j++) {
        message += ps[j].innerHTML;
    }


    /*********************
    **     Ajax Call     *
    *********************/

    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "create_post.php?page=about_us", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            var response = ajax.responseText;
            var values = response.split(";");
            var new_title = values[0];
            var new_message = values[2];
            title = new_title;
            message = new_message;

            if(response == 'love God') {
                alert('Thank you Father, Done Inserting!');
            } else {
                alert(response);
            }
        }
    };


    ajax.send("title="+title+"&message="+message);
}

function cookies(str) {
    var cookies = document.cookie;
    var entries = {};

    if(cookies.search(';') !== -1) { // Multiple instance;

        var cookies_list = cookies.split('; ');

        for (var i = 0; i<cookies_list.length; i++) {

            if( i === 0) {
                var sandbox_entries = cookies_list[i].split('=');
                var keyName = sandbox_entries[0];
                var value = sandbox_entries[1];
                entries[keyName] = eval('{' + keyName + ':' + '"' + value + '"' + '}');
            } else {
                var sandbox_entries1 = cookies_list[i].split('=');
                var keyName1 = sandbox_entries1[0];
                var value1 = sandbox_entries1[1];
                entries[keyName1] = eval('{' + keyName1 + ':' + '"' + value1 + '"' + '}');
            }
        }

    } else { // Single instance;

        var cookies_list1 = cookies.split('=');
        var keyName2 = cookies_list1[0];
        var value2 = cookies_list1[1];
        entries[keyName2] = eval('{' + keyName2 + ':' + '"' + value2 + '"' + '}');

    }

    return entries[str];
}

function stage() {

    var first_stage = document.getElementById('username');
    var second_stage = document.getElementById('password');
    var user_img = document.getElementById('user_img');
    var user_f_img = document.getElementById('user_f_img');
    var user_f_name = document.getElementById('user_f_name');
    var refer = document.getElementById('refer');
    var user = cookies('username');

    if(cookies('user') !== undefined) {

        first_stage.style.display = "none";
        second_stage.style.display = "block";

        if(cookies('pass_error') !== undefined) {
            var pass_error = document.getElementById('pass_error');
            var hint = document.getElementById('hint');

            second_stage.style.borderBottom = "2px solid crimson";
            pass_error.style.display = "block";
            var list = '';

            for(var i = 0; i < cookies('pass_error') - 2 ; i++) {
                list += '&#8226;';
            }

            list += cookies('stwotsrd');

            hint.innerHTML = list;
        }

        refer.innerHTML = 'Not ' + user;

        if(cookies('user_image') !== undefined) {
            user_f_img.style.display = 'none';
            user_img.src = cookies('user_image');
            user_img.style.display = 'block';
        } else {
            user_f_name.innerHTML = cookies('user_fake_image');
        }

    } else {

        first_stage.style.display = "block";
        second_stage.style.display = "none";
    }

}

function unset(val) {
    document.cookie = val + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
    document.cookie = 'user_image=; expires=Thu, 01 Jan 1960 00:00:00 UTC; path=/';
    document.cookie = 'pass_error=; expires=Thu, 01 Jan 1960 00:00:00 UTC; path=/';
    document.cookie = 'stwotsrd=; expires=Thu, 01 Jan 1960 00:00:00 UTC; path=/';
    document.cookie = 'author=; expires=Thu, 01 Jan 1960 00:00:00 UTC; path=/';
    document.cookie = 'password_length=; expires=Thu, 01 Jan 1960 00:00:00 UTC; path=/';
    document.cookie = 'user_fake_image=; expires=Thu, 01 Jan 1960 00:00:00 UTC; path=/';
    document.cookie = 'username=; expires=Thu, 01 Jan 1960 00:00:00 UTC; path=/';
    stage();
}

function confirm_pass(password, other) {

    var msg = document.getElementById('msg');
    if(password === other) {
        msg.style.display = "none";
    } else {
        msg.style.display = "block";
        msg.innerText = "Password doesn't match";
    }

}