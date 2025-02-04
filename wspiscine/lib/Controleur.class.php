<?php

/**
 * Classe Controleur
 * pour gérer le service web  
 */
class Controleur
{

    private $requetes = array(
        "arrondissements" => array(
            'GET' => 'getArrondissements'
        ),
        "arrondissements/:id" => array(
            'GET' => 'getArrondissement'
        ),
        "piscines" => array(
            'GET' => 'getPiscines'
        ),
        "arrondissements/:id/piscines" => array(
            'GET' => 'getPiscinesParArr'
        ),
        "piscines/:id" => array(
            'GET' => 'getPiscine'
        ),
        "piscines/:id/horaires" => array(
            'GET' => 'getHoraires',
            'POST' => 'postHoraire',
            'DELETE' => 'deleteHoraire'
        ),
    );

    private $ressource;
    private $id;
    private $action;

    const ERROR_RESSOURCE = "HTTP 400";
    const ERROR_AUTH = "HTTP 401";
    const ERROR_METHOD = "HTTP 405";

    public function __construct()
    {

        /*  Routage des requêtes
            en fonction de l'uri et de la méthode (GET, POST, PUT ou DELETE)
            ---------------------------------------------------------------- */

        $this->ressource = isset($_GET['ressource']) ? $_GET['ressource'] : '';
        $this->id        = isset($_GET['id'])        ? $_GET['id'] : '';
        $this->action    = isset($_GET['action'])    ? $_GET['action'] : '';

        $uriRequest = '';
        if ($this->ressource !== '') $uriRequest .= $this->ressource;
        if ($this->id        !== '') $uriRequest .= '/:id';
        if ($this->action    !== '') $uriRequest .= '/' . $this->action;

        try {
            foreach ($this->requetes as $uri => $methodes) {
                if ($uri === $uriRequest) {
                    foreach ($methodes as $methode => $fonction) {
                        if ($methode === $_SERVER['REQUEST_METHOD']) {

                            if ($methode !== 'GET' && !$this->validerUtilisateur($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
                                throw new Exception(self::ERROR_AUTH);
                            }

                            $this->$fonction();
                            exit;
                        }
                    }
                    throw new Exception(self::ERROR_METHOD);
                }
            }
            throw new Exception(self::ERROR_RESSOURCE);
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
            exit;
        }
    }

    /* Traitement des requêtes
    ----------------------- */



    /**
     * Liste des arrondissements
     * @param void
     * @return
     */
    private function getArrondissements()
    {
        $req = new RequetesPDO();
        $arrondissements = $req->getArrondissements();
        echo json_encode($arrondissements);
    }

    /**
     * Informations sur l'arrondissement d'id $_GET['id']
     * @param void
     * @return
     */
    private function getArrondissement()
    {
        $req = new RequetesPDO();
        $arrondissement = $req->getArrondissement($this->id);
        echo json_encode($arrondissement);
    }

    /**
     * Liste des piscines
     * @param void
     * @return
     */
    private function getPiscines()
    {
        $req = new RequetesPDO();
        $piscines = $req->getPiscines();
        echo json_encode($piscines);
    }

    /**
     * Informations sur la piscine d'id $_GET['id']
     * @param void
     * @return
     */
    private function getPiscine()
    {
        $req = new RequetesPDO();
        $piscines = $req->getPiscine($this->id);
        echo json_encode($piscines);
    }

    /**
     * Liste des piscines dont l'arrondissement est $_GET['id']
     * @param void
     * @return
     */
    private function getPiscinesParArr()
    {
        $req = new RequetesPDO();
        $code3l = $_GET["id"];

        $piscines = $req->getPiscinesParArr($code3l);
        echo json_encode($piscines);
    }

    /**
     * Liste des horaires
     * @param void
     * @return
     */
    private function getHoraires()
    {
        $req = new RequetesPDO();
        if (isset($_GET['date'])) {
            $liste = $req->getHoraireParDate($this->id, $_GET['date']);
        } else {
            $liste = $req->getHoraires($this->id);
        }
        echo json_encode($liste);
    }

    /**
     * Ajout d'un horaire
     * @param void
     * @return
     */
    private function postHoraire()
    {

        $req = new RequetesPDO();
        $horaires = json_decode($_POST['horaires'], true);

        foreach ($horaires as $horaire) {
            $oHoraire = new Horaire(...array_values($horaire));

            if (count($oHoraire->erreurs) === 0) {
                $codeRetour = $req->ajouterHoraire(...array_values($horaire));
                echo json_encode($codeRetour) . "\n";
            } else {
                echo json_encode(["erreurs de données" => $oHoraire->erreurs]);
            }
        }
    }

    /**
     * Supprimer l'horaire d'id $_GET['id']
     * @param void
     * @return
     */
    private function deleteHoraire()
    {
        $req = new RequetesPDO();
        $codeRetour = $req->supprimerHoraire($this->id);
        echo json_encode($codeRetour) . "\n";
    }

    /* Traitement des erreurs avec l'envoi d'un code HTTP
    -------------------------------------------------- */

    /**
     * Traitement des erreurs interceptées pat le try/catch
     * @param message de l'exception
     * @return 
     */
    private function erreur($erreur)
    {
        $message = '';
        if ($erreur == self::ERROR_RESSOURCE) {
            header('HTTP/1.1 400 Bad Request');
        } elseif ($erreur == self::ERROR_AUTH) {
            header('HTTP/1.1 401 Unauthorized');
        } elseif ($erreur == self::ERROR_METHOD) {
            header('HTTP/1.1 405 Method Not Allowed');
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo $erreur;
        }
    }

    /* Contrôle de l'utilisateur si requête PUT, POST ou DELETE
    -------------------------------------------------------- */

    /**
     * Traitement des erreurs interceptées pat le try/catch
     * @param identifiant et mot de passe de l'utilisateur
     * @return boolean 
     */
    private function validerUtilisateur($user, $pass)
    {
        $users = array('582P41' => 'ABC123');
        if (isset($users[$user]) && $users[$user] === $pass) {
            return true;
        } else {
            return false;
        }
    }
}
