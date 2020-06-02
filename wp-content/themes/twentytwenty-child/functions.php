<?php 

// Activation de la feuille de style du theme parent
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


// Création du "Custom Post Type" pour les événements
function f1618_evenements_init() {
    $args = array(
        'label' => 'Evenements',
        'public' => true,               // Données publiques
        'show_ui' => true,              // modifiables dans l'interface d'admin
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_rest' => true,         // Visible dans l'API
        'query_var' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array(
            'title',
            'editor',
            'date',
            'custom-fields',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'f1618_evenements', $args );
}
add_action( 'init', 'f1618_evenements_init' );