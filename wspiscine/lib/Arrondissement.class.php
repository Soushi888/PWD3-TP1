<?php

/**
 * Classe Arrondissement de l'entité Arrondissement
 *
 */
class Arrondissement
{
    private $code;
    private $nom;
    private $accronyme;
    
    private $erreurs = array();
    
    /**
     * Constructeur de la classe 
     *
     */ 
    public function __construct($code = null, $nom = null, $accronyme = 0) {
        $this->setCode($code);
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
     * Accesseur de la propriété code 
     *
     * @return string
     */ 
    public function getCode() {
        return $this->code;
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
        return "Arrondissement ".$this->code. " - " .$this->nom."<br>".$this->accronyme; 
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
     * Mutateur de la propriété code 
     *
     * @return this
     */    
    public function setCode($code = null) {
        unset($this->erreurs['code']);
        $code = trim($code);
		$regExp = '/^[a-zA-Z]{3}$/'; // au moins un caractère éditable
        if ($code !== null &&  preg_match($regExp, $code)) { 
            $this->code = $code;
        } else {
            $this->erreurs['code'] = true;
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
            $this->accronyme = $accronyme;
        } else {
            $this->erreurs['accronyme'] = true;
        }
        return $this;
    }
}