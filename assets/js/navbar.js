const $ = require("jquery");
const $button  = document.querySelector('#sidebar-toggle');
const $wrapper = document.querySelector('#wrapper');

$button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
});

let nav = '.sidebar-nav li a';

$(function(){
    $(nav).filter(function(){return this.href===location.href}).parent().addClass('active').siblings().removeClass('active')
    $(nav).click(function(){
        $(this).parent().addClass('active').siblings().removeClass('active')
    })
});
