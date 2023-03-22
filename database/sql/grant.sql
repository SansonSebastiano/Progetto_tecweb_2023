-- visitors user type: only reader
CREATE USER 'visitors'@'localhost' IDENTIFIED BY 'visitors';
GRANT USAGE ON *.* TO 'visitors'@'localhost';
GRANT SELECT ON `my_elusive`.* TO 'visitors'@'localhost';

-- logged user type: also writer on specific tables
CREATE USER 'logged'@'localhost' IDENTIFIED BY 'logged';
GRANT USAGE ON *.* TO 'visitors'@'localhost';
GRANT SELECT ON `my_elusive`.* TO 'logged'@'localhost';
GRANT INSERT ON `my_elusive`.commento, `my_elusive`.voto TO 'logged'@'localhost';

-- writers user type: also writer on specific tables
CREATE USER 'writers'@'localhost' IDENTIFIED BY 'writers';
GRANT USAGE ON *.* TO 'writers'@'localhost';
GRANT SELECT ON `my_elusive`.* TO 'writers'@'localhost';
GRANT INSERT ON `my_elusive`.commento, `my_elusive`.voto, `my_elusive`.articolo TO 'writers'@'localhost';
GRANT DELETE ON `my_elusive`.view_articolo_utente TO 'writers'@'localhost';

-- admin user type: also writer on specific tables
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT USAGE ON *.* TO 'admin'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON `my_elusive`.* TO 'admin'@'localhost';
