<?php 

function chargerClasse($classe) {
    require_once("./lib/".$classe . '.class.php');
}

spl_autoload_register('chargerClasse');
