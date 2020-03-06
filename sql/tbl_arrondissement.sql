--
-- Structure de la table arrondissement
--

DROP TABLE IF EXISTS arrondissement;
CREATE TABLE IF NOT EXISTS arrondissement (
  code3l   char(3)      NOT NULL,
  nom      varchar(255) NOT NULL,
  acronyme varchar(255) NOT NULL,
  PRIMARY KEY (code3l)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

--
-- Contenu de la table arrondissement
--

SET NAMES UTF8;

INSERT INTO arrondissement ( code3l, nom, acronyme) VALUES
('ANJ', 'Anjou',     'ANJ'),
('LAC', 'Lachine',   'LAC'),
('LAS', 'LaSalle',   'LAS'),
('OUT', 'Outremont', 'OUTR'),
('VER', 'Verdun',    'VER');