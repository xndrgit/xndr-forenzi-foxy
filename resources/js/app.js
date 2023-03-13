/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.addEventListener('resize', () => {
    if (document.body.getBoundingClientRect().width > 768) {
        $('#navbarSupportedContent').removeClass('show');
        $('#background-cover').fadeOut();
    }
});

(function ($) {
    $(function () {
        $('#toggle-nav-button').on('click', function () {
            if ($(this).hasClass('collapsed')) {
                $('#background-cover').fadeIn();
            } else {
                $('#background-cover').fadeOut();
            }
        });

        $('#background-cover').on('click', function () {
            $('#navbarSupportedContent').removeClass('show');
            $('#toggle-nav-button').addClass('collapsed');
            $('#toggle-nav-button').attr('aria-expanded', false);
            $(this).fadeOut();
        });
    });
})(jQuery);

