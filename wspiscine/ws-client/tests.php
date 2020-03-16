<?php

require_once('curl.class.php');

include('donnees.php');

$client = new Curl();

echo "Début de la journalisation des requêtes dans le fichier trace.log<br>";
$nfile = fopen('trace.log', 'a');

foreach ($tests as $test) {
    $value  = date("Y-m-d H:i:s ")."-----------------------------------------------------------\n";
    $value .= "URL    : ".$test['url']."\n";
    $value .= "Action : ".$test['action']."\n";
    $value .= "Login  : ".$test['login']."\n";
    fwrite($nfile, $value);
    switch ($test['action']) {
        case "GET":
            $response = $client->get($test['url']);
            break;
        case "POST":
			 $value = "Horaires : ".print_r($test['horaires'], true)."\n";
			 fwrite($nfile, $value);
             $response = $client->post($test['url'], array('horaires'=> json_encode($test['horaires'])), $test['login']);
            break;
        case "DELETE":
            $response = $client->delete($test['url'], '', $test['login']);
            break;
    }
    $value  = "Code retour HTTP : ".$response['code']."\n";
    $value .= "Données brutes :\n".$response['info']."\n";
    $value .= "Données JSON décodées :\n".print_r(json_decode($response['info']), true)."\n";
    fwrite($nfile, $value);
}

fclose($nfile); 
echo "Fin de la journalisation des requêtes dans le fichier trace.log<br>";