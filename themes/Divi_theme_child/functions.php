<?php
/*activation thème */

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_script');

//prise en compte de ma nouvelle feuille de style par mon thème enfant
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/customLogin/loginStyle.css' );
   }
   add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

//prise en compte de ma feuille de script par mon thème enfant

   function custom_enqueue_script()
{
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js');
}

/*----- Déchargement du script sur ma page d'accueil et -----*/ 
function dequeue_scripts_on_homepage() {
    if (is_front_page()) {
        $scripts = array(
            'googlesitekit-vendor',
            'wp-components',
            'googlesitekit-modules-analytics',
            'googlesitekit-modules-analytics-4',
            'divi-scripts',
            'googlesitekit-modules-search-console',
            'react-dom'
        );

        foreach ($scripts as $script) {
            wp_dequeue_script($script);
        }
    }
}
add_action('wp_enqueue_scripts', 'dequeue_scripts_on_homepage', 999);

function dequeue_scripts() {
    $scripts = array(
        'wp-components',
        'googlesitekit-modules-search-console',
        'divi-scripts',
        'divi-scripts-2',
        'react-dom',
        'sticky-elements',
        'wp-blocks',
        'dg-carousel-swiper'
    );

    foreach ($scripts as $script) {
        wp_dequeue_script($script);
    }
}
add_action('wp_enqueue_scripts', 'dequeue_scripts', 999);

function enqueue_lazy_scripts() {
    if (is_front_page()) {
        $scripts = array(
            'wp-components' => 'https://corak.fr/wp-includes/js/dist/components.min.js?ver=3c00851678cbd33f07f4885b1662ed50',
            'googlesitekit-modules-search-console' => 'https://corak.fr/wp-content/plugins/google-site-kit/dist/assets/js/googlesitekit-modules-search-console-c0afcf1ae0fb3bd5dd88.js?ver=8aac67ad3fecae9ddb6e10146e2e982a'
        );

        foreach ($scripts as $handle => $src) {
            wp_enqueue_script($handle, $src, array(), '', true);
            wp_script_add_data($handle, 'defer', true);
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_lazy_scripts', 999);


/*---- longueur de l'extrait ------*/
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function custom_excerpt_length($length)
{
    // Nombre de caractères à retourner pour la longueur de l'extrait
    return 100;
}
/*----- Désactiver les flux rss ---*/
function fb_disable_feed() {
wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);


/*------- Ajout de types de fichiers -----*/

function my_myme_types($mime_types){
$mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
$mime_types['webp'] = 'image/webp'; //Adding webp extension
$mime_types['psd'] = 'image/vnd.adobe.photoshop'; //Adding photoshop files
return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);
/****------------ Shortcodes--------- */
function categories_list_func($atts)
{
    $categories = get_the_category();

    if ($categories) {
        foreach ($categories as $category) {
            $output .= '<li>' . $category->cat_name . '</li>';
        }
        $second_output = trim($output);
    }
    $return_string = '<ul>' . $second_output . '</ul>';

    return $return_string;

} // END Categories
add_shortcode('categories-list', 'shortcode_categorie');

// Permet de masquer la version de WordPress et le script
remove_action("wp_head", "wp_generator");
function supprimer_versions($src) {
    if (strpos($src, 'ver=')) {
        $parts = explode('?ver=', $src);
        $ver = md5(wp_salt('nonce') . $parts[1]);
        $src = $parts[0] . '?ver=' . $ver;
    }
    return $src;
}
add_filter('script_loader_src', 'supprimer_versions', 15, 1);
add_filter('style_loader_src', 'supprimer_versions', 15, 1);

/* Remplacement du gravatar par défaut */
add_filter('avatar_defaults', 'new_default_avatar');

function new_default_avatar($avatar_defaults)
{
    //Set the URL where the image file for your avatar is located
    $new_avatar_url = 'https://corak.fr/wp-content/uploads/2020/06/dummy-profile.png';
    //Set the text that will appear to the right of your avatar in Settings>>Discussion
    $avatar_defaults[$new_avatar_url] = 'default';
    return $avatar_defaults;
}
/*---Fil d'Ariane ---*/
function custom_breadcrumbs_shortcode() {
    if (is_front_page()) {
        return ''; // Retourne une chaîne vide si vous êtes sur la page d'accueil
    }

    $breadcrumbs = '';

    if (function_exists('yoast_breadcrumb')) {
        ob_start();
        yoast_breadcrumb();
        $breadcrumbs = ob_get_clean();
    }

    if (is_page()) {
        $ancestors = get_ancestors(get_the_ID(), 'page');
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestor) {
            $breadcrumbs .= '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a> &gt; ';
        }

        $breadcrumbs .= '<span class="current-page">' . get_the_title() . '</span>';
    }

    return '<div class="breadcrumbs">' . $breadcrumbs . '</div>';
}
add_shortcode('custom_breadcrumbs', 'custom_breadcrumbs_shortcode');
