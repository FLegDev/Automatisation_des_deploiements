<?php

function dequeue_scripts_on_homepage() {
    if (is_front_page()) {
        // Décharger le script googlesitekit-vendor
        wp_dequeue_script('googlesitekit-vendor');

        // Décharger le script wp-components
        wp_dequeue_script('wp-components');

        // Décharger le script googlesitekit-modules-analytics
        wp_dequeue_script('googlesitekit-modules-analytics');

        // Décharger le script googlesitekit-modules-analytics-4
        wp_dequeue_script('googlesitekit-modules-analytics-4');

        
        // Décharger le script divi-scripts
        wp_dequeue_script('divi-scripts');

        // Décharger le script googlesitekit-modules-search-console
        wp_dequeue_script('googlesitekit-modules-search-console');

        // Décharger le script react-dom
        wp_dequeue_script('react-dom');
    }
}
add_action('wp_enqueue_scripts', 'dequeue_scripts_on_homepage', 999);

function dequeue_scripts() {
    // Décharger le script googlesitekit-vendor
    wp_dequeue_script('googlesitekit-vendor');

    // Décharger le script wp-components
    wp_dequeue_script('wp-components');

    // Décharger le script googlesitekit-modules-analytics
    wp_dequeue_script('googlesitekit-modules-analytics');

    // Décharger le script googlesitekit-modules-analytics-4
    wp_dequeue_script('googlesitekit-modules-analytics-4');

    // Décharger le script googlesitekit-modules-search-console
    wp_dequeue_script('googlesitekit-modules-search-console');

    // Décharger le script divi-scripts (première version)
    wp_dequeue_script('divi-scripts');

    // Décharger le script divi-scripts (deuxième version)
    wp_dequeue_script('divi-scripts-2');

    // Décharger le script react-dom
    wp_dequeue_script('react-dom');

    // Décharger le script sticky-elements
    wp_dequeue_script('sticky-elements');

    // Décharger le script blocks
    wp_dequeue_script('wp-blocks');
}
add_action('wp_enqueue_scripts', 'dequeue_scripts', 999);

function dequeue_additional_scripts() {
    // Décharger le script wp-components
    wp_dequeue_script('wp-components');

    // Décharger le script googlesitekit-modules-search-console
    wp_dequeue_script('googlesitekit-modules-search-console');

    // Décharger le script divi-scripts (première version)
    wp_dequeue_script('divi-scripts');

    // Décharger le script divi-scripts (deuxième version)
    wp_dequeue_script('divi-scripts-2');

    // Décharger le script react-dom
    wp_dequeue_script('react-dom');

    // Décharger le script sticky-elements
    wp_dequeue_script('sticky-elements');

    // Décharger le script blocks
    wp_dequeue_script('wp-blocks');

    // Décharger le script swiper.min.js du plugin dg-carousel
    wp_dequeue_script('dg-carousel-swiper');
}
add_action('wp_enqueue_scripts', 'dequeue_additional_scripts', 999);

function enqueue_lazy_scripts() {
    if (is_front_page()) {
        // Enqueue le script googlesitekit-vendor avec l'attribut "defer"
        //wp_enqueue_script('googlesitekit-vendor', 'https://corak.fr/wp-content/plugins/google-site-kit/dist/assets/js/googlesitekit-vendor-72ba2465dc98ff321661.js', array(), '', true);
        //wp_script_add_data('googlesitekit-vendor', 'defer', true);

        // Enqueue le script wp-components avec l'attribut "defer"
        wp_enqueue_script('wp-components', 'https://corak.fr/wp-includes/js/dist/components.min.js?ver=3c00851678cbd33f07f4885b1662ed50', array(), '', true);
        wp_script_add_data('wp-components', 'defer', true);

        // Enqueue le script googlesitekit-modules-analytics avec l'attribut "defer"
        //wp_enqueue_script('googlesitekit-modules-analytics', 'https://corak.fr/wp-content/plugins/google-site-kit/dist/assets/js/googlesitekit-modules-analytics-51ec8fce536181385563.js', array(), '', true);
        //wp_script_add_data('googlesitekit-modules-analytics', 'defer', true);

        // Enqueue le script googlesitekit-modules-analytics-4 avec l'attribut "defer"
        //wp_enqueue_script('googlesitekit-modules-analytics-4', 'https://corak.fr/wp-content/plugins/google-site-kit/dist/assets/js/googlesitekit-modules-analytics-4-ac38f1fc50c49dea23c0.js', array(), '', true);
        //wp_script_add_data('googlesitekit-modules-analytics-4', 'defer', true);

        // Enqueue le script divi-scripts avec l'attribut "defer"
        wp_enqueue_script('divi-scripts', 'https://corak.fr/wp-content/themes/Divi/js/scripts.min.js?ver=6de2e71d4f2b28884e0e596444aa33e6', array(), '', true);
        wp_script_add_data('divi-scripts', 'defer', true);

        // Enqueue le script googlesitekit-modules-search-console avec l'attribut "defer"
        wp_enqueue_script('googlesitekit-modules-search-console', 'https://corak.fr/wp-content/plugins/google-site-kit/dist/assets/js/googlesitekit-modules-search-console-c0afcf1ae0fb3bd5dd88.js', array(), '', true);
        wp_script_add_data('googlesitekit-modules-search-console', 'defer', true);

        // Enqueue le script react-dom avec l'attribut "defer"
        wp_enqueue_script('react-dom', 'https://corak.fr/wp-includes/js/dist/vendor/react-dom.min.js?ver=6cc9f20227cd5cb8d3153933e1b9c11e', array(), '', true);
        wp_script_add_data('react-dom', 'defer', true);

        // Enqueue le script supplémentaire avec l'attribut "defer"
        wp_enqueue_script('additional-script', 'https://sibforms.com/forms/end-form/build/main.js', array(), '', true);
        wp_script_add_data('additional-script', 'defer', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_lazy_scripts', 999);

function dequeue_additional_scripts() {
    // Décharger le script components.min.js
    wp_dequeue_script('wp-components');

    // Décharger le script googlesitekit-modules-search-console
    wp_dequeue_script('googlesitekit-modules-search-console');

    // Décharger le premier script scripts.min.js de Divi
    wp_dequeue_script('divi-scripts');

    // Décharger le deuxième script scripts.min.js de Divi
    wp_dequeue_script('divi-scripts-2');

    // Décharger le script react-dom.min.js
    wp_dequeue_script('react-dom');

    // Décharger le script sticky-elements.js de Divi
    wp_dequeue_script('sticky-elements');

    // Décharger le script blocks.min.js
    wp_dequeue_script('wp-blocks');

    // Décharger le script swiper.min.js du plugin dg-carousel
    wp_dequeue_script('dg-carousel-swiper');
}
add_action('wp_enqueue_scripts', 'dequeue_additional_scripts', 999);

