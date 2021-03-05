<?php get_header()?>

<?php 
    $pageTitle = get_the_title();
    if($pageTitle == 'Tableau de bord'){
        get_template_part( 'template-parts/content/content', 'dashboard');
    }
    if($pageTitle == 'Les Formations'){
        get_template_part( 'template-parts/listes/liste', 'formations');
    }
    if($pageTitle == 'Ajouter une formation'){
        get_template_part( 'template-parts/forms/create', 'formation');
    }
    if($pageTitle == 'Les Entreprises' || $pageTitle == 'Les OPCO'){
        get_template_part( 'template-parts/listes/liste', 'entreprises-opco');
    }
    if($pageTitle == 'Ajouter une entreprise'){
        get_template_part( 'template-parts/forms/create', 'entreprise-opco');
    }
    if($pageTitle == 'Les Utilisateurs'){
        get_template_part( 'template-parts/listes/liste', 'personnes');
    }
    if($pageTitle == 'Ajouter une personne'){
        get_template_part( 'template-parts/forms/create', 'personne');
    }
    if($pageTitle == 'Les Devis'){
        get_template_part( 'template-parts/listes/liste', 'devis');
    }
    if($pageTitle == 'Créer un devis'){
        get_template_part( 'template-parts/process/process', 'devis');
    }
    if($pageTitle == 'Les Sites Numerica'){
        get_template_part( 'template-parts/listes/liste', 'sites');
    }
    if($pageTitle == 'Ajouter un site'){
        get_template_part( 'template-parts/forms/create', 'site');
    }
    if($pageTitle == 'Administration'){
        get_template_part( 'template-parts/content/content', 'administration');
    }
    if($pageTitle == 'Les Projets'){
        get_template_part( 'template-parts/process/convertir', 'en-projet');
    }
    if($pageTitle == 'Créer un projet'){
        get_template_part( 'template-parts/process/process', 'projet');
    }
    if($pageTitle == 'Fiche site'){
        get_template_part( 'template-parts/single/fiche', 'site');
    }
?>

<?php get_footer(); ?>