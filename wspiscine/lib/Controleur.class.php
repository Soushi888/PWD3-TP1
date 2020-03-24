<?php

/**
 * Classe Controleur
 * pour gérer le service web  
 */
class Controleur
{

    private $requetes = array(
        "livres"                  => array(
            'GET'      => 'getLivres',
            'POST'     => 'postLivre'
        ),
        "livres/:id"              => array(
            'GET'      => 'getLivre',
            'PUT'      => 'putLivre',
            'DELETE'   => 'deleteLivre'
        ),
        "livres/:id/commentaires" => array('GET'      => 'getLivreCommentaires')
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
     * Liste des livres
     * @param void
     * @return
     */
    private function getLivres()
    {
        $req = new RequetesPDO();
        if (isset($_GET['annee'])) {
            $liste = $req->chercherAnnee($_GET['annee']);
        } else {
            $liste = $req->getLivres();
        }
        echo json_encode($liste);
    }

    /**
     * Informations sur le Livre d'id $_GET['id']
     * @param void
     * @return
     */
    private function getLivre()
    {
        $req = new RequetesPDO();
        $livre = $req->getLivre($this->id);
        echo json_encode($livre);
    }

    /**
     * Liste des commentaires sur le Livre d'id $_GET['id']
     * @param void
     * @return
     */
    private function getLivreCommentaires()
    {
        echo "Récupérer les commentaires sur le livre d'id $this->id";
    }

    /**
     * Ajout d'un livre
     * @param void
     * @return
     */
    private function postLivre()
    {
        $req = new RequetesPDO();
        // Trace::writeLog(print_r(json_decode($_POST['livre']), true));
        $livre = (array) json_decode($_POST['livre']); // ou : $livre = json_decode($_POST['livre'], true); 
        $oLivre = new Piscine(...array_values($livre));
        if (count($oLivre->erreurs) === 0) {
            $codeRetour = $req->ajouterLivre(...array_values($livre));
            echo json_encode($codeRetour);
        } else {
            echo json_encode(["erreurs de données" => $oLivre->erreurs]);
        }
    }

    /**
     * Modifier le livre d'id $_GET['id']
     * @param void
     * @return
     */
    private function putLivre()
    {
        $req = new RequetesPDO();
        $livre = $req->getLivre($this->id);
        if ($livre === false) {
            echo json_encode(["code" => false]);
        } else {
            $livreActuel = $livre;
            $livre = (array) json_decode(file_get_contents("php://input")); // ou : $livre = json_decode(file_get_contents("php://input"), true); 
            array_shift($livreActuel); // pour enlever le champ id
            $oLivre = new Piscine(...array_values($livreActuel));
            foreach ($livre as $key => $value) {
                if (!is_null($value)) $oLivre->$key = $value;
            }
            if (count($oLivre->erreurs) === 0) {
                $codeRetour = $req->modifierLivre($this->id, ...array_values($livre));
                echo json_encode($codeRetour);
            } else {
                echo json_encode(["erreurs de données" => $oLivre->erreurs]);
            }
        }
    }

    /**
     * Supprimer le Livre d'id $_GET['id']
     * @param void
     * @return
     */
    private function deleteLivre()
    {
        $req = new RequetesPDO();
        $codeRetour = $req->supprimerLivre($this->id);
        echo json_encode($codeRetour);
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
