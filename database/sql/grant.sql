-- guest user type: only reader
CREATE USER 'guest'@'localhost' IDENTIFIED BY 'guest';
GRANT USAGE ON *.* TO 'guest'@'localhost';
GRANT SELECT ON `my_elusive`.* TO 'guest'@'localhost';

-- logged user type
CREATE USER 'logged'@'localhost' IDENTIFIED BY 'logged';
GRANT USAGE ON *.* TO 'logged'@'localhost';
GRANT SELECT ON `my_elusive`.* TO 'logged'@'localhost';
GRANT INSERT ON `my_elusive`.commento, `my_elusive`.voto TO 'logged'@'localhost';
GRANT INSERT ON `my_elusive`.risposta TO 'logged'@'localhost';

-- writers user type
CREATE USER 'writer'@'localhost' IDENTIFIED BY 'writer';
GRANT USAGE ON *.* TO 'writer'@'localhost';
GRANT SELECT ON `my_elusive`.* TO 'writer'@'localhost';
GRANT INSERT ON `my_elusive`.commento, `my_elusive`.voto, `my_elusive`.articolo, `my_elusive`.articolo_animale TO 'writer'@'localhost';
-- GRANT DELETE ON `my_elusive`.view_articolo_utente TO 'writer'@'localhost';
GRANT DELETE ON `my_elusive`.articolo TO 'writers'@'localhost';

-- admin user type
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT USAGE ON *.* TO 'admin'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON `my_elusive`.* TO 'admin'@'localhost';
