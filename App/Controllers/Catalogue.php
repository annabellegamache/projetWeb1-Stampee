<?php

namespace App\Controllers;

use \Core\View;
use \App\Models;

/**
 * Catalogue controller
 *
 * PHP version 7.0
 */
class Catalogue extends \Core\Controller
{

    /**
     * Publier tous les enchères de la BD
     *
     * @return void
    */
    public function indexAction()
    {

        
        if(!isset($_SESSION['utilisateur'])) {
            $idUser = '';
       } else {
            $idUser = $_SESSION['utilisateur'];
       }

            \App\Models\Catalogue::updateDate();

            /*pour affichage dynamique des filtres de recherches*/
            $couleurs = \App\Models\Catalogue::getColor();
            $pays =   \App\Models\Catalogue::getPays();

            $timbres = \App\Models\Catalogue::getAll();  //chercher tous les timbres de la BD
            //print_r($timbres);
            
            View::renderTemplate('Catalogue/index.html', [
                'session' => $idUser,
                'base_serveur' => $this->base_serveur,
                'timbres' => $timbres,
                'couleurs' => $couleurs,
                'pays' => $pays,
                
            ]);
    }

    

    public function searchAction()
    {

        if(!isset($_SESSION['utilisateur'])) {
            $idUser = '';
       } else {
            $idUser = $_SESSION['utilisateur'];
       }
            $recherche = '%' . $_REQUEST["recherche"] . '%';
            $res = \App\Models\Catalogue::getRecherche($recherche);  //chercher tous les timbres de la BD
            //print_r($timbres);

            $count = $res[0];
            $timbres = $res[1];

            if($timbres == []){
                $msg = 'Aucun résultat trouvé';
            }else{
                $msg = $count . ' résultats trouvés';
            }
            $couleurs = \App\Models\Catalogue::getColor();
            $pays =   \App\Models\Catalogue::getPays();
            View::renderTemplate('Catalogue/index.html', [
                'session' => $idUser,
                'base_serveur' => $this->base_serveur,
                'timbres' => $timbres,
                'couleurs' => $couleurs,
                'pays' => $pays,
                'message' => $msg
                
            ]);
    }
    

    public function selectAction()
    {

        if(!isset($_SESSION['utilisateur'])) {
            $idUser = '';
       } else {
            $idUser = $_SESSION['utilisateur'];
       }

            if($_POST){
                //print_r($_POST);
                $timbres = \App\Models\Catalogue::getSome($_POST);  //chercher tous les timbres de la BD avec les info du post
            
                /*si pas de résultats*/
                if($timbres == []){
                    $msg = 'Aucun résultat trouvé';
                }else{
                    $msg = count($timbres) .' résultats';
                }

            } else {

                $enchereCar = $this->route_params['id'];
                $timbres = \App\Models\Catalogue::getSome($enchereCar);  //chercher tous les timbres de la BD avec les info de l'url
                $msg='';
            }
            $couleurs = \App\Models\Catalogue::getColor();
            $pays =   \App\Models\Catalogue::getPays();
            View::renderTemplate('Catalogue/index.html', [
                'session' => $idUser,
                'base_serveur' => $this->base_serveur,
                'timbres' => $timbres,
                'couleurs' => $couleurs,
                'pays' => $pays,
                'message' => $msg
                
            ]);
            
            
     
    }
}


