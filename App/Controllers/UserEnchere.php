<?php

namespace App\Controllers;

use \Core\View;
use \App\Models;

/**
 * UserEnchere controller
 *
 * PHP version 7.0
 */
class UserEnchere extends \Core\Controller
{

    public $table;

    /**
        * Fonction qui établie la vue et initilise les variables
        *
        * @return void
    */
    
    public function setIndexView($panel, $idTimbre, $msg)
    {

        if(!isset($_SESSION['utilisateur'])) {
            // si utilisateur pas connecté on force la page login
           View::renderTemplate('Utilisateur/login.html', [
               'base_serveur' => $this->base_serveur
           ]);

       } else {
            $idUser = $_SESSION['utilisateur']['uti_id'];
            $option = $panel; // tab content par défaut au chargement
            $timbres = \App\Models\UserEnchere::getAll($idUser);  //chercher tous les publications timbres de l'utilisateurs
            $timbreUn = NULL;

            if($idTimbre){
                $timbreUn = \App\Models\UserEnchere::getOne($idUser, $idTimbre);  //chercher le timbre de l'utilisateurs
            }

         
            View::renderTemplate('UserEnchere/index.html', [
                'session' => $_SESSION['utilisateur'],
                'base_serveur' => $this->base_serveur,
                'timbres' => $timbres,
                'tim' => $timbreUn,
                'message' => $msg,
                'panel' => $option
            ]);
        }
    }
    
    /**
     * Détecte si utilisateur est connecté et vue pour publier des enchères/timbres
     *
     * @return void
    */
    public function indexAction()
    {
        
        if(!isset($_SESSION['utilisateur'])) {
             // si utilisateur pas connecté on force la page login
            View::renderTemplate('Utilisateur/login.html', [
                'base_serveur' => $this->base_serveur
            ]);

        } else {
            $this->setIndexView('option1', NULL, '');
        }
    }

    

   /**
     * Réinitialise la vue de l'onglet 'mes publications'
     *
     * @return void
    */
    public function selectAction()
    {
        if(!isset($_SESSION['utilisateur'])) {
            // si utilisateur pas connecté on force la page login
           View::renderTemplate('Utilisateur/login.html', [
               'base_serveur' => $this->base_serveur
           ]);

       } else {
        
            //print_r($_POST['idTimbre']);
            if ($_POST['idTimbre']){
                $id = $_POST['idTimbre'];
                //print_r($_POST);
                $this->setIndexView('option3', $id, '');
            }else{
                $this->setIndexView('option3', NULL, '');
            }
       } 
    }


     /**
     * Ajout enchères/timbres/images è la BD
     *
     * @return void
     */
    public function addAction()
    {
        if(!isset($_SESSION['utilisateur'])) {
            // si utilisateur pas connecté on force la page login
           View::renderTemplate('Utilisateur/login.html', [
               'base_serveur' => $this->base_serveur
           ]);

       } else {
        
            if(!empty($_POST)){

                //print_r($_POST);

                $id = NULL; 
                $table = $_POST['table'];


                
                // ajout timbre ou enchère
                $idAdded = \App\Models\UserEnchere::insert($_POST, $table, $id, []);
                
                /*ajouter l'image à la suite de l'ajout du timbre*/
                if( $table == 'timbre'){
                    $table = 'image';
                    $id = \App\Models\UserEnchere::insert($_POST, $table, $idAdded, $_FILES['img_tim']);

                    //info image timbre
                    $fichier = $_FILES['img_tim']['tmp_name'];
                    $name = $_FILES['img_tim']['name'];
                    
                    //copie le fichier dans un dossier placer à la racine du serveur
                    if (move_uploaded_file($fichier, "images/$name")){
                        $msg = "Le timbre : ".$_POST['tim_nom']." a bien été ajouté";  
                    } else {
                        $msg = "Un problème est survenu lors du téléversement de l'image";
                        
                    }

                    $option = 'option1';

                } elseif ($table == 'enchere') {
                    $msg = "L'enchère : ".$_POST['enc_nom']." a bien été ajouté";
                    $option = 'option2';
                    $id = $_POST['enc_tim_id'];

                } //fin ajout 

                $this->setIndexView($option, $id, $msg); 
            }
        }       
    }

   
   /**
     * Supprimer une enchère/timbre de la bd
     *
     * @return void
     */
    public function deleteAction()
    {
        
        if(!isset($_SESSION['utilisateur'])) {
            // si utilisateur pas connecté on force la page login
           View::renderTemplate('Utilisateur/login.html', [
               'base_serveur' => $this->base_serveur
           ]);

       } else {
                $id = $_POST['tim_id'];
                $nomTimbre = $_POST['tim_nom'];
                $nomEnchère = $_POST['enc_nom'];
                $timbreDelete = \App\Models\UserEnchere::supprime($id);
                $msg = "Le timbre  ".$nomTimbre." et l'enchère ".$nomEnchère." ont bien été supprimés"; 
                $this->setIndexView('option3', NULL, $msg);     
            }
       }
    

   /**
     * Modifie enchère/timbre/images de la bd
     *
     * @return void
     */
    public function updateAction()
    {
        if(!isset($_SESSION['utilisateur'])) {
            // si utilisateur pas connecté on force la page login
           View::renderTemplate('Utilisateur/login.html', [
               'base_serveur' => $this->base_serveur
           ]);

       } else {
            $id =$_POST['tim_id'];
            $msg = '';
            //print_r($_POST);

            
            //gestion image 
           // print_r($_FILES['img_tim']['name']);

            if($_FILES['img_tim']['name']){
                $fichier = $_FILES['img_tim']['tmp_name'];
                $nameImg = $_FILES['img_tim']['name'];
                $nameImgOld = $_POST['img_nom_old']; 

               if(move_uploaded_file($fichier, "images/$nameImg")){
                $msg = "La modification a été apportée avec succès";
                $file_to_delete = "images/$nameImgOld";
                //print_r($file_to_delete);
                //unlink($file_to_delete);
               } else if($_FILES['img_tim']['error'] != 0 && $_FILES['img_tim']['error'] != 2) { //donnait toujours 2 malgré un MAXFIL très élévé...
                
                $msg = "Un problème est survenu au téléversement de l'image";
               } else {
                //print_r($_FILES['img_tim']['error']);
                $msg = "La modification a été apportée avec succès";
               }
            }else{
                $nameImg = NULL;
                $fichier = NULL;
            }

            \App\Models\UserEnchere::modifie($_POST, $fichier, $nameImg);
            
            $this->setIndexView('option3', $id, $msg);

        }
    }    
}