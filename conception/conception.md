- admin :
    - id_admin
    - email
    - mots_de_passe

- equipe :
    - id_equipe
    - nom
    - email
    - mots_de_passe

- categorie :
    - id_categorie
    - libelle

- etape :
    - id_etape
    - nom
    - longueur (km)
    - nombreCoureur
    - rang etape

- coureur :
    - id_coureur
    - id_equipe
    - id_categorie
    - nom
    - numero de dossard
    - genre  // 1 = femme, 0 = homme
    - date_naissance

<!-- - equipe_coureur :
    - id_equipe_coureur
    - id_equipe
    - id_coureur -->

- etape_point :
    - id_etape_point
    - id_etape
    - rang
    - point

- temps_coureur :
    - id_temps_coureur
    - id_etape
    - id_coureur
    - temps