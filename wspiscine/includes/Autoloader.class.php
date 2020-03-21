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
        spl_autoload_register([__CLASS__, "autoload"]);
    }

    /**
     * @param string $class
     * 
     * @return void
     */
    public static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . "\\") === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            require("class\\" . $class . ".class.php");
        }
    }
}

?>