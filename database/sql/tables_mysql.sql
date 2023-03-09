--se esistono già cancella le tabelle
DROP TABLE IF EXISTS voto;
DROP TABLE IF EXISTS risposta;
DROP TABLE IF EXISTS commento;
DROP TABLE IF EXISTS articolo_animale;
DROP TABLE IF EXISTS animale;
DROP TABLE IF EXISTS articolo;
DROP TABLE IF EXISTS utente;
--creazione tabelle

CREATE TABLE utente (
    id int NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(255) NOT NULL, 
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ruolo ENUM ('user','writer','admin') NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE articolo (
    id int NOT NULL AUTO_INCREMENT,
    autore INT NOT NULL,
    titolo VARCHAR(255) NOT NULL,
    data TIMESTAMP NOT NULL,
    luogo VARCHAR(255),
    descrizione VARCHAR(255) NOT NULL,
    contenuto VARCHAR(2000) NOT NULL,
    image_path VARCHAR(1024),
    tag ENUM ('scoperta','new-entry','avvistamento','comunicazione','none') NOT NULL,
    featured BOOLEAN NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (autore) REFERENCES utente(id)
);

CREATE TABLE animale (
    nome VARCHAR(100) NOT NULL UNIQUE,
    descrizione VARCHAR(2000) NOT NULL,
    status ENUM ('scoperto','ipotizzato','avvistato') NOT NULL,
    data_scoperta DATE,
    image_path VARCHAR(1024) NOT NULL,
    PRIMARY KEY (nome)
);

CREATE TABLE articolo_animale (
    articolo INT NOT NULL,
    animale VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY(articolo, animale),
    FOREIGN KEY(articolo) REFERENCES articolo(id),
    FOREIGN KEY(animale) REFERENCES animale(nome)
);

CREATE TABLE commento (
    id int NOT NULL AUTO_INCREMENT,
    articolo INT NOT NULL,
    utente INT NOT NULL,
    contenuto VARCHAR(255) NOT NULL,
    data TIMESTAMP NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(articolo) REFERENCES articolo(id),
    FOREIGN KEY(utente) REFERENCES utente(id)
);

CREATE TABLE risposta (
    figlio BIGINT NOT NULL,
    padre BIGINT NOT NULL,
    PRIMARY KEY(figlio, padre),
    FOREIGN KEY(figlio) REFERENCES commento(id),
    FOREIGN KEY(padre) REFERENCES commento(id)
 );

ALTER TABLE risposta
    ADD CONSTRAINT CHECK (figlio <> padre);
    
CREATE TABLE voto (
    utente INT NOT NULL,
    animale VARCHAR(100) NOT NULL,
    voto ENUM ('YES','NO') NOT NULL,
    PRIMARY KEY(utente,animale),
    FOREIGN KEY(utente) REFERENCES utente(id),
    FOREIGN KEY(animale) REFERENCES animale(nome)
);
