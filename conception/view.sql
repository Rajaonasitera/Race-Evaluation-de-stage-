-- CREATE VIEW classement_etape AS
-- SELECT 
--     id_etape,
--     id_coureur,
--     temps,
--     ROW_NUMBER() OVER (PARTITION BY id_etape ORDER BY temps ASC) AS rang
-- FROM 
--     temps_coureur;

-- CREATE  OR REPLACE  VIEW classement_etape AS
-- SELECT 
--     id_etape,
--     id_coureur,
--     temps_depart,
--     temps_arriver,
--     RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang
-- FROM 
--     temps_coureur;

-- SELECT 
--     temps_coureur.id_etape,
--     coureur.id_coureur,
--     coureur.id_equipe,
--     temps_coureur.temps_depart,
--     temps_coureur.temps_arriver AS temp_arriver_reel,
--     COALESCE(temps_coureur.temps_arriver + COALESCE(penalite.temps, NULL),temps_coureur.temps_arriver) AS temps_arriver,
--     DENSE_RANK() OVER (PARTITION BY temps_coureur.id_etape ORDER BY COALESCE(temps_coureur.temps_arriver + COALESCE(penalite.temps, NULL),temps_coureur.temps_arriver) ASC) AS rang
-- FROM 
--     temps_coureur
-- JOIN 
--     coureur ON temps_coureur.id_coureur = coureur.id_coureur
-- JOIN 
--     equipe ON coureur.id_equipe = equipe.id_equipe
-- JOIN 
--     etape ON temps_coureur.id_etape = etape.id_etape
-- LEFT JOIN 
--     penalite ON temps_coureur.id_etape = penalite.id_etape AND coureur.id_equipe = penalite.id_equipe;


-- SELECT id_equipe, sum(points) as points FROM (
--                         SELECT 
--                             tables.id_etape,
--                             tables.id_coureur,
--                             tables.id_equipe,
--                             tables.temps_depart,
--                             tables.temps_arriver,
--                             tables.rang,
--                             COALESCE(points.points, 0) AS points 
--                         FROM 
--                             (
--                                 SELECT 
--                                     temps_coureur.id_etape,
--                                     temps_coureur.id_coureur,
--                                     coureur.id_equipe,
--                                     temps_coureur.temps_depart,
--                                     temps_coureur.temps_arriver AS temp_arriver_reel,
--                                     COALESCE(temps_coureur.temps_arriver + COALESCE(penalite.temps, NULL),temps_coureur.temps_arriver) AS temps_arriver,
--                                     DENSE_RANK() OVER (PARTITION BY temps_coureur.id_etape ORDER BY COALESCE(temps_coureur.temps_arriver + COALESCE(penalite.temps, NULL),temps_coureur.temps_arriver) ASC) AS rang
--                                 FROM 
--                                     temps_coureur,coureur
--                                     LEFT JOIN 
--                                     penalite ON temps_coureur.id_etape = penalite.id_etape AND coureur.id_equipe = penalite.id_equipe
--                                 WHERE temps_coureur.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = '".$categorie."') 
--                                 AND temps_coureur.id_coureur = coureur.id_coureur
--                             ) as tables
--                         LEFT JOIN 
--                             points 
--                             ON tables.rang = points.rang
--                         ORDER BY id_etape ASC, rang ASC
--                     ) as tab 
--                     GROUP BY id_equipe
--                     ORDER BY points DESC;



-- SELECT id_equipe, sum(points) as points 
-- FROM (
--     SELECT 
--         tables.id_etape,
--         tables.id_coureur,
--         tables.id_equipe,
--         tables.temps_depart,
--         tables.temps_arriver,
--         tables.rang,
--         COALESCE(points.points, 0) AS points 
--     FROM 
--         (
--             SELECT 
--                 id_etape,
--                 id_coureur,
--                 id_equipe,
--                 temps_depart,
--                 temp_arriver_reel,
--                 temps_arriver,
--                 DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang 
--             FROM (
--                             SELECT 
--                                 temps_coureur.id_etape,
--                                 coureur.id_coureur,
--                                 coureur.id_equipe,
--                                 temps_coureur.temps_depart,
--                                 temps_coureur.temps_arriver AS temp_arriver_reel,
--                                 COALESCE(temps_coureur.temps_arriver + COALESCE(penalites.temps, NULL),temps_coureur.temps_arriver) AS temps_arriver
--                             FROM 
--                                 temps_coureur
--                             JOIN 
--                                 coureur ON temps_coureur.id_coureur = coureur.id_coureur
--                             JOIN 
--                                 equipe ON coureur.id_equipe = equipe.id_equipe
--                             JOIN 
--                                 etape ON temps_coureur.id_etape = etape.id_etape
--                             LEFT JOIN 
--                                 (SELECT id_etape, id_equipe, sum(temps) AS temps FROM penalite GROUP BY id_etape, id_equipe) 
--                                 AS penalites 
--                                 ON temps_coureur.id_etape = penalites.id_etape AND coureur.id_equipe = penalites.id_equipe
--             ) AS temps WHERE temps.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = 'F')
--         ) as tables
--     LEFT JOIN 
--         points 
--         ON tables.rang = points.rang
--     ORDER BY id_etape ASC, rang ASC
-- ) as tab 
-- GROUP BY id_equipe
-- ORDER BY points DESC;


CREATE OR REPLACE VIEW classement_etape AS
SELECT 
    temps_coureur.id_etape,
    coureur.id_coureur,
    coureur.id_equipe,
    temps_coureur.temps_depart,
    temps_coureur.temps_arriver AS temp_arriver_reel,
    COALESCE(temps_coureur.temps_arriver + COALESCE(penalite.temps, NULL),temps_coureur.temps_arriver) AS temps_arriver,
    DENSE_RANK() OVER (PARTITION BY temps_coureur.id_etape ORDER BY COALESCE(temps_coureur.temps_arriver + COALESCE(penalite.temps, NULL),temps_coureur.temps_arriver) ASC) AS rang
FROM 
    temps_coureur
JOIN 
    coureur ON temps_coureur.id_coureur = coureur.id_coureur
JOIN 
    equipe ON coureur.id_equipe = equipe.id_equipe
JOIN 
    etape ON temps_coureur.id_etape = etape.id_etape
LEFT JOIN 
    (SELECT id_etape, id_equipe, sum(temps) AS temps FROM penalite GROUP BY id_etape, id_equipe) as penalite ON temps_coureur.id_etape = penalite.id_etape AND coureur.id_equipe = penalite.id_equipe;



CREATE  OR REPLACE  VIEW classement_etape_points AS
SELECT 
    classement_etape.id_etape,
    classement_etape.id_coureur,
    coureur.nom,
    genre.libelle,
    coureur.date_naissance,
    CAST((current_date - coureur.date_naissance) / 365.25 AS INTEGER) as age,
    equipe.id_equipe as id_equipe,
    equipe.nom as equipe,
    classement_etape.temps_depart,
    classement_etape.temps_arriver,
    (classement_etape.temps_arriver - classement_etape.temps_depart) as duree,
    classement_etape.rang,
    COALESCE(points.points, 0) AS points
FROM 
    classement_etape
LEFT JOIN 
    points 
    ON classement_etape.rang = points.rang
LEFT JOIN 
    coureur 
    ON classement_etape.id_coureur = coureur.id_coureur
LEFT JOIN 
    genre 
    ON coureur.id_genre = genre.id_genre
LEFT JOIN 
    equipe 
    ON coureur.id_equipe = equipe.id_equipe
ORDER BY classement_etape.id_etape;




CREATE OR REPLACE VIEW classement_equipe AS
SELECT classement_etape_points.id_coureur, 
        coureur.nom,
        coureur.id_equipe ,
        sum(classement_etape_points.points) as somme
FROM classement_etape_points
LEFT JOIN 
    coureur
    ON classement_etape_points.id_coureur = coureur.id_coureur
GROUP BY classement_etape_points.id_coureur, coureur.nom, coureur.id_equipe 
ORDER BY somme DESC;





CREATE OR REPLACE VIEW classement_general AS
SELECT id_coureur, 
        id_equipe,
        nom,
        sum(points) as somme
FROM classement_etape_points
GROUP BY id_coureur, nom, id_equipe
ORDER BY somme DESC;





CREATE OR REPLACE VIEW classement_general_equipe AS
SELECT id_equipe,
        sum(somme) as points,
        DENSE_RANK() OVER (ORDER BY sum(somme) DESC) AS rang
FROM classement_equipe
 GROUP BY id_equipe;




-- CREATE OR REPLACE VIEW classement_general_equipe AS
-- SELECT id_equipe,
--         sum(somme) as points
-- FROM classement_equipe
-- GROUP BY id_equipe
-- ORDER BY points DESC;


CREATE OR REPLACE VIEW classement_general_etape AS 
SELECT id_etape, 
        id_equipe, 
        sum(points) 
FROM classement_etape_points 
GROUP BY id_etape, id_equipe 
ORDER BY id_etape , sum DESC;

-- SELECT id_equipe, 
--     sum(points) as points,
--      DENSE_RANK() OVER (ORDER BY sum(points) DESC) AS rang
-- FROM (
--     SELECT 
--         tables.id_etape,
--         tables.id_coureur,
--         tables.id_equipe,
--         tables.temps_depart,
--         tables.temps_arriver,
--         tables.rang,
--         COALESCE(points.points, 0) AS points 
--     FROM 
--         (
--             SELECT 
--                 id_etape,
--                 id_coureur,
--                 id_equipe,
--                 temps_depart,
--                 temp_arriver_reel,
--                 temps_arriver,
--                 DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang 
--             FROM (
--                             SELECT 
--                                 temps_coureur.id_etape,
--                                 coureur.id_coureur,
--                                 coureur.id_equipe,
--                                 temps_coureur.temps_depart,
--                                 temps_coureur.temps_arriver AS temp_arriver_reel,
--                                 COALESCE(temps_coureur.temps_arriver + COALESCE(penalites.temps, NULL),temps_coureur.temps_arriver) AS temps_arriver
--                             FROM 
--                                 temps_coureur
--                             JOIN 
--                                 coureur ON temps_coureur.id_coureur = coureur.id_coureur
--                             JOIN 
--                                 equipe ON coureur.id_equipe = equipe.id_equipe
--                             JOIN 
--                                 etape ON temps_coureur.id_etape = etape.id_etape
--                             LEFT JOIN 
--                                 (SELECT id_etape, id_equipe, sum(temps) AS temps FROM penalite GROUP BY id_etape, id_equipe) 
--                                 AS penalites 
--                                 ON temps_coureur.id_etape = penalites.id_etape AND coureur.id_equipe = penalites.id_equipe
--             ) AS temps WHERE temps.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = 'F')
--         ) as tables
--     LEFT JOIN 
--         points 
--         ON tables.rang = points.rang
--     ORDER BY id_etape ASC, rang ASC
-- ) as tab 
-- GROUP BY id_equipe;

-- SELECT 
--     id_etape,
--     id_coureur,
--     id_equipe,
--     temps_depart,
--     temp_arriver_reel,
--     temps_arriver,
--     DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang 
-- FROM (
--                 SELECT 
--                     temps_coureur.id_etape,
--                     coureur.id_coureur,
--                     coureur.id_equipe,
--                     temps_coureur.temps_depart,
--                     temps_coureur.temps_arriver AS temp_arriver_reel,
--                     COALESCE(temps_coureur.temps_arriver + COALESCE(penalites.temps, NULL),temps_coureur.temps_arriver) AS temps_arriver
--                 FROM 
--                     temps_coureur
--                 JOIN 
--                     coureur ON temps_coureur.id_coureur = coureur.id_coureur
--                 JOIN 
--                     equipe ON coureur.id_equipe = equipe.id_equipe
--                 JOIN 
--                     etape ON temps_coureur.id_etape = etape.id_etape
--                 LEFT JOIN 
--                     (SELECT id_etape, id_equipe, sum(temps) AS temps FROM penalite GROUP BY id_etape, id_equipe) 
--                     AS penalites 
--                     ON temps_coureur.id_etape = penalites.id_etape AND coureur.id_equipe = penalites.id_equipe
-- ) AS temps WHERE temps.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = 'F');
-- INSERT INTO categorie(libelle)
-- SELECT DISTINCT 
--                 libelle
-- FROM categorie_coureur;


-- SELECT 
--     tables.id_etape,
--     tables.id_coureur,
--     tables.id_equipe,
--     tables.temps_depart,
--     tables.temps_arriver,
--     tables.rang,
--     COALESCE(points.points, 0) AS points 
-- FROM 
--     (
--         SELECT 
--             temps_coureur.id_etape,
--             temps_coureur.id_coureur,
--             coureur.id_equipe,
--             temps_coureur.temps_depart,
--             temps_coureur.temps_arriver,
--             DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang
--         FROM 
--             temps_coureur,coureur
--         WHERE temps_coureur.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = 'M') 
--         AND temps_coureur.id_coureur = coureur.id_coureur 
--     ) as tables
-- LEFT JOIN 
--     points 
--     ON tables.rang = points.rang
-- ORDER BY id_etape ASC, rang ASC;

-- SELECT id_equipe, sum(points) as points FROM (
-- SELECT 
--             tables.id_etape,
--             tables.id_coureur,
--             tables.id_equipe,
--             tables.temps_depart,
--             tables.temps_arriver,
--             tables.rang,
--             COALESCE(points.points, 0) AS points 
--         FROM 
--             (
--                 SELECT 
--                     temps_coureur.id_etape,
--                     temps_coureur.id_coureur,
--                     coureur.id_equipe,
--                     temps_coureur.temps_depart,
--                     temps_coureur.temps_arriver,
--                     DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang
--                 FROM 
--                     temps_coureur,coureur
--                 WHERE temps_coureur.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = 'M') 
--                 AND temps_coureur.id_coureur = coureur.id_coureur
--             ) as tables
--         LEFT JOIN 
--             points 
--             ON tables.rang = points.rang
--         ORDER BY id_etape ASC, rang ASC
-- ) as tab WHERE tab.id_etape = 1 
-- GROUP BY id_equipe
-- ORDER BY points DESC;

-- SELECT id_equipe, sum(points) as points FROM (
-- SELECT 
--             tables.id_etape,
--             tables.id_coureur,
--             tables.id_equipe,
--             tables.temps_depart,
--             tables.temps_arriver,
--             tables.rang,
--             COALESCE(points.points, 0) AS points 
--         FROM 
--             (
--                 SELECT 
--                     temps_coureur.id_etape,
--                     temps_coureur.id_coureur,
--                     coureur.id_equipe,
--                     temps_coureur.temps_depart,
--                     temps_coureur.temps_arriver,
--                     DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang
--                 FROM 
--                     temps_coureur,coureur
--                 WHERE temps_coureur.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = 'M') 
--                 AND temps_coureur.id_coureur = coureur.id_coureur
--             ) as tables
--         LEFT JOIN 
--             points 
--             ON tables.rang = points.rang
--         ORDER BY id_etape ASC, rang ASC
-- ) as tab 
-- GROUP BY id_equipe
-- ORDER BY points DESC;

-- SELECT * 
-- FROM coureur 
-- WHERE id_equipe = 1 
-- AND id_coureur NOT IN(SELECT id_coureur FROM etape_coureur WHERE id_etape = 2);
-- INSERT INTO etape (nom,longueur,nombre_coureur,rang,date_debut)
--     SELECT DISTINCT 
--         etape,
--         longueur,
--         nombre_coureur,
--         rang,
--         date_depart
--     FROM etape_temp;

-- INSERT INTO equipe (nom,email,mots_de_passe)
--     SELECT DISTINCT 
--         equipe,
--         equipe,
--         equipe        
--     FROM resultat_temp;

-- INSERT INTO genre (libelle)
--     SELECT DISTINCT 
--         genre   
--     FROM resultat_temp;

-- INSERT INTO coureur (id_equipe,nom,numero_dossard,id_genre,date_naissance)
-- SELECT DISTINCT 
--                 equipe.id_equipe, 
--                 resultat_temp.nom, 
--                 resultat_temp.numero_dossard, 
--                 genre.id_genre,
--                 resultat_temp.date_naissance
-- FROM resultat_temp 
-- INNER JOIN equipe
--     ON resultat_temp.equipe = equipe.nom
-- INNER JOIN genre
--     ON resultat_temp.genre = genre.libelle;

-- INSERT INTO temps_coureur (id_etape,id_coureur,temps_depart,temps_arriver)
-- SELECT DISTINCT 
--                 etape.id_etape, 
--                 coureur.id_coureur, 
--                 etape.date_debut,
--                 resultat_temp.arrive
-- FROM resultat_temp 
-- INNER JOIN etape
--     ON resultat_temp.etape_rang = etape.rang
-- INNER JOIN coureur
--     ON resultat_temp.numero_dossard = coureur.numero_dossard;

-- INSERT INTO etape_coureur (id_etape,id_coureur)
-- SELECT DISTINCT 
--                 etape.id_etape, 
--                 coureur.id_coureur
-- FROM resultat_temp 
-- INNER JOIN etape
--     ON resultat_temp.etape_rang = etape.rang
-- INNER JOIN coureur
--     ON resultat_temp.numero_dossard = coureur.numero_dossard;

-- drop view classement_etape_points cascade;

-- CREATE OR REPLACE etape_equipe
-- SELECT 
--     etape_coureur.id_etape,
--     etape_coureur.id_coureur,
--     temps_coureur.temps_arriver
-- FROM etape_coureur
-- LEFT JOIN temps_coureur
-- ON etape_coureur.id_etape = temps_coureur.id_etape
-- AND etape_coureur.id_coureur = temps_coureur.id_coureur;


-- SELECT * FROM (SELECT 
--     etape_coureur.id_etape,
--     etape_coureur.id_coureur,
--     etape.date_debut,
--     temps_coureur.temps_arriver,
--     (temps_coureur.temps_arriver - etape.date_debut) as chrono
-- FROM etape_coureur
-- LEFT JOIN temps_coureur
-- ON etape_coureur.id_etape = temps_coureur.id_etape
-- AND etape_coureur.id_coureur = temps_coureur.id_coureur
-- LEFT JOIN etape
-- ON etape.id_etape = etape_coureur.id_etape
-- ORDER BY etape.rang ASC) as tab
-- WHERE tab.temps_arriver IS NULL AND id_etape = 2;