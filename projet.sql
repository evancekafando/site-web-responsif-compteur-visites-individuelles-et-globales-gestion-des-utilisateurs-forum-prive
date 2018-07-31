-- Compteur de visites
CREATE TABLE IF NOT EXISTS t_compteur
( compteur)id INT NOT NULL AUTO_INCREMENT,
  adr_ip VARCHAR(50),
  user_agent VARCHAR(100),
  vdate DATETIME NOT NULL,
  compteur INT(15) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Questionnaire
CREATE TABLE IF NOT EXISTS t_questions
( question_id int(11) NOT NULL,
  question MEDIUMTEXT COLLATE utf8_bin NOT NULL,
  PRIMARY KEY(question_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS t_choix
( question_id int(11) NOT NULL,
  choix_id int(11) NOT NULL,
  choix MEDIUMTEXT COLLATE utf8_bin NOT NULL,
  PRIMARY KEY(choix_id),
  FOREIGN KEY(question_id) REFERENCES t_questions(question_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS t_reponses
( reponse_id INT(11) NOT NULL,
  question_id int(11) NOT NULL,
  choix_id int(11) DEFAULT NULL,
  texte MEDIUMTEXT COLLATE utf8_bin,
  PRIMARY KEY(reponse_id),
  FOREIGN KEY(question_id, choix_id) REFERENCES t_choix(question_id, choix_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Utilisateurs
CREATE TABLE IF NOT EXISTS t_utilisateurs
( u_id INT(11) NOT NULL,
  u_prenom VARCHAR(50) NOT NULL,
  u_nom VARCHAR(50) NOT NULL,
  u_programme VARCHAR(50) NOT NULL,
  u_courriel VARCHAR(50) NOT NULL,
  u_login VARCHAR(50) NOT NULL,
  u_passe VARCHAR(50) NOT NULL,
  u_creation DATETIME NOT NULL,
  u_role CHAR(2) NOT NULL,
  PRIMARY KEY(u_id),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Forum privé
CREATE TABLE IF NOT EXISTS t_fils
(
  fil_id INT(11) NOT NULL,
  fil_titre VARCHAR(100) NOT NULL,
  fil_creation DATETIME NOT NULL,
  PRIMARY KEY(fil_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS t_forum
( forum_id INT(11) NOT NULL,
  u_id INT(11) NOT NULL,
  fil_id INT(11) NOT NULL,
  u_message TEXT NOT NULL,
  u_date DATETIME NOT NULL,
  PRIMARY KEY(forum_id),
  FOREIGN KEY(u_id) REFERENCES t_utilisateurs(u_id)
    ON DELETE CASCADE ON UPDATE CASCADE
  FOREIGN KEY(fil_id) REFERENCES t_fils(fil_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Lieux
CREATE TABLE IF NOT EXISTS t_lieux
( lieu_id INT(11) NOT NULL PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  ville VARCHAR(100),
  pays VARCHAR(100) NOT NULL,
  lat FLOAT NOT NULL,
  lng FLOAT NOT NULL,
  alt FLOAT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

