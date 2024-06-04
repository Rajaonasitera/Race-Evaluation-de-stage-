<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');
date_default_timezone_set('Europe/Moscow'); 
class Import_resultat_model extends CI_Model
{
    public function get($file_path){
        try {
            $error_messages['type'] = array();
            $error_messages['probleme'] = array();
            if (($handle = fopen($file_path, "r")) !== FALSE) {
                $data_to_insert = array();
                $row_count = 0;
                $er = 0;
                while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $row_count++;
                    if ($row_count == 1) {
                        continue;
                    }
                    // var_dump($row);
                    if (count($row) == 7) {
                        // $annee = trim($row[4]);
                        // $heure = trim($row[5]);
                        // $dateTime = $annee . ' ' . $heure;
                        if ($row[6]=='') {
                            $dateT = NULL;
                        }else{
                            $dateTime = DateTime::createFromFormat('d/m/Y H:i:s', trim($row[6]));
                            $dateT = $dateTime->format('Y-m-d H:i:s');
                        }
                        
                        $dt = DateTime::createFromFormat('d/m/Y', trim($row[4]));
                        $dtn = $dt->format('Y-m-d');
                        
                        // if ($dateTime === false) {
                        //     $error_messages[] = "Format error $row_count.";
                        //     $probleme[] = $dateTime;
                        // }else{
                        //     $dateT = $date->format('Y-m-d H:i:s');
                        // }                        
                        // $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
                        $data_to_insert[] = array(
                            'object' => array(
                                'etape_rang' => str_replace(',', '.', trim($row[0])),
                                'numero_dossard' => str_replace(',', '.', trim($row[1])),
                                'nom' => str_replace("'", "'''",trim($row[2])),
                                'genre' => str_replace("'", "'''",trim($row[3])),
                                'date_naissance' => $dtn,
                                'equipe' => str_replace("'", "'''",trim($row[5])),
                                'arrive' => $dateT,
                            ),
                            'ligne' => $row_count
                        );
                    } else {
                        $error_messages['type'][$er] = "Le nombre de colonnes est incorrect dans la ligne $row_count.";
                        $error_messages['probleme'][$er] = $row_count;
                        $er += 1;
                    }
                }
            }
            // var_dump($data_to_insert);
            $result['erreur'] = $error_messages;
            $result['data'] = $data_to_insert;
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    } 

    public function test($data){
        try {
            $data['ok'] = array();
            foreach ($data['data'] as $one) {
                $etape = str_replace(',', '.', $one['object']['etape_rang']);
                $numero = str_replace(',', '.', $one['object']['numero_dossard']);
                // $rang = str_replace(',', '.', $one['object']['rang']);
                if (!is_numeric($etape)||!is_numeric($numero)) {
                    $bla['type'] = "Probleme de parse a la ligne ".$one['ligne'];
                    $bla['probleme'] =  $one['object'];
                    $data['erreur']['type'][] = $bla;
                    $data['erreur']['probleme'][] = $bla;
                }else{
                    $data['ok'][] = $one;
                }
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }  
    }

    public function temp($data){
        if (count($data['erreur']['type'])!=0) {
            $er = $data['erreur']['type'][0];
            // var_dump(count($data['erreur']['type]));
                for ($i=1; $i < count($data['erreur']['type']) ;$i++) { 
                   $er = $er ." <br> ". $data['erreur']['type'][$i]; 
                }
                foreach ($data['ok'] as $one) {
                    if ($one['object']['arrive']==NULL) {
                    $this->db->query("INSERT INTO resultat_temp (etape_rang, numero_dossard, nom, genre, date_naissance, equipe, arrive) VALUES ('".$one['object']['etape_rang']."',".$one['object']['numero_dossard'].",'".$this->db->escape_str($one['object']['nom'])."','".$this->db->escape_str($one['object']['genre'])."','".$one['object']['date_naissance']."','".$one['object']['equipe']."',NULL);");
                }else{
                    $this->db->query("INSERT INTO resultat_temp (etape_rang, numero_dossard, nom, genre, date_naissance, equipe, arrive) VALUES ('".$one['object']['etape_rang']."',".$one['object']['numero_dossard'].",'".$this->db->escape_str($one['object']['nom'])."','".$this->db->escape_str($one['object']['genre'])."','".$one['object']['date_naissance']."','".$one['object']['equipe']."','".$one['object']['arrive']."');");
                }
                }

                $data['erreur'] = $er;
                // $this->load->view('erreurcsv',$data);
                // throw new Exception($er);
        }else{
            foreach ($data['ok'] as $one) {
                // var_dump($data['data']);
                if ($one['object']['arrive']==NULL) {
                    $this->db->query("INSERT INTO resultat_temp (etape_rang, numero_dossard, nom, genre, date_naissance, equipe, arrive) VALUES ('".$one['object']['etape_rang']."',".$one['object']['numero_dossard'].",'".$this->db->escape_str($one['object']['nom'])."','".$this->db->escape_str($one['object']['genre'])."','".$one['object']['date_naissance']."','".$one['object']['equipe']."',NULL);");
                }else{
                    $this->db->query("INSERT INTO resultat_temp (etape_rang, numero_dossard, nom, genre, date_naissance, equipe, arrive) VALUES ('".$one['object']['etape_rang']."',".$one['object']['numero_dossard'].",'".$this->db->escape_str($one['object']['nom'])."','".$this->db->escape_str($one['object']['genre'])."','".$one['object']['date_naissance']."','".$one['object']['equipe']."','".$one['object']['arrive']."');");
                }
            }
        }
    }

    public function insert(){
        try {

            $etape2="INSERT INTO equipe (nom,email,mots_de_passe)
            SELECT DISTINCT 
                equipe,
                equipe,
                equipe        
            FROM resultat_temp;";

            $this->db->query($etape2);

            $etape3="INSERT INTO genre (libelle)
            SELECT DISTINCT 
                genre   
            FROM resultat_temp;";

            $this->db->query($etape3);

            $etape4="INSERT INTO coureur (id_equipe,nom,numero_dossard,id_genre,date_naissance)
            SELECT DISTINCT 
                            equipe.id_equipe, 
                            resultat_temp.nom, 
                            resultat_temp.numero_dossard, 
                            genre.id_genre,
                            resultat_temp.date_naissance
            FROM resultat_temp 
            INNER JOIN equipe
                ON resultat_temp.equipe = equipe.nom
            INNER JOIN genre
                ON resultat_temp.genre = genre.libelle;";

            $this->db->query($etape4);

            $etape5=" INSERT INTO etape_coureur (id_etape,id_coureur)
            SELECT DISTINCT 
                            etape.id_etape, 
                            coureur.id_coureur
            FROM resultat_temp 
            INNER JOIN etape
                ON resultat_temp.etape_rang = etape.rang
            INNER JOIN coureur
                ON resultat_temp.numero_dossard = coureur.numero_dossard;";

            $this->db->query($etape5);

           

            $etape6="INSERT INTO temps_coureur (id_etape,id_coureur,temps_depart,temps_arriver)
            SELECT DISTINCT 
                            etape.id_etape, 
                            coureur.id_coureur, 
                            etape.date_debut,
                            resultat_temp.arrive
            FROM resultat_temp 
            INNER JOIN etape
                ON resultat_temp.etape_rang = etape.rang
            INNER JOIN coureur
                ON resultat_temp.numero_dossard = coureur.numero_dossard;";

            $this->db->query($etape6);

            $this->db->query('truncate table resultat_temp');

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function importCsv($file){
        try {
            $data = $this->get($file);
            $donnee = $this->test($data);
            $this->temp($donnee);
            $this->insert($donnee);
        } catch (Exception $e) {
            throw $e;
        }
    }




}