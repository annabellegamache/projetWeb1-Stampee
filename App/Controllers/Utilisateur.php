<?php

namespace App\Controllers;

use \Core\View;
use \App\Models;

use App\Config;


/**
 * Utilisateur controller
 *
 * PHP version 7.0
 */
class Utilisateur extends \Core\Controller
{

    
    /**
     * Montre la page login
     *
     * @return void
     */
    public function loginAction()
    {
        
        View::renderTemplate('Utilisateur/login.html', [
            'base_serveur' => $this->base_serveur
        ]);
    }


    /**
     * Montre la page devenir membre
     *
     * @return void
     */
    public function devenirMembreAction()
    {
        
        View::renderTemplate('Utilisateur/devenirMembre.html', [
            'base_serveur' => $this->base_serveur
        ]);
    }


    public function addAction()
    {
       $erreur = false;
       if(!empty($_POST)){
        echo Config::BASE_SERVEUR;
        $liste = \App\Models\Utilisateur::insert($_POST);
           header("location:". Config::BASE_SERVEUR ."Utilisateur/login");//rediriger vers la page login
          //header("location:https://e0239070.webdev.cmaisonneuve.qc.ca/stampee/public/Utilisateur/login");
           exit();
       }else{
         $erreur = "Tous les champs sont requis pour l'inscription"; 
       }

        //si pas de post affiche le formulaire
        View::renderTemplate('Utilisateur/devenirMembre.html', [ 
            'base_serveur' => $this->base_serveur
        ]);
    }

    /**
     * Tente une connexion : si réussi, redirige vers Accueil/index
     * et sinon, réaffiche le formulaire de connexion avec un message d'erreur.
     */
    public function connexionAction()
    {
        $erreur = false;
        $courriel = $_POST['uti_courriel'];
        $mdp = $_POST['uti_mdp'];
        $utilisateur = \App\Models\Utilisateur::getOne($courriel);

        
       
        //$utilisateur[0]['uti_mdp'] accès au valeur du tableau...index 0..
        if(!$utilisateur || !password_verify($mdp, $utilisateur[0]['uti_mdp'])) {
            $erreur = "Mauvaise combinaison courriel/mot de passe";
        }
        
        else if($utilisateur[0]['uti_status'] == 0) {
            $erreur = "Ce compte n'a pas encore été activé : demandez à votre administrateur";
        }

        if(!$erreur) {
           
            
            $_SESSION['utilisateur'] = $utilisateur[0];
            //print_r ($_SESSION['utilisateur']);
           

            //ne s'écrit pas dans le url
            View::renderTemplate('Accueil/index.html', [
                'session' => $_SESSION['utilisateur'],
                'base_serveur' => $this->base_serveur
            ]); 
            
        }
        else { 
            View::renderTemplate('Utilisateur/login.html', [
                'erreur' => $erreur,
                'base_serveur' => $this->base_serveur
            ]);
        }
    }


    /**
     * Déconnecte l'utilisateur connecté et redirige vers la page d'accueil 
     * (formulaire de connexion)
     */
    public function deconnexionAction()
    {
        unset($_SESSION['utilisateur']);
        View::renderTemplate('Accueil/index.html', [
            'session' => '',
            'base_serveur' => $this->base_serveur
        ]);  
    }


}
