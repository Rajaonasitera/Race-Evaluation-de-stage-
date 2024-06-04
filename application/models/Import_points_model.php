<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');
date_default_timezone_set('Europe/Moscow'); 
class Import_points_model extends CI_Model
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
                    if (count($row) == 2) {
                        $data_to_insert[] = array(
                            'object' => array(
                                'classement' => str_replace(',', '.', trim($row[0])),
                                'points' => str_replace(',', '.', trim($row[1])),
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
                $classement = str_replace(',', '.', $one['object']['classement']);
                $points = str_replace(',', '.', $one['object']['points']);
                if (!is_numeric($classement)||!is_numeric($points)) {
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
                    $this->db->query("INSERT INTO points_temp (classement, points) VALUES (".$one['object']['classement'].",".$one['object']['points'].");");
                }

                $data['erreur'] = $er;
                // $this->load->view('erreurcsv',$data);
                // throw new Exception($er);
        }else{
            foreach ($data['ok'] as $one) {
                // var_dump($data['data']);
                $this->db->query("INSERT INTO points_temp (classement, points) VALUES (".$one['object']['classement'].",".$one['object']['points'].");");
                
            }
        }
    }

    public function insert(){
        try {

            $etape1="INSERT INTO points (rang,points)
            SELECT DISTINCT 
                classement,
                points
            FROM points_temp;";

            $this->db->query($etape1);
            $this->db->query('truncate table points_temp');

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function importCsv($file){
        try {
            $data = $this->get($file);
            $donnee = $this->test($data);
            var_dump($donnee);
            $this->temp($donnee);
            $this->insert($donnee);
        } catch (Exception $e) {
            throw $e;
        }
    }




}