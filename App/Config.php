<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{
     /**
     * URL de base du serveur
     * @var string
     */
    const BASE_SERVEUR = 'http://localhost:8012/projetWeb1/php-mvc-master/public/'; //DEV
    
    // <base href="{{ constant('BASE_SERVEUR') }}"> 
    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost'; //DEV
   

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'stampee'; //DEV
    

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root'; //DEV
   

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = ''; //DEV
    

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
}
