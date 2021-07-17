(function ($) {
    "use strict";

    $(window).on('load', function () {
        /**
         * Modal dialog for Login and Register
         */
        var loginModal = $('#login-modal'),
            modalSections = loginModal.find('.modal-section');

        $('.activate-section').on('click', function (event) {
            var targetSection = $(this).data('section');
            modalSections.slideUp();
            loginModal.find('.' + targetSection).slideDown();
            event.preventDefault();
        });
    });
})(jQuery);