/**
 * Created by CHARITY PRODUCTIONS on 7/15/2017.
 */
function setImage() {

    var image_name = document.getElementById('i_frame');
    var value_string = image_name.getAttribute('value');
    var parlx_ele = document.getElementById('parlx');

    if(value_string != null) {
        parlx_ele.style.backgroundImage = 'url('+value_string+')';
        clearInterval(the_interval);
    } else {
        var the_interval = setInterval(setImage, 500);
    }
}

function unHide(id) {
    var doc = document.getElementById(id);
    doc.style.display = "flex";
}