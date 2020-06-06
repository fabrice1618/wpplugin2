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
        echo '<h4>Niveau de la mer à Saint de Luz</h4>';
        echo '<h5>Le 06/06/2020</h5>';
        echo '<table>
        <tr><th>Heure</th><th>Niveau de la mer</th></tr>
        <tr><td>0h</td><td id="niv0">---</td></tr>
        <tr><td>1h</td><td id="niv1">---</td></tr>
        <tr><td>2h</td><td id="niv2">---</td></tr>
        <tr><td>3h</td><td id="niv3">---</td></tr>
        <tr><td>4h</td><td id="niv4">---</td></tr>
        <tr><td>5h</td><td id="niv5">---</td></tr>
        <tr><td>6h</td><td id="niv6">---</td></tr>
        <tr><td>7h</td><td id="niv7">---</td></tr>
        <tr><td>8h</td><td id="niv8">---</td></tr>
        <tr><td>9h</td><td id="niv9">---</td></tr>
        <tr><td>10h</td><td id="niv10">---</td></tr>
        <tr><td>11h</td><td id="niv11">---</td></tr>
        <tr><td>12h</td><td id="niv12">---</td></tr>
        <tr><td>13h</td><td id="niv13">---</td></tr>
        <tr><td>14h</td><td id="niv14">---</td></tr>
        <tr><td>15h</td><td id="niv15">---</td></tr>
        <tr><td>16h</td><td id="niv16">---</td></tr>
        <tr><td>17h</td><td id="niv17">---</td></tr>
        <tr><td>18h</td><td id="niv18">---</td></tr>
        <tr><td>19h</td><td id="niv19">---</td></tr>
        <tr><td>20h</td><td id="niv20">---</td></tr>
        <tr><td>21h</td><td id="niv21">---</td></tr>
        <tr><td>22h</td><td id="niv22">---</td></tr>
        <tr><td>23h</td><td id="niv23">---</td></tr>
        <tr><td>24h</td><td id="niv24">---</td></tr>
    </table>';
    }

    private function loadLib(){  //mise en place de cette fonction à l'intérieur de la class pour que WP ne fait appel à cette fonction en dehors de la class
        //wp_enqueue_script('seaWidget',plugins_url('js/plugin.js', __FILE__ ),array('jquery'));

        wp_enqueue_script('seaWidget',plugins_url('seaWidget.js', __FILE__ ));
    
    }

}

add_action('widgets_init', function(){register_widget('seaWidget');} );

