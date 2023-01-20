<?php

namespace App\Models;

use PDO;

/**
 * Modèle UserEnchere
 *
 * PHP version 7.0
 */
class UserEnchere extends \Core\Model
{

    /**
     * Obtenir tous les publication de l'utilisateur sous forme de tableau associatif
     *
     * @return array
     */
    public static function getAll($user)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre
                             LEFT JOIN enchere
                            ON timbre.tim_id = enchere.enc_tim_id
                            RIGHT JOIN image
                            ON timbre.tim_id = image.tim_id
                            WHERE timbre.userId = ' . $user . '');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir une publication spécifique de l'utilisateur sous forme de tableau associatif
     *
     * @return array
     */
    public static function getOne($user, $id)
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre
                            LEFT JOIN enchere
                            ON timbre.tim_id = enchere.enc_tim_id
                            RIGHT JOIN image
                            ON timbre.tim_id = image.tim_id
                            WHERE timbre.tim_id ='.$id.' AND timbre.userId = '.$user.'');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   /**
     * Ajoute une publication de l'utilisateur dans la BD
     *
     * @return $id l'identification du dernier ajout
     */
    public static function insert($data, $table, $id, $tab)
    {
        $db = static::getDB();

        switch ($table) {
            case 'timbre':
                $sql = 'INSERT INTO timbre (tim_id,	tim_nom, tim_description, tim_date_creation, tim_pays,	tim_couleur, tim_condition,	tim_dimension, tim_certifie, userId) 
                        VALUES(NULL, :tim_nom, :tim_description, :tim_date_creation, :tim_pays,	:tim_couleur, :tim_condition, :tim_dimension, :tim_certifie, :userId)';
                break;
            case 'image':
                $img_nom = $tab['name'];
                $img_chemin = $tab['tmp_name'];
                $sql = 'INSERT INTO image ( img_id,	img_nom, img_chemin, tim_id) 
                        VALUES(NULL, :img_nom, :img_chemin, :tim_id)';
                break;
            case 'enchere':
               
                $sql = 'INSERT INTO enchere (enc_id, enc_nom, enc_type,	enc_date_debut,	enc_date_fin, enc_prix_reserve, enc_prix_depart, enc_prix,	enc_ce_cat_id,	enc_tim_id,	userId) 
                        VALUES(NULL, :enc_nom, :enc_type, :enc_date_debut, :enc_date_fin, :enc_prix_reserve, :enc_prix_depart, :enc_prix, :enc_ce_cat_id, :enc_tim_id, :userId)';
                break;
        }


        $statement = $db->prepare($sql);

        switch ($table) {
            case 'timbre':
                $statement->execute([
                    ':tim_nom' => $data['tim_nom'],
                    ':tim_description' => $data['tim_description'],
                    ':tim_date_creation' => $data['tim_date_creation'],
                    ':tim_pays' => $data['tim_pays'],
                    ':tim_couleur' => $data['tim_couleur'],
                    ':tim_condition' => $data['tim_condition'],
                    ':tim_dimension' => $data['tim_dimension'],
                    ':tim_certifie' => $data['tim_certifie'],
                    ':userId' => $data['userId']

                ]);
                $id = $db->lastInsertId();
                return $id;
                break;
            case 'image':
                $statement->execute([
                    ':img_nom' => $img_nom,
                    ':img_chemin' => $img_chemin,
                    ':tim_id' => $id
                ]);
                break;
            case 'enchere':
                $statement->execute([
                    ':enc_nom' => $data['enc_nom'],
                    ':enc_type' => $data['enc_type'],
                    ':enc_date_debut' => $data['enc_date_debut'],
                    ':enc_date_fin' => $data['enc_date_fin'],
                    ':enc_prix_reserve' => $data['enc_prix_reserve'],
                    ':enc_prix_depart' => $data['enc_prix_depart'],
                    ':enc_prix' => $data['enc_prix_depart'],
                    ':enc_ce_cat_id' => $data['enc_ce_cat_id'],
                    ':enc_tim_id' => $data['enc_tim_id'],
                    ':userId' => $data['userId']
                ]);
                $id = $db->lastInsertId();
                return $id;

                break;
        }
    }

    public static function supprime($id)
    {
        $db = static::getDB();

        /*supprimer enchère*/
        $sqlEnchere = 'DELETE FROM enchere WHERE enc_tim_id = :tim_id';
        $statementEnchere = $db->prepare($sqlEnchere);
        $statementEnchere->execute([':tim_id' => $id ]);

        /*supprimer timbre*/
        $sqlTimbre = 'DELETE FROM timbre WHERE tim_id = :tim_id';
        $statementTimbre = $db->prepare($sqlTimbre);
        $statementTimbre->execute([':tim_id' => $id ]);
                 
    }


    public static function modifie($data, $chemin, $nomImg)
    {
        $db = static::getDB();

        $id = $_POST['tim_id'];
      
        /*update timbre */
        $sqlTimbre = 'UPDATE timbre
                SET tim_id=:tim_id, tim_nom=:tim_nom, tim_description=:tim_description, tim_date_creation=:tim_date_creation, tim_pays=:tim_pays, tim_couleur=:tim_couleur, tim_condition=:tim_condition, tim_dimension=:tim_dimension, tim_certifie=:tim_certifie, userId=:userId
                WHERE tim_id=:tim_id';
          
        $statementTimbre = $db->prepare($sqlTimbre);

        $statementTimbre->execute([
                    ':tim_id' => $id,
                    ':tim_nom' => $data['tim_nom'],
                    ':tim_description' => $data['tim_description'],
                    ':tim_date_creation' => $data['tim_date_creation'],
                    ':tim_pays' => $data['tim_pays'],
                    ':tim_couleur' => $data['tim_couleur'],
                    ':tim_condition' => $data['tim_condition'],
                    ':tim_dimension' => $data['tim_dimension'],
                    ':tim_certifie' => $data['tim_certifie'],
                    ':userId' => $data['userId']

        ]);

        /*update enchère */
        $sqlEnchere = 'UPDATE enchere
                SET enc_nom=:enc_nom, enc_type=:enc_type, enc_date_debut=:enc_date_debut, enc_date_fin=:enc_date_fin, enc_prix_reserve=:enc_prix_reserve, enc_prix_depart=:enc_prix_depart, enc_prix=:enc_prix, enc_ce_cat_id=:enc_ce_cat_id, enc_tim_id=:enc_tim_id, userId=:userId
                WHERE enc_tim_id=:enc_tim_id';
          
        $statementEnchere = $db->prepare($sqlEnchere);
       
        $statementEnchere->execute([
                    ':enc_id' => $data['enc_id'],
                    ':enc_nom' => $data['enc_nom'],
                    ':enc_type' => $data['enc_type'],
                    ':enc_date_debut' => $data['enc_date_debut'],
                    ':enc_date_fin' => $data['enc_date_fin'],
                    ':enc_prix_reserve' => $data['enc_prix_reserve'],
                    ':enc_prix_depart' => $data['enc_prix_depart'],
                    ':enc_prix' => $data['enc_prix_depart'],
                    ':enc_ce_cat_id' => $data['enc_ce_cat_id'],
                    ':enc_tim_id' => $id,
                    ':userId' => $data['userId']

        ]);



        /*update image */
        if($nomImg){
            $sqlImg = 'UPDATE image
                    SET img_nom=:img_nom, img_chemin=:img_chemin, tim_id=:tim_id
                    WHERE tim_id=:tim_id';
            
            $statementImg = $db->prepare($sqlImg);

            $statementImg->execute([
                        ':img_id' => $data['img_id'],
                        ':img_nom' => $nomImg,
                        ':img_chemin' => $chemin,
                        ':tim_id' => $id
            ]);
        }
        
        }
    



}
