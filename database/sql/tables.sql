
-- Tables creation

CREATE TYPE role AS ENUM ('user','writer','admin');
CREATE SEQUENCE utente_id_seq START 1 INCREMENT 1;      -- id starts from 1 and increments by 1

CREATE TABLE utente (
    id SERIAL, 
    nome VARCHAR(255) NOT NULL, 
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ruolo role NOT NULL,
    PRIMARY KEY(id)
);

CREATE TYPE tag AS ENUM ('scoperta','new-entry','avvistamento','comunicazione','none');
CREATE SEQUENCE articolo_id_seq START 1 INCREMENT 1;    -- id starts from 1 and increments by 1

CREATE TABLE articolo (
    id SERIAL,
    autore INT NOT NULL,
    titolo VARCHAR(255) NOT NULL,
    data TIMESTAMP NOT NULL,
    luogo VARCHAR(255),
    descrizione VARCHAR(255) NOT NULL,
    contenuto VARCHAR(2000) NOT NULL,
    image_path VARCHAR(1024),
    tag tag NOT NULL,
    featured BOOLEAN NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (autore) REFERENCES utente(id)
);

CREATE TYPE state AS ENUM ('scoperto','ipotizzato','avvistato');

CREATE TABLE animale (
    nome VARCHAR(255) NOT NULL UNIQUE,
    descrizione VARCHAR(2000) NOT NULL,
    status state NOT NULL,
    data_scoperta DATE,
    image_path VARCHAR(1024) NOT NULL,
    PRIMARY KEY (nome)
);

CREATE TABLE articolo_animale (
    articolo INT NOT NULL,
    animale VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY(articolo, animale),
    FOREIGN KEY(articolo) REFERENCES articolo(id),
    FOREIGN KEY(animale) REFERENCES animale(nome)
);

CREATE SEQUENCE commento_id_seq START 1 INCREMENT 1;    -- id starts from 1 and increments by 1

CREATE TABLE commento (
    id SERIAL,
    articolo INT NOT NULL,
    utente INT NOT NULL,
    contenuto VARCHAR(255) NOT NULL,
    data TIMESTAMP NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(articolo) REFERENCES articolo(id),
    FOREIGN KEY(utente) REFERENCES utente(id)
);

CREATE TABLE risposta (
    risposta BIGINT NOT NULL,
    padre BIGINT NOT NULL,
    PRIMARY KEY(risposta, padre),
    FOREIGN KEY(risposta) REFERENCES commento(id),
    FOREIGN KEY(padre) REFERENCES commento(id),
    CHECK (risposta <> padre),
    -- TO TESTING
    -- check that the comment 'risposta' is not a reply of another comment 'risposta' (no recursive replies)
    CHECK (NOT EXISTS (SELECT * FROM risposta WHERE risposta = padre), 
           NOT EXISTS (SELECT * FROM risposta WHERE risposta = risposta)),
    --CHECK (risposta NOT IN (SELECT padre FROM risposta )),
    --CHECK (padre NOT IN (SELECT risposta FROM risposta )),
);

CREATE TYPE vote AS ENUM ('YES','NO');

CREATE TABLE voto (
    utente INT NOT NULL,
    animale VARCHAR(255) NOT NULL,
    voto vote NOT NULL,
    PRIMARY KEY(utente,animale),
    FOREIGN KEY(utente) REFERENCES utente(id),
    FOREIGN KEY(animale) REFERENCES animale(nome)
);