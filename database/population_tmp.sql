-- Populate tables

    -- Utenti
INSERT INTO utente VALUES (nextval('utente_id_seq') ,'admin','admin','admin@eLusive.com','admin'),
                          (nextval('utente_id_seq') ,'user','user','user@eLusive.com','user'),
                          (nextval('utente_id_seq') ,'writer','writer','writer@eLusive.com','writer');

    -- Articoli
INSERT INTO articolo VALUES (nextval('articolo_id_seq') ,3,'Articolo di prova 1','2021-01-01 00:00:00','Descrizione di prova 1','Contenuto di prova 1','','scoperta',true),
                            (nextval('articolo_id_seq') ,3,'Articolo di prova 2','2021-01-01 00:00:00','Descrizione di prova 2','Contenuto di prova 2','','new-entry',true),
                            (nextval('articolo_id_seq') ,3,'Articolo di prova 3','2021-01-01 00:00:00','Descrizione di prova 3','Contenuto di prova 3','','avvistamento',true),
                            (nextval('articolo_id_seq') ,3,'Articolo di prova 4','2021-01-01 00:00:00','Descrizione di prova 4','Contenuto di prova 4','','comunicazione',false),
                            (nextval('articolo_id_seq') ,3,'Articolo di prova 5','2021-01-01 00:00:00','Descrizione di prova 5','Contenuto di prova 5','','none',true);

    -- Animali
INSERT INTO animale VALUES ('Animale di prova 1','Descrizione di prova 1','scoperto','2021-01-01',''),
                           ('Animale di prova 2','Descrizione di prova 2','ipotizzato',null,''),
                           ('Animale di prova 3','Descrizione di prova 3','avvistato',null,'');

    -- Articolo-Animale
INSERT INTO articolo_animale VALUES (1,'Animale di prova 1'),
                                    (2,'Animale di prova 2'),
                                    (3,'Animale di prova 3');

    -- Commenti
INSERT INTO commento VALUES (nextval('commento_id_seq') ,1,2,'Commento di prova 1','2021-01-01 00:00:00'),
                            (nextval('commento_id_seq') ,1,2,'Commento di prova 2','2021-01-01 00:00:00'),
                            (nextval('commento_id_seq') ,3,2,'Commento di prova 3','2021-01-01 00:00:00'),
                            (nextval('commento_id_seq') ,3,2,'Commento di prova 4','2021-01-01 00:00:00'),
                            (nextval('commento_id_seq') ,2,2,'Commento di prova 5','2021-01-01 00:00:00');

    -- Risposte
INSERT INTO risposta VALUES (2,1),
                            (3,2);

    -- Voti
INSERT INTO voto VALUES (1,'Animale di prova 1','YES'),
                        (1, 'Animale di prova 2','YES'),
                        (1, 'Animale di prova 3','NO'),
                        (2,'Animale di prova 1','YES'),
                        (2,'Animale di prova 2','NO'),
                        (2,'Animale di prova 3','YES'),
                        (3,'Animale di prova 1','YES'),
                        (3,'Animale di prova 2','NO'),
                        (3,'Animale di prova 3','YES');
                        