--
-- Structure de la table piscine
--

DROP TABLE IF EXISTS piscine;
CREATE TABLE IF NOT EXISTS piscine (
  id_piscine            int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  type                  varchar(255) NOT NULL,
  nom                   varchar(255) NOT NULL,
  arrondissement_code3l char(3)      NOT NULL,
  adresse               varchar(255) NOT NULL,
  propriete             varchar(255) NOT NULL,
  gestion               varchar(255) NOT NULL,
  PRIMARY KEY (id_piscine),
  CONSTRAINT fk_arrondissement_code3l FOREIGN KEY (arrondissement_code3l) REFERENCES arrondissement(code3l)
) ENGINE=InnoDB  DEFAULT CHARSET=UTF8;

--
-- Contenu de la table piscine
--

SET NAMES UTF8;

INSERT INTO piscine (id_piscine, type, nom, arrondissement_code3l, adresse, propriete, gestion) VALUES
( 1, 'Piscine extérieure', 'Parc Lucie-Bruneau',                     'ANJ', '7 051, Avenue de l’Alsace',      'Municipale', 'Privé'),
( 2, 'Piscine extérieure', 'Parc Chénier',                           'ANJ', '5 555, Avenue de l’Aréna',       'Municipale', 'Privé'),
( 3, 'Piscine extérieure', 'Parc des Roseraies',                     'ANJ', '7 070, Avenue de la Nantaise',   'Municipale', 'Privé'),
( 4, 'Piscine extérieure', 'Parc Roger-Rousseau',                    'ANJ', '7 501, Avenue Rondeau',          'Municipale', 'Privé'),
( 5, 'Piscine extérieure', 'Parc Verdelle',                          'ANJ', '8 441, Place Verdelles',         'Municipale', 'Privé'),
( 6, 'Pataugeoire',        'Parc Talcy',                             'ANJ', '8 151, Avenue Talcy',            'Municipale', 'Privé'),
( 7, 'Pataugeoire',        'Parc Verdelle',                          'ANJ', '8 441, Place Verdelles',         'Municipale', 'Privé'),
( 8, 'Pataugeoire',        'Parc Lucie-Bruneau',                     'ANJ', '7 051, Avenue de l’Alsace',      'Municipale', 'Privé'),
( 9, 'Pataugeoire',        'Parc André-Laurendeau',                  'ANJ', '8 361, Avenue André-Laurendeau', 'Municipale', 'Privé'),
(10, 'Pataugeoire',        'Parc Chénier',                           'ANJ', '5 555, Avenue de l’Aréna',       'Municipale', 'Privé'),
(11, 'Piscine extérieure', 'Parc Lasalle',                           'LAC', '475, 10e Avenue',                'Municipale', 'Municipale'),
(12, 'Piscine extérieure', 'Parc Kirkland',                          'LAC', '150, Rue des Érables',           'Municipale', 'Municipale'),
(13, 'Piscine extérieure', 'Parc Duff-Court',                        'LAC', '1 830, Croissant Roy',           'Municipale', 'Municipale'),
(14, 'Piscine extérieure', 'Parc Dixie',                             'LAC', '695, 54e Avenue',                'Municipale', 'OBNL'),
(15, 'Piscine extérieure', 'Port de Plaisance',                      'LAC', '1 800, Chemin des Iroquois',     'Municipale', 'OBNL'),
(16, 'Pataugeoire',        'Parc Lasalle 1',                         'LAC', '1 950, Remembrance',             'Municipale', 'Municipale'),
(17, 'Piscine intérieure', 'L’Aquadôme LaSalle',                     'LAS', '1 411, Rue Lapierre',            'Municipale', 'Privé'),
(18, 'Piscine extérieure', 'Parc Haymard',                           'LAS', '170, Avenue Orchard',            'Municipale', 'Privé'),
(19, 'Piscine extérieure', 'Parc Lefebvre',                          'LAS', '8 600, Rue Hardy',               'Municipale', 'Privé'),
(20, 'Piscine extérieure', 'Parc Leroux',                            'LAS', '7 540, Rue Centrale',            'Municipale', 'Privé'),
(21, 'Piscine extérieure', 'Parc Raymond',                           'LAS', '555, Boulevard Bishop-Power',    'Municipale', 'Privé'),
(22, 'Piscine extérieure', 'Parc Ouellette (natation et récréatif)', 'LAS', '1 407, Rue Serre',               'Municipale', 'Privé'),
(23, 'Piscine extérieure', 'Parc Ménard',                            'LAS', '300, Rue Clément',               'Municipale', 'Privé'),
(24, 'Piscine extérieure', 'Parc Lacharité',                         'LAS', '55, Avenue Latour',              'Municipale', 'Privé'),
(25, 'Piscine extérieure', 'Parc John-F-Kennedy',                    'OUT', '860, Avenue Outremont',          'Municipale', 'Privé'),
(26, 'Pataugeoire',        'Parc John-F.-Kennedy',                   'OUT', '860, Avenue Outremont',          'Municipale', 'Privé'),
(27, 'Piscine extérieure', 'Parc Arthur-Therrien',                   'VER', '10, Rue Hickson',                'Municipale', 'Municipale'),
(28, 'Piscine extérieure', 'Parc Elgar',                             'VER', '260, Rue Elgar',                 'Municipale', 'Municipale'),
(29, 'Piscine extérieure', 'Parc de la Fontaine',                    'VER', '550, Place de la Fontaine',      'Municipale', 'Municipale'),
(30, 'Piscine extérieure', 'Natatorium de Verdun',                   'VER', '6 500, Boulevard LaSalle',       'Municipale', 'Municipale'),
(31, 'Pataugeoire',        'Parc Arthur-Therrien',                   'VER', '10, Rue Hickson',                'Municipale', 'Municipale'),
(32, 'Pataugeoire',        'Parc Elgar',                             'VER', '260, Rue Elgar',                 'Municipale', 'Municipale'),
(33, 'Pataugeoire',        'Parc de la Fontaine',                    'VER', '550, Place de la Fontaine',      'Municipale', 'Municipale'),
(34, 'Pataugeoire',        'Natatorium de Verdun',                   'VER', '6 500, Boulevard LaSalle',       'Municipale', 'Municipale');