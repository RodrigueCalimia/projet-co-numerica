<?php
    // Initialisation des fonctions personnalisées du thème.
    

    // File d'attente des styles et des scripts
    add_action('wp_enqueue_scripts', 'add_theme_style');

    // Register menu locations
    add_action( 'init', 'register_my_menu', 0 );
    
    // custom query
    

    // Validate the username or email field before submitting
    add_action("login", 'process_custom_login_form');