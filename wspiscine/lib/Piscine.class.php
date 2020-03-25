<?php

/**
 * Classe Piscine de l'entité piscine
 *
 */
class Piscine
{
    private $id_piscine;
    private $type;
    private $nom;
    private $arrondissement_code3l;
    private $adresse;
    private $propriete;
    private $gestion;

    private $erreurs = array();

    /**
     * Constructeur de la classe 
     *
     */
    public function __construct($id_piscine = null, $type = null, $arrondissement_code3l = 0)
    {
        $this->setId_piscine($id_piscine);
        $this->setType($type);
        $this->setArrondissement_code3l($arrondissement_code3l);
    }

    /**
     * Accesseur magique d'une propriété de l'objet
     *
     * @return <type de la propriété>
     */
    public function __get($prop)
    {
        return $this->$prop;
    }


    /**
     * Accesseur de la propriété id_piscine 
     *
     * @return string
     */
    public function getId_piscine()
    {
        return $this->id_piscine;
    }

    /**
     * Accesseur de la propriété type 
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Accesseur de la propriété arrondissement_code3l
     *
     * @return int
     */
    public function getArrondissement_code3l()
    {
        return $this->arrondissement_code3l;
    }

    /**
     * Accesseur de la propriété adresse
     *
     * @return int
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Accesseur de la propriété propriete
     *
     * @return int
     */
    public function getPropriete()
    {
        return $this->propriete;
    }

    /**
     * Accesseur de la propriété gestion
     *
     * @return int
     */
    public function getGestion()
    {
        return $this->gestion;
    }

    /**
     * Méthode magique __toString 
     *
     * @return string
     */
    public function __toString()
    {
        return "Le Piscine \"" . $this->id_piscine . "\" de l'type " . $this->type . " publié en " . $this->arrondissement_code3l;
    }

    
    /**
     * Mutateur magique de la classe Piscine qui exécute le mutateur de la propriété en paramètre
     *
     * @param  mixed $prop
     * @param  mixed $val
     * @return this
     */
    public function __set($prop, $val)
    {
        $setProperty = 'set' . ucfirst($prop);
        $this->$setProperty($val);
    }

    /**
     * Mutateur de la propriété id_piscine 
     *
     * @return this
     */
    public function setId_piscine($id_piscine = null)
    {
        unset($this->erreurs['id_piscine']);
        if ($id_piscine !== null &&  is_int($id_piscine)) {
            $this->id_piscine = $id_piscine;
        } else {
            $this->erreurs['id_piscine'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété type 
     *
     * @return this
     */
    public function setType($type = null)
    {
        unset($this->erreurs['type']);
        $type = trim($type);
        $regExp = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]$/"; // au moins 2 caractères alphabétiques
        if ($type !== null && preg_match($regExp, $type)) {
            $this->type = ucwords(strtolower($type));
        } else {
            $this->erreurs['type'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété nom 
     *
     * @return this
     */
    public function setNom($nom = null)
    {
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
     * Mutateur de la propriété arrondissement_code3l
     *
     * @return this
     */
    public function setArrondissement_code3l($arrondissement_code3l = 0)
    {
        unset($this->erreurs['arrondissement_code3l']);
        $arrondissement_code3l = trim($arrondissement_code3l);
		$regExp = '/^[a-zA-Z]{3}$/'; // 3 lettres minuscules ou majuscules
        if ($arrondissement_code3l !== null &&  preg_match($regExp, $arrondissement_code3l)) { 
            $this->arrondissement_code3l = strtoupper($arrondissement_code3l);
            $this->arrondissement_code3l = $arrondissement_code3l;
        } else {
            $this->erreurs['arrondissement_code3l'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété adresse 
     *
     * @return this
     */
    public function setAdresse($adresse = null)
    {
        unset($this->erreurs['adresse']);
        $adresse = trim($adresse);
        $regExp = '/^\S+.*$/'; // au moins un caractère éditable
        if ($adresse !== null &&  preg_match($regExp, $adresse)) {
            $this->adresse = $adresse;
        } else {
            $this->erreurs['adresse'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété propriete 
     *
     * @return this
     */
    public function setPropriete($propriete = null)
    {
        unset($this->erreurs['propriete']);
        $propriete = trim($propriete);
        $regExp = '/^\S+.*$/'; // au moins un caractère éditable
        if ($propriete !== null &&  preg_match($regExp, $propriete)) {
            $this->propriete = $propriete;
        } else {
            $this->erreurs['propriete'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété gestion 
     *
     * @return this
     */
    public function setGestion($gestion = null)
    {
        unset($this->erreurs['gestion']);
        $gestion = trim($gestion);
        $regExp = '/^\S+.*$/'; // au moins un caractère éditable
        if ($gestion !== null &&  preg_match($regExp, $gestion)) {
            $this->gestion = $gestion;
        } else {
            $this->erreurs['gestion'] = true;
        }
        return $this;
    }
}
