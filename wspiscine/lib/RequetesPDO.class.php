<?php

/**
 * Classe des requêtes PDO 
 *
 */
class RequetesPDO
{

    /**
     * Récupération de tous les arrondissements de la table arrondissement  
     *
     * @return array
     */
    public function getArrondissements()
    {
        $sPDO = SingletonPDO::getInstance();

        $oPDOStatement = $sPDO->query(
            'SELECT * FROM arrondissement'
        );

        $arrondissements = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $arrondissements;
    }

    /**
     * Retourne un arrondissement identifié par son identifiant unique "id" qui correspond à la clé primaire "code3l" (code de 3 lettres) de la table arrondissement.
     *
     * @param int $id
     * 
     * @return array or boolean false if no result
     */
    public function getArrondissement($id)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'SELECT * FROM arrondissement WHERE code3l = :id'
        );
        $oPDOStatement->bindParam(':id', $id);
        $oPDOStatement->execute();

        $arrondissement = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
        return $arrondissement;
    }

    /**
     * Récupération de toutes les piscines de la table piscines
     *
     * @return array
     */
    public function getPiscines()
    {
        $sPDO = SingletonPDO::getInstance();

        $oPDOStatement = $sPDO->query(
            'SELECT * FROM piscine'
        );

        $piscines = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $piscines;
    }

    /**
     * Retourne l’information sur une piscine identifiée par son identifiant unique "id" qui correspond à la clé primaire "id_piscine" de la table piscine.
     *
     * @param int $id
     * 
     * @return array or boolean false if no result
     */
    public function getPiscine($id)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'SELECT * FROM piscine WHERE id_piscine = :id'
        );
        $oPDOStatement->bindParam(':id', $id);
        $oPDOStatement->execute();

        $piscine = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
        return $piscine;
    }

    /**
     * Retourne la liste des piscines d’un arrondissement à partir de son code de 3 lettres.
     *
     * @param int $id
     * 
     * @return array or boolean false if no result
     */
    public function getPiscinesParArr($id)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'SELECT * FROM piscine WHERE arrondissement_code3l = :id'
        );
        $oPDOStatement->bindParam(':id', $id);
        $oPDOStatement->execute();

        $piscines = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
        return $piscines;
    }

     /**
     * Retourne les horaires d’une piscine identifiée par son identifiant unique "id"
     * 
     * @param int $id clé primaire "id_piscine" de la table piscine.
     *
     * @return array
     */
    public function getHoraires($id)
    {
        $sPDO = SingletonPDO::getInstance();

        $oPDOStatement = $sPDO->query(
            'SELECT * FROM horaire'
        );

        $horaires = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $horaires;
    }

    /**
     * Retourne l'horaire d’une piscine selon la date passée en paramètre.
     * 
     * @param int $id clé primaire "id_piscine" de la table piscine.
     * @param string $date date en format AAAAMMJJ
     * 
     * @return array
     */
    public function getHoraireParDate($id, $date)
    {
        $jour = date("w", strtotime($date));
        // die($jour);
        $sPDO = SingletonPDO::getInstance();

        $oPDOStatement = $sPDO->prepare(
            'SELECT * FROM horaire WHERE id_piscine = :id AND jour = :jour'
        );
        $oPDOStatement->bindParam(':id', $id);
        $oPDOStatement->bindParam(':jour', $jour);
        $oPDOStatement->execute();

        $horaires = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        // echo $jour;
        return $horaires;
    }

    /**
     * Ajout d'un horaire dans la table horaire 
     *
     * @return boolean
     */
    public function ajouterHoraire($id_piscine, $jour, $debut, $fin)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'INSERT INTO horaire 
            SET 
                id_piscine = :id_piscine, 
                jour = :jour, 
                debut = :debut, 
                fin = :fin
                ON DUPLICATE KEY UPDATE
                debut = :debut,
                fin = :fin'
        );
        $oPDOStatement->bindParam(':id_piscine', $id_piscine);
        $oPDOStatement->bindParam(':jour', $jour);
        $oPDOStatement->bindParam(':debut', $debut);
        $oPDOStatement->bindParam(':fin', $fin);
        $oPDOStatement->execute();

        if ($oPDOStatement->rowCount() == 0) {
            return false;
        }
        return true;
    }

    // /**
    //  * Modification d'un horaire dans la table horaire 
    //  *
    //  * @return boolean
    //  */
    // public function modifierHoraire($id_piscine, $jour, $debut, $fin)
    // {
    //     $sPDO = SingletonPDO::getInstance();
    //     $oPDOStatement = $sPDO->prepare(
    //         'UPDATE horaire SET jour = :jour, debut = :debut, fin = :fin WHERE id_piscine = :id_piscine'
    //     );
    //     $oPDOStatement->bindParam(':id_piscine', $id_piscine);
    //     $oPDOStatement->bindParam(':jour', $jour);
    //     $oPDOStatement->bindParam(':debut', $debut);
    //     $oPDOStatement->bindParam(':fin', $fin);
    //     $oPDOStatement->execute();
    //     if ($oPDOStatement->rowCount() == 0) {
    //         return false;
    //     }
    //     return true;
    // }

    /**
     * Suppression d'un horaire dans la table horaire à partir de son id 
     *
     * @return boolean
     */
    public function supprimerHoraire($id_piscine)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'DELETE FROM horaire WHERE id_piscine = :id_piscine'
        );
        $oPDOStatement->bindParam(':id_piscine', $id_piscine);
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) {
            return false;
        }
        return true;
    }
}
