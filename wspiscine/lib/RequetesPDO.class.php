<?php

/**
 * Classe des requêtes PDO 
 *
 */
class RequetesPDO {
    
    /**
     * Récupération de tous les livres de la table livre  
     *
     * @return array
     */ 
    public function getLivres()
    {
        $sPDO = SingletonPDO::getInstance();

        // Avec une requête non préparée
        // =============================
        $oPDOStatement = $sPDO->query(
            'SELECT id, titre, auteur, annee FROM livre ORDER BY id ASC'
        );

        // Avec une requête préparée
        // =========================
        // $oPDOStatement = $sPDO->prepare(
        //     'SELECT id, titre, auteur, annee FROM livre ORDER BY id ASC'
        //   );
        // $oPDOStatement->execute();

        $livres = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $livres;
    }

    /**
     * Récupération d'un livre de la table livre à partir de son id 
     *
     * @return array or boolean false if no result
     */ 
    public function getLivre($id)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'SELECT id, titre, auteur, annee FROM livre WHERE id = :id'
            );
        $oPDOStatement->bindParam(':id', $id);
        $oPDOStatement->execute();
        $livre = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
        return $livre;    
    }
    
    /**
     * Récupération des livres de la table livre pour l'année fournie en paramètre 
     *
     * @return array
     */ 
    public function chercherAnnee($annee)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'SELECT id, titre, auteur, annee FROM livre WHERE annee = :annee ORDER BY titre DESC'
            );
        $oPDOStatement->bindParam(':annee', $annee);
        $oPDOStatement->execute();
        $livres = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $livres;          
    }

    /**
     * Ajout d'un livre dans la table livre 
     *
     * @return boolean
     */ 
    public function ajouterLivre($titre, $auteur, $annee)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'INSERT INTO livre SET titre=:titre, auteur=:auteur, annee=:annee;'
            );
        $oPDOStatement->bindParam(':titre', $titre);
        $oPDOStatement->bindParam(':auteur', $auteur);
        $oPDOStatement->bindParam(':annee', $annee);
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) {
            return false;
        }
        return true;
    }

    /**
     * Modification d'un livre dans la table livre à partir de son id 
     *
     * @return boolean
     */ 
    public function modifierLivre($id, $titre=null, $auteur=null, $annee=null)
    {
        $sPDO = SingletonPDO::getInstance();
        if ($titre != null || $auteur != null ||  $annee != null) {
            $items = '';
            if ($titre  != null) $items .= 'titre=:titre,';
            if ($auteur != null) $items .= 'auteur=:auteur,'; 
            if ($annee  != null) $items .= 'annee=:annee,';
            $items = rtrim($items, ',');
            $oPDOStatement = $sPDO->prepare(
                'UPDATE livre SET '.$items.' WHERE id=:id;'
                );
            $oPDOStatement->bindParam(':id', $id);
            if ($titre  != null) $oPDOStatement->bindParam(':titre', $titre);
            if ($auteur != null) $oPDOStatement->bindParam(':auteur', $auteur);
            if ($annee  != null) $oPDOStatement->bindParam(':annee', $annee);
            $oPDOStatement->execute();
            if ($oPDOStatement->rowCount() == 0) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Suppression d'un livre dans la table livre à partir de son id 
     *
     * @return boolean
     */ 
    public function supprimerLivre($id)
    {
        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare(
            'DELETE FROM livre WHERE id=:id;'
            );
        $oPDOStatement->bindParam(':id', $id);
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) {
            return false;
        }
        return true;
    }
}