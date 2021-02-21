<?php get_header(); ?>
<?php
    // Code PHP pour afficher le résultat dans ma page reception.php

    $titreContenu = $_GET['titreContenu'];

    if($titreContenu == 'Les Sites Numerica'){   
        get_template_part( 'template-parts/forms/update', 'site');
    }

    if($titreContenu == 'Les Formations'){   
        get_template_part( 'template-parts/forms/update', 'formation');
    }

    if($titreContenu == 'Les Entreprises' || $titreContenu == 'Les OPCO'){   
        get_template_part( 'template-parts/forms/update', 'entreprise-opco');
    }
?>

<?php get_footer(); ?>