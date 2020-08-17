var menu = $('#main-nav');
var menuOpen = $('#menu-open');
var menuClose = $('#menu-close');

menuClose.on("click", function(e) {
    menu.hasClass("is-open") ? menu.removeClass("is-open") : menu.addClass("is-open");
});
menuOpen.on("click", function(e) {
    menu.hasClass("is-open") ? menu.removeClass("is-open") : menu.addClass("is-open");
});