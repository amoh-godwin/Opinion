/**
 * Created by CHARITY PRODUCTIONS on 7/15/2017.
 */
function setImage() {

    var image_name = document.getElementById('i_frame');
    var value_string = image_name.getAttribute('value');
    var parlx_ele = document.getElementById('parlx');

    if(value_string !== null) {
        parlx_ele.style.backgroundImage = 'url('+value_string+')';
        clearInterval(the_interval);
    } else {
        var the_interval = setInterval(setImage, 500);
    }
}

function getImage(e) {
    var input_file = document.getElementById('file');
    var parlx = document.getElementById('parlx');
    var hidden = document.getElementById('hidden');
    var d = new Date();
    var fr = new FileReader();

    fr.readAsDataURL(input_file.files[0]);
    fr.onloadend = function (e) {
        var dataUrl = e.target.result;
        var splits = dataUrl.split('64,/');
        var base64_only = splits[1];
        parlx.style.backgroundImage = "url('" + dataUrl + "')";
        hidden.innerHTML = dataUrl;
        var dir_and_name = input_file.value.split('\\');
        var len = dir_and_name.length - 1;
        var ori_name = dir_and_name[len];
        var name = ori_name;
        alert(name);
        document.cookie = "imageName=" + encodeURI(name);
    }
    closeModal();

}