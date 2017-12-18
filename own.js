/**
 * Created by CHARITY PRODUCTIONS on 8/31/2017.
 */

function emailLogIn() {
    var pass_div = document.getElementById('password');
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var loader = document.getElementById('loader');
    pass_div.style.display = "none"; loader.style.display = "flex";
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {

        if(ajax.readyState === 4 && ajax.status === 200) {
            loader.style.display = "none";
            if(cookies('error') !== '') {
                redirect('login.html');
            } else {
                pass_div.style.display = "block";
                document.getElementById('pass').value = '';
                alert('lvoe');
                window.location.reload();
            }

        }

    };

    ajax.open('POST', 'sign_in.php', true);
    ajax.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
    ajax.send('fname='+fname+'&lname='+lname+'&email='+email+'&pass='+password);
    alert(password);
}

function redirect(to) {
    window.location.assign(to);
}

function checkAuthor() {
    var div = document.getElementById('author_info');
    var img = document.getElementById('img');
    var name = document.getElementById('author_name');
    if(cookies('author') !== undefined) {
        div.style.display = "flex";
        var cookie = cookies('user_image');
        img.src = cookie.replace('%2F', '/');
        name.innerHTML = cookies('author');
    } else {
        div.style.display = "none";
    }
}

function emailSignIn() {
    var user_div = document.getElementById('username');
    var email = document.getElementById('email').value;
    var loader = document.getElementById('loader');

    user_div.style.display = "none"; loader.style.display = "flex";

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {

        if(ajax.readyState === 4 && ajax.status === 200) {

            if(ajax.response !== -1) {
                document.cookie = "username="+ajax.response;
                loader.style.display = "none";
                stage();
            }

        }

    };

    ajax.open('GET', 'login.php?email='+email, true);
    ajax.send();

}

function passwordSignIn() {
    var pass_div = document.getElementById('password');
    var password = document.getElementById('pass').value;
    var loader = document.getElementById('loader');
    pass_div.style.display = "none"; loader.style.display = "flex";

    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {

        if(ajax.readyState === 4 && ajax.status === 200) {
            loader.style.display = "none";
            if(cookies('pass_error') <= 0) {
                redirect('index.php');
            } else {
                alert(cookies('pass_error'));
                pass_div.style.display = "block";
                document.getElementById('pass').value = '';
                stage();
            }

        }

    };

    ajax.open('POST', 'pass_login.php', true);
    ajax.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
    ajax.send('pass='+password);

}