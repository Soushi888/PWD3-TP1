<?php

/**
 * Classe Livre de l'entité livre
 *
 */
class Livre
{
    private $titre;
    private $auteur;
    private $annee;
    
    private $erreurs = array();
	
	const ANNEE_MINI = 1900;
    
    /**
     * Constructeur de la classe 
     *
     */ 
    public function __construct($titre = null, $auteur = null, $annee = 0) {
        $this->setTitre($titre);
        $this->setAuteur($auteur);
        $this->setAnnee($annee);
    }
    
    /**
     * Accesseur magique d'une propriété de l'objet
     *
     * @return <type de la propriété>
     */     
    public function __get($prop) {
        return $this->$prop;
    }
    

    /**
     * Accesseur de la propriété titre 
     *
     * @return string
     */ 
    public function getTitre() {
        return $this->titre;
    }
    
    /**
     * Accesseur de la propriété auteur 
     *
     * @return string
     */ 
    public function getAuteur() {
        return $this->auteur;
    }
 
    /**
     * Accesseur de la propriété annee
     *
     * @return int
     */ 
    public function getAnnee() {
        return $this->annee;
    }

    /**
     * Méthode magique __toString 
     *
     * @return string
     */ 
    public function __toString() {
        return "Le livre \"".$this->titre."\" de l'auteur ".$this->auteur." publié en ".$this->annee; 
    }
        
    /**
     * Mutateur magique qui exécute le mutateur de la propriété en paramètre 
     *
     */   
    public function __set($prop, $val) {
        $setProperty = 'set'.ucfirst($prop);
        $this->$setProperty($val);
    }
    
    /**
     * Mutateur de la propriété titre 
     *
     * @return this
     */    
    public function setTitre($titre = null) {
        unset($this->erreurs['titre']);
        $titre = trim($titre);
		$regExp = '/^\S+.*$/'; // au moins un caractère éditable
        if ($titre !== null &&  preg_match($regExp, $titre)) { 
            $this->titre = $titre;
        } else {
            $this->erreurs['titre'] = true;
        }
        return $this;
    }    

    /**
     * Mutateur de la propriété auteur 
     *
     * @return this
     */    
    public function setAuteur($auteur = null) {
        unset($this->erreurs['auteur']);
        $auteur = trim($auteur);
        $regExp = '/^[a-zA-ZéèêëïôÉ]{2,}([- ][a-zA-ZéèêëïôÉ]{2,})*$/'; // au moins 2 caractères alphabétiques
        if ($auteur !== null && preg_match($regExp, $auteur)) {
            $this->auteur = ucwords(strtolower($auteur));
        } else {
            $this->erreurs['auteur'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété annee
     *
     * @return this
     */        
    public function setAnnee($annee = 0) {
        unset($this->erreurs['annee']);
        if (preg_match('/^\d{4}$/', $annee) && $annee > self::ANNEE_MINI && $annee <= date('Y')) {
            $this->annee = $annee;
        } else {
            $this->erreurs['annee'] = true;
        }
        return $this;
    }
}