<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Classement_general_equipe_model extends CI_Model
{

    public function getAll(){
            $reponse = array();
            $sql = "select * from classement_general_equipe";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['equipe'] = $this->Equipe_model->get($reponse[$i]['id_equipe']);
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


    


    
}