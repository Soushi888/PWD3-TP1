<?php

/**
 * Classe Horaire de l'entité horaire
 *
 */
class Horaire
{
    private $id_piscine;
    private $jour;
    private $debut;
    private $fin;

    private $erreurs = array();

    /**
     * Constructeur de la classe 
     *
     */
    public function __construct($id_piscine = null, $jour = null, $debut = 0, $fin = 0)
    {
        $this->setId_piscine($id_piscine);
        $this->setJour($jour);
        $this->setDebut($debut);
        $this->setFin($fin);
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
     * Accesseur de la propriété jour 
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Accesseur de la propriété debut
     *
     * @return int
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Accesseur de la propriété debut
     *
     * @return int
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Méthode magique __toString 
     *
     * @return string
     */
    public function __toString()
    {
        switch ($this->jour) {
            case "0":
                $jour = "dimanche";
                break;
            case "1":
                $jour = "lundi";
                break;
            case "2":
                $jour = "mardi";
                break;
            case "3":
                $jour = "mercredi";
                break;
            case "4":
                $jour = "jeudi";
                break;
            case "5":
                $jour = "vendredi";
                break;
            case "6":
                $jour = "samedi";
                break;
        }

        return "Le " . $jour . ", la piscine No." . $this->id_piscine . " ouvre à " . $this->debut . " et ferme à " . $this->fin;
    }

    /**
     * Mutateur magique qui exécute le mutateur de la propriété en paramètre 
     *
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
        if ($id_piscine !== null && is_int($id_piscine)) {
            $this->id_piscine = $id_piscine;
        } else {
            $this->erreurs['id_piscine'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété jour 
     *
     * @return this
     */
    public function setJour($jour = null)
    {
        unset($this->erreurs['jour']);

        if ($jour !== null && is_int($jour)) {
            $this->jour = $jour;
        } else {
            $this->erreurs['jour'] = true;
        }

        return $this;
    }

    /**
     * Mutateur de la propriété debut
     *
     * @return this
     */
    public function setDebut($debut = 0)
    {
        unset($this->erreurs['debut']);
        $debut = trim($debut);
        $regExp = "/^([0-1][0-9]|2[0-4]):([0-5][0-9])$/"; // une heure valide au format hh:mm
        if ($debut !== null && preg_match($regExp, $debut)) {
            $this->debut = $debut;
        } else {
            $this->erreurs['debut'] = true;
        }
        return $this;
    }

    /**
     * Mutateur de la propriété fin
     *
     * @return this
     */
    public function setFin($fin = 0)
    {
        unset($this->erreurs['fin']);
        $fin = trim($fin);
        $regExp = "/^([0-1][0-9]|2[0-4]):([0-5][0-9])$/"; // une heure valide au format hh:mm
        if ($fin !== null && preg_match($regExp, $fin)) {
            $this->fin = $fin;
        } else {
            $this->erreurs['fin'] = true;
        }
        return $this;
    }
}

