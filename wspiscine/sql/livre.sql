--
-- Structure de la table livre
--

DROP TABLE IF EXISTS livre;
CREATE TABLE livre (
  id     int(11) UNSIGNED  NOT NULL AUTO_INCREMENT,
  titre  varchar(255)      NOT NULL,
  auteur varchar(255)      NOT NULL,
  annee  smallint UNSIGNED NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table livre
--

INSERT INTO livre (id, titre, auteur, annee) VALUES
(1, '1984', 'Orwell', 1948),
(2, 'Autant en emporte le vent', 'Margaret Mitchell', 1936),
(3, 'Moby Dick', 'Herman Melville', 1851),
(4, 'Les 3 mousquetaires', 'Alexandre Dumas', 1844),
(5, '100 ans de solitude', 'G.G. Marquez', 1967),
(6, 'Kafka sur le rivage', 'Murakami', 2002);