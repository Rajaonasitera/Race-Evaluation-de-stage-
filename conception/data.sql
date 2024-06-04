INSERT INTO admin (email, mots_de_passe) VALUES
('admin1@gmail.com', '12345');

INSERT INTO equipe (nom, email, mots_de_passe) VALUES
('Equipe Alpha', 'alpha@gmail.com', '12345'),
('Equipe Beta', 'beta@gmail.com', '012345');

INSERT INTO categorie (libelle) VALUES
    ('Homme'),
    ('Femme'),
    ('Junior'),
    ('Senior');

INSERT INTO genre (libelle) VALUES
    ('F'),
    ('H');

INSERT INTO etape (nom, longueur, nombre_coureur, rang, date_debut) VALUES
    ('Etape 1', 10.5, 4, 1, '2024-06-01 08:00:00'),
    ('Etape 2', 8.2, 4, 2, '2024-06-01 13:00:00'),
    ('Etape 3', 15.7, 4, 3, '2024-06-02 09:00:00');


INSERT INTO coureur (id_equipe, nom, numero_dossard, id_genre, date_naissance) VALUES
    -- Équipe 1
    (1, 'Lova', 101, 2, '1990-05-15'),
    (1, 'Sabrina', 102, 1, '1992-08-21'),
    (1, 'Emma', 103, 1, '1993-06-12'),
    (1, 'Thomas', 104, 2, '1989-09-27'),
    (1, 'Sophie', 105, 1, '1991-12-05'),
    -- Équipe 2
    (2, 'Justin', 201, 2, '1988-03-10'),
    (2, 'Vero', 202, 1, '1991-11-05'),
    (2, 'Michael', 203, 2, '1994-07-18'),
    (2, 'Laura', 204, 1, '1990-04-30'),
    (2, 'Alex', 205, 2, '1993-02-15');


INSERT INTO coureur_categorie (id_coureur, id_categorie) VALUES
    (1, 1),  -- Lova - Homme
    (2, 2),  -- Sabrina - Femme
    (3, 1),  -- Justin - Homme
    (4, 2);  -- Vero - Femme

INSERT INTO points (rang, points) VALUES
    (1,20),
    (2,10),
    (3,8),
    (4,5);