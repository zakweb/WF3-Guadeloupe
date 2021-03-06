<?php

//         ##################################################
//         #                                                #
// ##########            Styles CSS et Scripts JS          ##########
//         #                                                #
//         ##################################################

/**
 * Fonction permettant de charger les styles CSS de notre thème WP.
 */
function photogrape_enqueue_style() {
    // -- Bootstrap | wp_enqueue_style permet de déclarer une feuille CSS pour notre thème dans WP.
    wp_enqueue_style( 'bootstrap-cdn', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, '4.3.1' );

    // -- WP Style | get_template_directory_uri() pointe vers le dossier de mon theme.
    wp_enqueue_style( 'photogrape-css', get_stylesheet_uri(), false ); // Uniquement pour style.css
    
    // Pour d'autres fichiers CSS dans mon thème
    // wp_enqueue_style( 'exemple-css', get_template_directory_uri() . '/exemple.css', false );

    // -- Google Font
    wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Dancing+Script|Great+Vibes|Roboto+Condensed:400,700&amp;display=swap', false );
}
 
/**
 * Fonction permettant de charger les scripts de notre thème WP.
 */
function photogrape_enqueue_script() {
    // -- jQuery | wp_enqueue_script permet de déclarer un fichier JS pour notre thème dans WP.
    wp_enqueue_script( 'jquery-slim', '//code.jquery.com/jquery-3.3.1.min.js', false, '3.3.1' );

    // -- Popper JS
    wp_enqueue_script( 'popper-js', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', false, '1.14.7' );

    // -- Bootstrap JS
    wp_enqueue_script( 'bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', false, '4.3.1' );
}
 
add_action( 'wp_enqueue_scripts', 'photogrape_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'photogrape_enqueue_script' );

//         ##################################################
//         #                                                #
// ##########            Fonctionnalités du Thèmes         ##########
//         #                                                #
//         ##################################################

# Image de logo personnalisable
add_theme_support( 'custom-logo', array(
	'height'      => 155,
	'width'       => 160,
	'flex-height' => false,
	'flex-width'  => false,
	'header-text' => array( 'site-title', 'site-description' ),
) );

# Activation du Menu Wordpress pour le thème
function register_photogrape_menu() {
    register_nav_menu('photogrape-menu',__( 'Photogrape Menu' ));
}
add_action( 'init', 'register_photogrape_menu' );

# Image du thème personnalisable
$args = array(
	'width'         => 1920,
	'height'        => 1080,
	'default-image' => get_template_directory_uri() . '/image/photographe.jpg',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

# Custom Background
add_theme_support( 'custom-background' );

# Création d'un CUSTOM POST TYPE
# https://wordpress.org/support/article/post-types/
# https://gist.github.com/creativembers/6577149
add_action( 'init', 'create_photogrape_type' );
function create_photogrape_type() {
    register_post_type( 'photogrape_type', array(
        'labels' => array(
            'name'  => 'Photogrape Posts',
            'singular_name' => 'Photogrape Post'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-quote',
        'has_archive' => false,
        'supports' => array(
			'title', 'editor', 'thumbnail',
		),
    ) );
}

add_theme_support( 'post-thumbnails' );
add_image_size( 'photogrape-size', 370, 245, true );

//         ##################################################
//         #                                                #
// ##########           Positions pour les Widgets         ##########
//         #                                                #
//         ##################################################

add_action( 'widgets_init', 'photogrape_widgets_init' );
function photogrape_widgets_init() {

    register_sidebar( array(
        'name' => 'Partenaires',
        'id' => 'partner',
        'description' => 'Widget pour le placement des logos partenaires',
        'before_widget' => '<div id="%1$s partner" class="%2$s col-12 partenaires">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ) );
    

}