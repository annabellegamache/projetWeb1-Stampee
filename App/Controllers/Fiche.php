<?php

namespace App\Controllers;

use \Core\View;
use \App\Models;

/**
 * Fiche controller
 *
 * PHP version 7.0
 */
class Fiche extends \Core\Controller
{


public function setView($timbreInfo, $idTimbre)
{
    if(!isset($_SESSION['utilisateur'])) {
        $idUser = '';
    } else {
        $idUser = $_SESSION['utilisateur'];
    }
       /* gestion des dates */
       $dateEnchere  = new \DateTime($timbreInfo[0]['enc_date_fin'], new \DateTimeZone('America/Toronto'));

       $dateToday = new \DateTime(null, new \DateTimeZone('America/Toronto'));
       
       $dateDiff = $dateToday->diff($dateEnchere);
       
       $dateFinFormat = $dateEnchere->format("Y/m/d"); 
       $dateDiffFormat = $dateDiff->format("%d");
       $heureFinFormat = $dateEnchere->format("H:i:s");
       $timeZone = $dateEnchere->format("e");

       /* nombre de mise */
       $nbMise = \App\Models\Fiche::getCount($idTimbre); // donnée du timbre sélectionné

       /* afficahge */
       View::renderTemplate('Fiche/index.html', [
           'session' => $idUser,
           'base_serveur' => $this->base_serveur,
           'timbre' => $timbreInfo,
           'dateFin' => $dateFinFormat,
           'heureFin' => $heureFinFormat,
           'timeZone' => $timeZone,
           'temps' => $dateDiffFormat,
           'nbMise' => $nbMise
       ]);
}


    /**
     * Publier tous les enchères de la BD
     *
     * @return void
    */
    public function indexAction()
    {

       $idTimbre = $this->route_params['id'];

       $timbreUn = \App\Models\Fiche::getOne($idTimbre); // donnée du timbre sélectionné

       $this->setView($timbreUn, $idTimbre);
      
    }


   /**
     * Ajout dans la table de mise de la BD Modification du prix de l'enchère dont l'utlisateur à placer une mise 
     *
     * @return void
    */
    public function miseAction()
    {
        if(!isset($_SESSION['utilisateur'])) {
            // si utilisateur pas connecté on force la page login
           View::renderTemplate('Utilisateur/login.html', [
               'base_serveur' => $this->base_serveur
           ]);

       } else {
        
            $idUser = $_SESSION['utilisateur'];
            if(!empty($_POST)){

                
                //print_r($_POST);
                // ajout mise dans la BD
                $idAdded = \App\Models\Fiche::insert($_POST);

                //Modification du prix courant dans la table enchère
                if($idAdded){
                    \App\Models\Fiche::modif($_POST);
                    $idTimbre = $_POST['tim_id'];
                    $timbreUn = \App\Models\Fiche::getOne($idTimbre);
                    
                    /* afficahge */
                    $this->setView($timbreUn, $idTimbre);
                    
                }
               

                } //fin ajout
        

        }

    }
}

