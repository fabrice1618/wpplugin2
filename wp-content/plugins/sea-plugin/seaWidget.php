<?php
//widget.php

/*
Plugin Name: Plugin WidgetSurf
Plugin URI: http://wordpress.org/plugins/widget/
Description: affichage de "Etat du surf et prévisions pour Pipline & Backdoor" pour le site https://www.tek2020lucile/
Version: 1.0
Author: Lucile Christmann
*/

class seaWidget extends WP_Widget   //déclaration de l'objet Widget cinéma qui hérite des finctionalités de l'objet de base "WP_Widget" fourni par WP
{
    public function __construct()
    {
        parent::__construct('seaWidget', 'Etat du surf et prévisions pour Pipline & Backdoor', array( 'description' => 'affichage des Etat du surf et prévisions pour Pipline & Backdoor à partir d\'une Url gérée par le site https://api.stormglass.io/v2/weather/point'));
       
    }
    
    public function widget($args, $instance)  //insertion de la partie HTML  en activant le fonction loadLib qui charge le bootsrap + le fichier JS
    { 
        $this->loadLib();
        echo '<h4>Niveau de la mer à Saint Jean de Luz</h4>';
        echo '<h5>Le 06/06/2020</h5>';
        echo '<table>
        <tr><th>Heure</th><th>Niveau de la mer</th></tr>';
        for ($i=0; $i < 25; $i++) { 
            echo('<tr><td>0h</td><td id="niv'.$i.'">---</td></tr>');
        }
    echo '</table>';
    }

    private function loadLib(){  //mise en place de cette fonction à l'intérieur de la class pour que WP ne fait appel à cette fonction en dehors de la class
        //wp_enqueue_script('seaWidget',plugins_url('js/plugin.js', __FILE__ ),array('jquery'));

        wp_enqueue_script('seaWidget',plugins_url('seaWidget.js', __FILE__ ));
    
    }

}

add_action('widgets_init', function(){register_widget('seaWidget');} );

