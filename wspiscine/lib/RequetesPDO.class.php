<?php

/**
 * Classe des requêtes PDO 
 *
 */
class RequetesPDO {
    
    /**
     * Récupération de tous les arrindissements de la table arrondissement  
     *
     * @return array
     */ 
    public function getArrondissements()
    {
        $sPDO = SingletonPDO::getInstance();

        // Avec une requête non préparée
        // =============================
        $oPDOStatement = $sPDO->query(
            'SELECT * FROM arrondissement ORDER BY nom ASC'
        );

        // Avec une requête préparée
        // =========================
        // $oPDOStatement = $sPDO->prepare(
        //     'SELECT id, titre, auteur, annee FROM arrondissement ORDER BY id ASC'
        //   );
        // $oPDOStatement->execute();

        $arrondissement = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $arrondissement;
    }

    /**
     * Récupération d'un arrondissement de la table arrondissement à partir de son id (code3l)
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
     * Ajout d'un horaire dans la table horaire 
     *
     * @return boolean
     */ 
    public function ajouterHoraire($id_piscine, $jour, $debut, $fin)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'INSERT INTO horaire SET id_piscine=:id_piscine, jour=:jour, debut=:debut, fin=:fin;'
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

    /**
     * Suppression d'un horaire dans la table horaire à partir de son id 
     *
     * @return boolean
     */ 
    public function supprimerHoraire($id_piscine)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'DELETE FROM horaire WHERE id_piscine=:id_piscine;'
            );
        $oPDOStatement->bindParam(':id_piscine', $id_piscine);
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) {
            return false;
        }
        return true;
    }
}