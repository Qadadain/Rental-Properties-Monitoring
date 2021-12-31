$("#burger-button").click(function() {
    $("#burger-menu").toggle();
});

$("#user-menu-button").click(function() {
    $("#user-menu-content").toggle();
});

$("#add-button").click(function() {
    $("#add-content").toggle();
});

window.addEventListener('mouseup', function(event){
    const navbar = document.getElementById('burger-menu');
    const profile = document.getElementById( 'user-menu-content');
    const addDropdown = document.getElementById( 'add-content');
    if (event.target !== navbar && event.target.parentNode !== navbar){
        navbar.style.display = 'none'
    }
    if (event.target !== profile && event.target.parentNode !== profile){
        profile.style.display = 'none'
    }
    if (event.target !== addDropdown && event.target.parentNode !== addDropdown){
        addDropdown.style.display = 'none'
    }
});
