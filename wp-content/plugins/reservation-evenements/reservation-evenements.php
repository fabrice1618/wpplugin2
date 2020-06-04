<?php
/**
 * Plugin Name: reservation-evenements
 * Description: Reservation aux evenements pour les abonnés
 */
defined( 'ABSPATH' ) or die( 'No direct access' );

///////// Partie 1: Affichage du formulaire des réservations
function reservation_evenements_getform( $postId ) {

    if (is_user_logged_in()) {
        // Affichage du formulaire contenant 2 champs caches et un bouton visible

        $user = wp_get_current_user();      // Utilisateur actuellement connecté à wordpress

        if ( haveReservation( $postId, $user->user_email ) ) {
            $sBoutonLabel = "Annuler réservation";
        } else {
            $sBoutonLabel = "Réserver";
        }

        echo('
        <form action="'.get_site_url() . '/evenements/'.'" method="POST">'.
            wp_nonce_field('reserver', 'reservation-verif').'
           <input type="hidden" name="id-evenement" value="'.$postId.'" />
            <p>
                <input id="submit" type="submit" name="reservation" class="submit" value="'.$sBoutonLabel.'" />
            </p>
        </form>
        ');
    
    } else {
        echo "<p>Connectez-vous pour pouvoir réserver</p>";
    }

}

function haveReservation( $nPostID, $sEmail )
{
    $bReturn = false;

    // Lecture des reservations enregistrées dans les meta données
    $aListeReservation = json_decode(get_post_meta($nPostID, 'reservations-evenement', true), true);

    if ( $aListeReservation !== null ) {
        if ( in_array($sEmail, $aListeReservation) ) {
            $bReturn = true;
        }
    }

    return($bReturn);
}


///////// Partie 2: traitement du formulaire des réservations
add_action('template_redirect', 'reservation_evenements_reserver'); // Action pour traiter le formulaire de reservation

function reservation_evenements_reserver() {

    if (isset($_POST['id-evenement']) && isset($_POST['reservation-verif']))  {

        // Verifie que la requete est valide verification token CSRF
        if (wp_verify_nonce($_POST['reservation-verif'], 'reserver')) {

            $user = wp_get_current_user();      // Utilisateur actuellement connecté à wordpress
            $sEmail = $user->user_email;        // Email de l'utilisateur connecte

            $aListeReservation = json_decode(get_post_meta($_POST['id-evenement'], 'reservations-evenement', true), true);
            if ($aListeReservation===null) {
                // C'est la premiere reservation, creer le tableau
                $aListeReservation = [$sEmail];
            } else {
                if ( !in_array($sEmail, $aListeReservation) ) {
                    // Si l'utilisateur n'as pas deja reserve, alors l'ajouter a la liste
                    array_push($aListeReservation, $sEmail);
                } else {
                    // Il existe deja une reservation alors il faut annuler la reservation
                    foreach ($aListeReservation as $key => $sEmailReservation) {
                        if ( $sEmailReservation === $sEmail ) {
                            // Effacer la ligne dans le tableau
                            unset( $aListeReservation[$key ]);
                        }
                    }
                }
            }

            // Mise a jour de la liste des reservations dans les meta donnees
            update_post_meta( $_POST['id-evenement'], 'reservations-evenement', json_encode($aListeReservation) );
        }
    }

}

///////// Partie 3: Ajout du champ custom 'reservations-evenement' à l'API
function rest_add_reservations_evenement() {
    register_rest_field( 'f1618_evenements',
        'reservations-evenement',
        array(
            'get_callback'  => 'rest_get_reservations_evenement',
            'update_callback'   => null,
            'schema'            => null,
         )
    );
}
// recupere la date-evenement dans les meta données du post
function rest_get_reservations_evenement( $object, $field_name, $request ) {
    return(get_post_meta($object['id'], 'reservations-evenement', true));
}
add_action( 'rest_api_init', 'rest_add_reservations_evenement' );

// Pour verifier si le plugin est activé
// Si cette fonction existe, alors c'est que le plugin est activé
function reservation_evenements_pluginactif( $post_object ) {
}
