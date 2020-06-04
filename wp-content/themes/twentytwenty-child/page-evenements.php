<?php 

define( 'HTML_HEADER_START',    '<header class="entry-header has-text-align-center header-footer-group">
                                <div class="entry-header-inner section-inner medium">');
define( 'HTML_HEADER_END',      '</div></header>');

define( 'HTML_CONTENT_START',    '  <div class="post-inner thin ">
                                    <div class="entry-content">');
define( 'HTML_CONTENT_END',      '</div></div>');


get_header();

// Boucle principale
if( have_posts() ) : while( have_posts() ) : the_post(); 

    // Titre de la page
    echo HTML_HEADER_START;
    the_title('<h1 class="entry-title">', '</h1>'); // Titre de la page
    echo HTML_HEADER_END;

    echo HTML_CONTENT_START;
    the_content(); // Contenu de la page
    echo HTML_CONTENT_END;
    	
	$my_query = new WP_Query( array('post_type' => 'f1618_evenements', 'posts_per_page' => 5 ) );
	
	// Boucle personnalisée
	if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : 
		$my_query->the_post();

        // Affichage d'un evenement
        echo HTML_CONTENT_START;
        the_title('<h3>', '</h3>'); // Titre de chaque article
//		get_template_part( 'template-parts/featured-image' );

        the_content(); // Contenu de chaque article

            // Affiche la date et l'heure de l'evenement à partir du custom field
            $sDateEvenement = get_post_meta($post->ID, 'date-evenement', true);
            if (!empty($sDateEvenement) ) {
                echo '<div class="evenements-date"><p>Cet événement aura lieu le : '.$sDateEvenement.'</p></div>';
            } else {
                echo '<div class="evenements-date"><p>Non planifié</p></div>';
            }

        // Si le pludin est active, charger le formulaire de reservation
        if( function_exists('reservation_evenements_pluginactif')) {
            // Appel du plugin
            reservation_evenements_getform($post->ID);
        }

        echo HTML_CONTENT_END;
    

	endwhile; endif;
	wp_reset_postdata(); // On réinitialise les données


endwhile; endif;

get_footer();