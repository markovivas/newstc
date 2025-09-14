/**
 * Live-previews para o Customizer do WordPress.
 */
(function ($) {
    "use strict";

    // Título do Hero
    wp.customize('hero_title', function (value) {
        value.bind(function (to) {
            $('.hero-content h1').text(to);
        });
    });

    // Descrição do Hero
    wp.customize('hero_description', function (value) {
        value.bind(function (to) {
            $('.hero-content p').text(to);
        });
    });

    // Você pode adicionar os botões aqui também, se desejar.

})(jQuery);