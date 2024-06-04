<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Classement_equipe_model extends CI_Model
{
    
    public function getAll(){
            $reponse = array();
            $sql = "select * from classement_equipe";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['coureur'] = $this->Coureur_model->get($reponse[$i]['id_coureur']);
                $reponse[$i]['equipe'] = $this->Equipe_model->get($reponse[$i]['coureur']['id_equipe']);
                $i++;
            }
            return $reponse;
    }

    public function getByEquipe($id){
        try {
            $all = $this->getAll();
            $result = array();
            foreach ($all as $one) {
                if ($one['id_equipe']==$id) {
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
            $all = $this->Equipe_model->getAll();
            $result = array();
            foreach ($all as $one) {
                $data['equipe'] = $one;
                $data['classement'] = $this->getByEquipe($one['id_equipe']);
                $result[] = $data;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }


    
}