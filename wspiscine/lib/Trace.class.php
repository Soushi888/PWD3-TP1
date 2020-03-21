<?php

/**
 * Classe d'enregistrement d'évènements dans un fichier log
 *
 */
class Trace
{

    const  LOG_PATH = 'trace.log';
    
    public static function writeLog($message) {

        // Ouverture du fichier en mode "a=append", crée le fichier s'il n'existe pas
        $nfile = fopen(self::LOG_PATH, "a");

        // Horodatage du message et ajout de 2 caractères de passage à la ligne
        $value =date("Y-m-d H:i:s")." ".$message."\n\n";

        // Ecriture du message à la fin du fichier (car ouvert en mode "append")
        fwrite($nfile, $value);

        // Fermeture du fichier
        fclose($nfile); 
    }
}
