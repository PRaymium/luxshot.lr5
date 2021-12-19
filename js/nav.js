var nav_burger = document.getElementById('nav-burger');
var nav_burger_lines = document.getElementsByClassName('burger-menu__line');

nav_burger.onclick = function () {
    nav_burger_lines[0].classList.toggle('active');
    nav_burger_lines[1].classList.toggle('active');
    nav_burger_lines[2].classList.toggle('active');

    let nav_menu = document.getElementById('nav-menu');
    nav_menu.classList.toggle('active');
    nav_burger.classList.toggle('active');
}