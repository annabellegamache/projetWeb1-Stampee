<?php

namespace App\Models;

use PDO;


/**
 * Modèle Utilisateur
 *
 * PHP version 7.0
 */
class Utilisateur extends \Core\Model
{

    /**
     * Obtenir tous les utilisateurs sous forme de tableau associatif
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM utilisateur');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir un utilisateurs sous forme de tableau associatif
     *
     * @return array
     */
    public static function getOne($data)
    {
        $db = static::getDB();
        $sql = 'SELECT * FROM utilisateur WHERE uti_courriel=:uti_courriel';
        $statement = $db->prepare($sql);
        $statement->execute([
            ':uti_courriel' => $data
        ]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

   /**
     * Ajoute un utilisateur sous à la BD dans la table utilisateur
     *
     * @return array
    */
    public static function insert($data)
    {
        $db = static::getDB();

        // ajoute un nouvel utilisateur ... pour l'instant statut actif et role membre par défaut
        $sql = 'INSERT INTO utilisateur(uti_id, uti_courriel, uti_mdp, uti_prenom, uti_nom, uti_status, uti_rol_id_ce) VALUES (NULL, :uti_courriel, :uti_mdp, :uti_prenom, :uti_nom, 1, 4)';

        $statement = $db->prepare($sql);

        $statement->execute([
            ':uti_courriel' => $data['uti_courriel'],
            ':uti_mdp' => password_hash($data['uti_mdp'], PASSWORD_DEFAULT),
            ':uti_prenom' => $data['uti_prenom'],
            ':uti_nom' => $data['uti_nom'],
        ]);
    }
    


}
