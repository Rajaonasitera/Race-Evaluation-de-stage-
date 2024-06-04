<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Classement_general_etape_model extends CI_Model
{

    public function getAll(){
            $reponse = array();
            $sql = "select * from classement_general_etape";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['equipe'] = $this->Equipe_model->get($reponse[$i]['id_equipe']);
                $reponse[$i]['etape'] = $this->Equipe_model->get($reponse[$i]['id_etape']);
                $i++;
            }
            return $reponse;
    }

    public function getByEquipe($id){
        try {
            $all = $this->getAll();
            $result = array();
            foreach ($all as $one) {
                if ($one['id_etape']==$id) {
                    $result[] = $one;
                }
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getClassementByEquipe(){
        try {
            $all = $this->Etape_model->getAll();
            $result = array();
            foreach ($all as $one) {
                $data['etape'] = $one;
                $data['classement'] = $this->getByEquipe($one['id_etape']);
                $result[] = $data;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }



    


    
}