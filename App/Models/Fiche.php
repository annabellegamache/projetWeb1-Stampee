<?php

namespace App\Models;

use PDO;

/**
 * Modèle Fiche
 *
 * PHP version 7.0
 */
class Fiche extends \Core\Model
{

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

    
    /**
     * Obtenir une publication spécifique de l'utilisateur sous forme de tableau associatif
     *
     * @return array
     */
    public static function getOne($id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre
                            LEFT JOIN enchere
                            ON timbre.tim_id = enchere.enc_tim_id
                            RIGHT JOIN image
                            ON timbre.tim_id = image.tim_id
                            WHERE timbre.tim_id ='.$id.'');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ajoute la mise de l'utilisateur dans la BD
     *
     * @return $id l'identification du dernier ajout
     */
    public static function insert($data)
    {
        $db = static::getDB();

        $sql = 'INSERT INTO uti_mise_enc (mise_id, enc_id, uti_id, uti_mise_date, uti_enc_prix) 
                VALUES(NULL, :enc_id, :uti_id, NOW(), :uti_enc_prix)';
           

        $statement = $db->prepare($sql);
       
        $statement->execute([
            ':enc_id' => $data['enc_id'],
            ':uti_id' => $data['userId'], 
            ':uti_enc_prix' => $data['enc_prix']
        ]);
        $id = $db->lastInsertId();
        return $id;
           
    }

   /**
     * Modifie le prix de l'enchere après la mise
     *
     * 
    */

    public static function modif($data)
    {
        $db = static::getDB();

        /*update prix enchere*/
        $sql = 'UPDATE enchere
                SET enc_prix=:enc_prix
                WHERE enc_id=:enc_id';
          
        $statement = $db->prepare($sql);

        $statement->execute([
                    ':enc_prix' => $data['enc_prix'],
                    ':enc_id' => $data['enc_id']

        ]);
    }

/**
     * Modifie le prix de l'enchere après la mise
     *
     * @return $count le nombre d'enregistrements
    */

    public static function getCount($id)
    {
        $db = static::getDB();

        
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(enchere.enc_id) 
                            FROM uti_mise_enc
                            LEFT JOIN enchere
                            ON enchere.enc_id = uti_mise_enc.enc_id
                            WHERE enchere.enc_tim_id ='.$id.'');
        $count = $stmt->fetchColumn();
          
        return $count;

    }
}
