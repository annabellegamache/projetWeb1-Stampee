<?php

namespace App\Controllers;

use \Core\View;

/**
 * Accueil controller
 *
 * PHP version 7.0
 */
class Accueil extends \Core\Controller
{

    /**
     * Show the index page
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
        View::renderTemplate('Accueil/index.html', [
            'base_serveur' => $this->base_serveur,
            'session' => $idUser
        ]);
    }
}
