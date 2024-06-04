<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');
date_default_timezone_set('Europe/Moscow'); 
class Import_etape_model extends CI_Model
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
                    if (count($row) == 6) {
                        $annee = trim($row[4]);
                        $heure = trim($row[5]);
                        $dateTime = $annee . ' ' . $heure;
                        $date = DateTime::createFromFormat('d/m/Y H:i:s', $dateTime);
                        if ($dateTime === false) {
                            $error_messages[] = "Format error $row_count.";
                            $probleme[] = $dateTime;
                        }else{
                            $dateT = $date->format('Y-m-d H:i:s');
                        }                        
                        // $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
                        $data_to_insert[] = array(
                            'object' => array(
                                'etape' => str_replace("'", "'''",trim($row[0])),
                                'longueur' => str_replace(',', '.', trim($row[1])),
                                'nombre_coureur' => str_replace(',', '.', trim($row[2])),
                                'rang' => str_replace("'", "'''",trim($row[3])),
                                'date_depart' => $dateT,
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
                $longueur = str_replace(',', '.', $one['object']['longueur']);
                $nombre_coureur = str_replace(',', '.', $one['object']['nombre_coureur']);
                $rang = str_replace(',', '.', $one['object']['rang']);
                if (!is_numeric($longueur)||!is_numeric($nombre_coureur)||!is_numeric($rang)) {
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
                    $this->db->query("INSERT INTO etape_temp (etape, longueur, nombre_coureur, rang, date_depart) VALUES ('".$this->db->escape_str($one['object']['etape'])."',".$one['object']['longueur'].",".$one['object']['nombre_coureur'].",".$one['object']['rang'].",'".$one['object']['date_depart']."');");
                }

                $data['erreur'] = $er;
                // $this->load->view('erreurcsv',$data);
                // throw new Exception($er);
        }else{
            foreach ($data['ok'] as $one) {
                // var_dump($data['data']);
                $this->db->query("INSERT INTO etape_temp (etape, longueur, nombre_coureur, rang, date_depart) VALUES ('".$this->db->escape_str($one['object']['etape'])."',".$one['object']['longueur'].",".$one['object']['nombre_coureur'].",".$one['object']['rang'].",'".$one['object']['date_depart']."');");
                
            }
        }
    }

    public function insert(){
        try {

            $etape1="INSERT INTO etape (nom,longueur,nombre_coureur,rang,date_debut)
            SELECT DISTINCT 
                etape,
                longueur,
                nombre_coureur,
                rang,
                date_depart
            FROM etape_temp;";

            $this->db->query($etape1);
            $this->db->query('truncate table etape_temp');

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