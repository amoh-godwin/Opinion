/**
 * Created by CHARITY PRODUCTIONS on 9/12/2017.
 */

var modalState = true;

function modalToggle() {
    var menu = document.getElementById('menu');
    if(modalState) {
        menu.style.display = 'flex';
        menu.style.animation = 'modal-on 0.4s ease';
        modalState = !modalState;
    } else {
        menu.style.animation = 'modal-off 0.4s ease';
        setTimeout(function() {menu.style.display = 'none';}, 400);
        modalState = !modalState;
    }
}