--
-- Structure de la table horaire
--

DROP TABLE IF EXISTS horaire;
CREATE TABLE horaire (
  id_piscine int(10)    UNSIGNED NOT NULL,
  jour       tinyint(3) UNSIGNED NOT NULL COMMENT 'dim = 0, sam = 6',
  debut      time                NOT NULL,
  fin        time                NOT NULL,
  PRIMARY KEY (id_piscine, jour),
  CONSTRAINT fk_id_piscine FOREIGN KEY (id_piscine) REFERENCES piscine(id_piscine)
) ENGINE=InnoDB  DEFAULT CHARSET=UTF8;

--
-- Contenu de la table horaire
--

SET NAMES UTF8;

INSERT INTO horaire VALUES( 1, 4, '09:00:00', '11:00:00');
INSERT INTO horaire VALUES( 1, 0, '08:00:00', '16:00:00');
