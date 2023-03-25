-- Views creation

    -- create view with articolo and his author
CREATE VIEW view_articolo_utente 
AS SELECT articolo.id, utente.nome, articolo.titolo, articolo.data, articolo.luogo, articolo.descrizione, articolo.contenuto, articolo.image_path, articolo.tag, articolo.featured
FROM articolo INNER JOIN utente ON articolo.autore = utente.id;
    
    -- create view with articolo, his author and his animals 
CREATE VIEW view_articolo_animale
AS SELECT view_articolo_utente.id, view_articolo_utente.nome, view_articolo_utente.titolo, articolo_animale.animale
FROM view_articolo_utente INNER JOIN articolo_animale ON view_articolo_utente.id = articolo_animale.articolo;
    
    -- create view with articolo and his comments
CREATE VIEW view_articolo_commento
AS SELECT articolo.id as articolo, commento.id as commento, utente.nome, commento.contenuto, commento.data
FROM articolo INNER JOIN commento ON articolo.id = commento.articolo INNER JOIN utente ON commento.utente = utente.id;
    
    -- create view with articolo, his comments and his answers
CREATE VIEW view_articolo_commento_risposta
AS SELECT view_articolo_commento.articolo, view_articolo_commento.commento, view_articolo_commento.nome, view_articolo_commento.contenuto, view_articolo_commento.data, risposta.figlio, utente.nome as nome_risposta, commento.contenuto as contenuto_risposta, commento.data as data_risposta
FROM view_articolo_commento INNER JOIN risposta ON view_articolo_commento.commento = risposta.padre 
INNER JOIN commento ON risposta.figlio = commento.id INNER JOIN utente ON commento.utente = utente.id;

    -- create view with animals and his votes
CREATE VIEW view_animale_voto
AS SELECT animale.nome, voto.voto
FROM animale LEFT JOIN voto ON animale.nome = voto.animale;

    -- create view with animals, his votes grouped by 'nome' and count of 'voto' (YES)
CREATE VIEW vote_YES
AS SELECT animale.nome, COUNT(voto) as YES
FROM animale LEFT JOIN voto ON animale.nome = voto.animale
WHERE voto='YES'
GROUP BY animale.nome;

    -- create view with animals, his votes grouped by 'nome' and count of 'voto' (NO)
CREATE VIEW vote_NO
AS SELECT animale.nome, COUNT(voto) as NO
FROM animale LEFT JOIN voto ON animale.nome = voto.animale
WHERE voto='NO'
GROUP BY animale.nome;

    -- create view with animals, his votes grouped by 'nome' and count of 'voto' (YES) and (NO)
CREATE VIEW view_animale_voto_2
AS SELECT animale.nome, vote_YES.YES, vote_NO.NO
FROM animale, vote_YES, vote_NO
WHERE animale.nome = vote_YES.nome AND animale.nome = vote_NO.nome;