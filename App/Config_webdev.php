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
    //const BASE_SERVEUR = 'http://localhost:8012/projetWeb1/php-mvc-master/public/'; //DEV
    const BASE_SERVEUR = 'https://e0239070.webdev.cmaisonneuve.qc.ca/stampee/public/'; //PROD
  
    /**
     * Database host
     * @var string
     */
    //const DB_HOST = 'localhost'; //DEV
   const DB_HOST = 'localhost'; //PROD

    /**
     * Database name
     * @var string
     */
   // const DB_NAME = 'stampee'; //DEV
    const DB_NAME = 'e0239070'; //PROD

    /**
     * Database user
     * @var string
     */
    //const DB_USER = 'root'; //DEV
   const DB_USER = 'e0239070'; //PROD

    /**
     * Database password
     * @var string
     */
    //const DB_PASSWORD = ''; //DEV
    const DB_PASSWORD = '4XhID4YoZkyycWCVsFun'; //PROD

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
}
