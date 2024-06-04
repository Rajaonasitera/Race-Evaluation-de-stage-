<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Classement_etape_points_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('classement_etape_points', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from classement_etape_points";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['etape'] = $this->Etape_model->get($reponse[$i]['id_etape']);
                $reponse[$i]['coureur'] = $this->Coureur_model->get($reponse[$i]['id_coureur']);
                $reponse[$i]['equipe'] = $this->Equipe_model->get($reponse[$i]['id_equipe']);
                $i++;
            }
            return $reponse;
    }

    public function getByEtape($id){
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

    public function getClassementByEtape(){
        try {
            $all = $this->Etape_model->getAll();
            $result = array();
            foreach ($all as $one) {
                $data['etape'] = $one;
                $data['classement'] = $this->getByEtape($one['id_etape']);
                array_multisort(array_column($data['classement'], 'rang'), SORT_ASC, $data['classement']);
                $result[] = $data;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getByCoureurEtape($idC, $id){
        try {
            $all = $this->getAll();
            foreach ($all as $one) {
                if ($one['id_etape']==$id&&$one['id_coureur']==$idC) {
                    return $one;
                }
            }
            $one['points'] = 0;
            return $one;
        } catch (Exception $e) {
            throw $e;
        }
    }

    



    
}