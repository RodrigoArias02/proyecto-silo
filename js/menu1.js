let menuToggle = document.querySelector('.menu-toggle');
let menuToggleicon = document.querySelector('.menu-toggle i');
let menu = document.getElementById('menu');

menuToggle.addEventListener('click', e=>{
    menu.classList.toggle('show');
})
