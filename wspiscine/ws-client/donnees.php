<?php

const PATH = "http://localhost/pwd3-tp1/wspiscine/";
// const PATH = "https://cmaisonneuve.sacha-pignot.website/wspiscine/";

$tests = array(
    array(
        "url"       => PATH . "arrondissements",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "arrondissements",
        "action"    => "POST",
        "login"     =>  "582P41:badpassword",
        "horaires"  => array()
    ),
    array(
        "url"       => PATH . "arrondissements",
        "action"    => "POST",
        "login"     =>  "582P41:ABC123",
        "horaires"  => array()
    ),
    array(
        "url"       => PATH . "arrondissements/10",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "arrondissements/ANJ",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "arrondissements/XXX",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines",
        "action"    => "POST",
        "login"     =>  "582P41:ABC123",
        "horaires"  => array()
    ),
    array(
        "url"       => PATH . "piscines?code3l=OUT",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "arrondissements/OUT/piscines",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines?code3l=XXX",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "arrondissements/XXX/piscines",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/10",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/10",
        "action"    => "POST",
        "login"     =>  "582P41:ABC123",
        "horaires"  => array()
    ),
    array(
        "url"       => PATH . "piscines/100",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/10/xxx",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/100/horaires",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/1/horaires?date=20180503",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/1/horaires?date=XXX",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "POST",
        "login"     => "582P41:badpassword",
        "horaires"  => array(
            array(
                "id_piscine" => 1,
                "jour" => 2,
                "debut" => "10:30",
                "fin" => "19:10"
            ),
            array(
                "id_piscine" => 1,
                "jour" => 4,
                "debut" => "12:30",
                "fin" => "22:10"
            )
        )
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "POST",
        "login"     =>  "582P41:ABC123",
        "horaires"  => array(
            array(
                "id_piscine" => 1,
                "jour" => 2,
                "debut" => "10:30",
                "fin" => "19:10"
            ),
            array(
                "id_piscine" => 2, // incohérence avec l'url
                "jour" => 4,
                "debut" => "12:30",
                "fin" => "22:10"
            )
        )
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "POST",
        "login"     =>  "582P41:ABC123",
        "horaires"  => array(
            array(
                "id_piscine" => 1,
                "jour" => 2,
                "debut" => "20:30", // heure début > heure fin
                "fin" => "19:10"
            ),
            array(
                "id_piscine" => 1,
                "jour" => 4,
                "debut" => "12:30",
                "fin" => "22:10"
            )
        )
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "POST",
        "login"     =>  "582P41:ABC123",
        "horaires"  => array(
            array(
                "id_piscine" => 1,
                "jour" => 2,
                "debut" => "10:30",
                "fin" => "19:10"
            ),
            array(
                "id_piscine" => 1,
                "jour" => 4,
                "debut" => "12:30",
                "fin" => "22:10"
            )
        )
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "GET",
        "login"     =>  ""
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "DELETE",
        "login"     =>  "baduser:badpassword"
    ),
    array(
        "url"       => PATH . "arrondissements",
        "action"    => "DELETE",
        "login"     =>  "582P41:ABC123"
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "DELETE",
        "login"     =>  "582P41:ABC123"
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "POST",
        "login"     =>  "582P41:ABC123",
        "horaires"  => array(
            array(
                "id_piscine" => 1,
                "jour" => 0,
                "debut" => "08:00",
                "fin" => "16:00"
            ),
            array(
                "id_piscine" => 1,
                "jour" => 4,
                "debut" => "09:00",
                "fin" => "11:00"
            )
        )
    ),
    array(
        "url"       => PATH . "piscines/1/horaires",
        "action"    => "GET",
        "login"     =>  ""
    )
);
