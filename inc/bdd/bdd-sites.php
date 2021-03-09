<?php   
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_listeformation contenant les formations
    $lesSites = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
?>