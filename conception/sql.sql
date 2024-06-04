CREATE DATABASE race;
\c race

CREATE TABLE admin(
    id_admin SERIAL PRIMARY KEY,
    email VARCHAR(255),
    mots_de_passe VARCHAR(10)
);

CREATE TABLE genre(
    id_genre SERIAL PRIMARY KEY,
    libelle VARCHAR(100)
);

CREATE TABLE equipe(
    id_equipe SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(255),
    mots_de_passe VARCHAR(100)
);

CREATE TABLE etape(
    id_etape SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    longueur DECIMAL CHECK (longueur > 0),
    nombre_coureur INT CHECK (nombre_coureur > 0),
    rang INT CHECK (rang > 0),
    date_debut TIMESTAMP
);

CREATE TABLE coureur(
    id_coureur SERIAL PRIMARY KEY,
    id_equipe INT REFERENCES equipe(id_equipe),
    nom VARCHAR(100),
    numero_dossard INT,
    id_genre INT REFERENCES genre(id_genre),
    date_naissance DATE
);

CREATE TABLE categorie(
    id_categorie SERIAL PRIMARY KEY,
    libelle VARCHAR(100)
);

CREATE TABLE categorie_coureur(
    id_coureur INT REFERENCES coureur(id_coureur),
    libelle VARCHAR(100)
);

CREATE TABLE points(
    id_point SERIAL PRIMARY KEY,
    rang INT CHECK (rang > 0),
    points INT 
);  

CREATE TABLE temps_coureur(
    id_temps_coureur SERIAL PRIMARY KEY,
    id_etape INT REFERENCES etape(id_etape),
    id_coureur INT REFERENCES coureur(id_coureur),
    temps_depart TIMESTAMP,
    temps_arriver TIMESTAMP
);

CREATE TABLE etape_coureur(
    id_etape_coureur SERIAL PRIMARY KEY,
    id_etape INT REFERENCES etape(id_etape),
    id_coureur INT REFERENCES coureur(id_coureur)
);

CREATE TABLE etape_temp(
    etape VARCHAR(255),
    longueur DECIMAL,
    nombre_coureur INT,
    rang INT,
    date_depart TIMESTAMP
);

CREATE TABLE resultat_temp(
    etape_rang INT,
    numero_dossard INT,
    nom VARCHAR(255),
    genre VARCHAR(100),
    date_naissance DATE,
    equipe VARCHAR(100),
    arrive TIMESTAMP
);

CREATE TABLE points_temp(
    classement INT,
    points INT
);

CREATE TABLE penalite(
    id_etape INT REFERENCES etape(id_etape),
    id_equipe INT REFERENCES equipe(id_equipe),
    temps TIME
);

