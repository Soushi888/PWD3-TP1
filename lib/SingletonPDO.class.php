<?php
 
class SingletonPDO
{
    private $PDOInstance     = null;    // pointeur vers l'objet PDO instancié dans le constructeur
    private static $instance = null;    // pointeur vers l'objet SingletonPDO instancié dans getInstance()
  
    const DEFAULT_SQL_HOST = 'localhost';
    const DEFAULT_SQL_DBN  = 'p41';
    const DEFAULT_SQL_USER = 'root';
    const DEFAULT_SQL_PASS = '';

    /**
     * Méthode privée accessible uniquement par getInstance() 
     * Constructeur d'une instance de SingeltonPDO
     * Crée une instance PDO dans la propriété $PDOInstance
     * @param void
     */
    private function __construct()
    {
        $this->PDOInstance = new PDO('mysql:host='.self::DEFAULT_SQL_HOST.';dbname='.self::DEFAULT_SQL_DBN,
                                     self::DEFAULT_SQL_USER,
                                     self::DEFAULT_SQL_PASS);
        $this->PDOInstance->exec("SET NAMES UTF8");
        $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
  
    private function __clone (){}  // portée private pour empêcher le clonage 

    /**
     * Méthode statique de classe
     * Crée une instance de SingeltonPDO dans la propriété $instance, si elle n'a pas déjà été créée
     * @param void
     * @return le pointeur vers l'instance unique de SingletonPDO
     */
    public static function getInstance()
    {  
        if(is_null(self::$instance))
        {
            self::$instance = new SingletonPDO();
        }
        return self::$instance;
    }
 
    /**
     * Méthode magique __call() qui récupère les appels de méthodes inaccessibles
     * Ces méthodes sont en fait des méthodes de l'objet PDO, qu'il faut exécuter
     * @param $name = nom de la méthode inaccessible,
     *        $params = paramètres associés à l'appel de cette méthode    
     * @return retour de la méthode de l'instance PDO
     */
	function __call($name, $params) {
        return $this->PDOInstance->$name(...$params);
    }

}
