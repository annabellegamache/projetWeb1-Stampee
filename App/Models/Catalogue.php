<?php

namespace App\Models;

use PDO;

/**
 * Modèle Catalogue
 *
 * PHP version 7.0
 */
class Catalogue extends \Core\Model
{

    /**
     * Mettre à jour les catégorie des enchères (pasé-présente-future)
     *
     * 
     */
    public static function updateDate()
    {
        
        $db = static::getDB();

        $stmt1 = $db->query('UPDATE enchere 
                            SET enc_ce_cat_id = 0 
                            WHERE enc_date_debut < NOW() AND enc_date_fin > NOW()');                 
       
        $stmt2 = $db->query('UPDATE enchere 
                            SET enc_ce_cat_id = 1 
                            WHERE enc_date_fin < NOW()');

        $stmt3 = $db->query('UPDATE enchere 
                             SET enc_ce_cat_id = 2 
                             WHERE enc_date_debut > NOW()');
    }

    /**
     * Obtenir tous les publication de l'utilisateur sous forme de tableau associatif
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre
                             LEFT JOIN enchere
                            ON timbre.tim_id = enchere.enc_tim_id
                            RIGHT JOIN image
                            ON timbre.tim_id = image.tim_id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSome($data)
    {
        /* validation des donnée */
        if($_POST){
            if(!isset($data['enc_ce_cat_id'])) $data['enc_ce_cat_id']=NULL;
            if(!isset($data['tim_condition'])) $data['tim_condition']=NULL;
            if(!isset($data['tim_date_creation'])) $data['tim_date_creation']=NULL;
            if(!isset($data['tim_pays'])) $data['tim_pays']=NULL;
            if(!isset($data['tim_couleur'])){
                $couleur=NULL;
            } else {
                $couleur = implode(',', $data['tim_couleur']);  
            }
            if(!isset($data['tim_certifie'])) $data['tim_certifie']=NULL;
            
            $db = static::getDB();
            $sql = ('SELECT * FROM timbre
                                LEFT JOIN enchere
                                ON timbre.tim_id = enchere.enc_tim_id
                                RIGHT JOIN image
                                ON timbre.tim_id = image.tim_id
                                WHERE enc_ce_cat_id=:enc_ce_cat_id
                                OR tim_couleur IN (:couleur)
                                OR tim_pays=:tim_pays
                                OR tim_date_creation=:tim_date_creation
                                OR tim_condition=:tim_condition
                                OR tim_certifie=:tim_certifie
                                ');

            $stmt = $db->prepare($sql);
        
            
            $stmt->execute([
                    ':enc_ce_cat_id' => $data['enc_ce_cat_id'],
                    ':couleur' => $couleur, 
                    ':tim_pays' => $data['tim_pays'],
                    ':tim_condition' => $data['tim_condition'],
                    ':tim_date_creation' => $data['tim_date_creation'],
                    ':tim_certifie' => $data['tim_certifie']   
                ]);
            /* if(!$stmt->rowCount()){
                return false; #retourne false si pas de resultat.
                }*/
        } else {

            $db = static::getDB();
            $sql = ('SELECT * FROM timbre
                                LEFT JOIN enchere
                                ON timbre.tim_id = enchere.enc_tim_id
                                RIGHT JOIN image
                                ON timbre.tim_id = image.tim_id
                                WHERE enc_ce_cat_id=:enc_ce_cat_id
                                ');

            $stmt = $db->prepare($sql);
        
            
            $stmt->execute([
                    ':enc_ce_cat_id' => $data   
                ]);

        }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result);
            return $result;
    }


    /**
     * Obtenir tous les couleurs des timbre de la BD
     *
     * @return array
     */
    public static function getColor(){
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre
                             GROUP BY tim_couleur');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir tous les pays des timbre de la BD
     *
     * @return array
     */
    public static function getPays(){
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre
                             GROUP BY tim_pays');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public static function getRecherche($recherche)
    {
        $db = static::getDB();
        //print_r($recherche);
            $sql = 'SELECT * FROM timbre
                    LEFT JOIN enchere
                    ON timbre.tim_id = enchere.enc_tim_id
                    RIGHT JOIN image
                    ON timbre.tim_id = image.tim_id
                    WHERE tim_nom LIKE ":recherche"
                    OR timbre.tim_id LIKE "'. $recherche .'"
                    OR timbre.tim_id LIKE "'. $recherche .'"
                    OR enc_nom LIKE "'. $recherche .'"
                    OR enc_id LIKE "'. $recherche .'"
                    OR tim_description LIKE "'. $recherche .'"
                    OR tim_date_creation LIKE "'. $recherche .'"
                    OR tim_pays LIKE "'. $recherche .'"
                    OR tim_couleur LIKE "'. $recherche .'"
                    OR tim_date_creation LIKE "'. $recherche .'"
                    ';

            $stmt = $db->prepare($sql);

            //bug j'ai du mettre la variable direct dans la requete...
            $stmt->execute([
                ':recherche' => $recherche  
            ]);

            $count = ($stmt->rowCount());
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tab = [$count, $result];
            return $tab;

            
    }


    


}
