<?php

/**
 * Class Autoloader :
 * Charge les classes dynamiquement.
 */
class Autoloader
{
    /**
     * Enregistre les classes ustilisées dans le __autoload
     * @return void
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'chargerClasse']);
    }


     
    /**
     * chargerClasse
     * 
     * 
     * @param  string $classe
     * @return void
     */
    public static function chargerClasse($classe)
    {
        require_once("./lib/" . $classe . '.class.php');
    }
}
