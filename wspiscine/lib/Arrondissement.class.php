<?php

/**
 * Classe Arrondissement de l'entité Arrondissement
 *
 */
class Arrondissement
{
    private $code3l;
    private $nom;
    private $accronyme;
    
    private $erreurs = array();
    
    /**
     * Constructeur de la classe 
     *
     */ 
    public function __construct($code3l = null, $nom = null, $accronyme = 0) {
        $this->setcode3l($code3l);
        $this->setNom($nom);
        $this->setAccronyme($accronyme);
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
     * Accesseur de la propriété code3l 
     *
     * @return string
     */ 
    public function getcode3l() {
        return $this->code3l;
    }
    
    /**
     * Accesseur de la propriété nom 
     *
     * @return string
     */ 
    public function getNom() {
        return $this->nom;
    }
 
    /**
     * Accesseur de la propriété accronyme
     *
     * @return int
     */ 
    public function getAccronyme() {
        return $this->accronyme;
    }

    /**
     * Méthode magique __toString 
     *
     * @return string
     */ 
    public function __toString() {
        return "Arrondissement ".$this->code3l. " - " .$this->nom."<br>".$this->accronyme; 
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
     * Mutateur de la propriété code3l 
     *
     * @return this
     */    
    public function setCode3l($code3l = null) {
        unset($this->erreurs['code3l']);
        $code3l = trim($code3l);
		$regExp = '/^[a-zA-Z]{3}$/'; // au moins un caractère éditable
        if ($code3l !== null &&  preg_match($regExp, $code3l)) { 
            $this->code3l = strtoupper($code3l);
        } else {
            $this->erreurs['code3l'] = true;
        }
        return $this;
    }    

    /**
     * Mutateur de la propriété nom 
     *
     * @return this
     */    
    public function setNom($nom = null) {
        unset($this->erreurs['nom']);
        $nom = trim($nom);
        $regExp = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/"; // au moins 1 caractères alphabétiques

        if ($nom !== null && preg_match($regExp, $nom)) {
            $this->nom = ucwords(strtolower($nom));
        } else {
            $this->erreurs['nom'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété accronyme
     *
     * @return this
     */        
    public function setAccronyme($accronyme = 0) {
        unset($this->erreurs['accronyme']);
        if (preg_match('/^[a-zA-Z]{3}$/', $accronyme)) {
            $this->accronyme = strtoupper($accronyme);
        } else {
            $this->erreurs['accronyme'] = true;
        }
        return $this;
    }
}