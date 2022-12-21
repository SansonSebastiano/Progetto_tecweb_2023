
CREATE TABLE utente (
    id INT NOT NULL, 
    nome VARCHAR(255) NOT NULL, 
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ruolo ENUM("user","writer","admin") NOT NULL,
    PRIMARY KEY(id)
);µ

CREATE TABLE articolo (
    id INT NOT NULL,
    autore INT NOT NULL,
    titolo VARCHAR(255) NOT NULL,
    data DATETIME NOT NULL,
    descrizione VARCHAR(255) NOT NULL,
    contenuto VARCHAR(2000) NOT NULL,
    image_path VARCHAR(1024)
    tag ENUM("scoperta","new-entry","avvistamento","comunicazione","none") NOT NULL,
    featured BOOLEAN NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (autore) REFERENCES utente(id)
);

CREATE TABLE animale (
    nome VARCHAR(255) NOT NULL UNIQUE,
    descrizione VARCHAR(2000) NOT NULL,
    status ENUM("scoperto","ipotizzato","avvistato") NOT NULL,
    data_scoperta DATE,
    image_path VARCHAR(1024) NOT NULL
    PRIMARY KEY (nome)
);

CREATE TABLE articolo_animale (
    articolo INT NOT NULL,
    animale VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY(articolo, animale),
    FOREIGN KEY(articolo) REFERENCES articolo(id),
    FOREIGN KEY(animale) REFERENCES animale(id)
);

CREATE TABLE commento (
    id BIGINT NOT NULL,
    articolo INT NOT NULL,
    utente INT NOT NULL,
    contenuto VARCHAR(255) NOT NULL,
    data DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(articolo) REFERENCES articolo(id),
    FOREIGN KEY(utente) REFERENCES utente(id)
);

CREATE TABLE risposta (
    risposta BIGINT NOT NULL,
    padre BIGINT NOT NULL,
    PRIMARY KEY(risposta, padre),
    FOREIGN KEY(risposta) REFERENCES commento(id),
    FOREIGN KEY(padre) REFERENCES commento(id)
);

CREATE TABLE voto (
    utente INT,
    animale INT,
    voto ENUM("YES","NO"),
    PRIMARY KEY(utente,animale),
    FOREIGN KEY(utente) REFERENCES utente(id),
    FOREIGN KEY(animale) REFERENCES animale(id)
);


