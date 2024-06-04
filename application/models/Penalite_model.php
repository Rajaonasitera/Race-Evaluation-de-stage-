<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Penalite_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('penalite', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from penalite";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['equipe'] = $this->Equipe_model->get($reponse[$i]['id_equipe']);
                $reponse[$i]['etape'] = $this->Etape_model->get($reponse[$i]['id_etape']);
                $i++;
            }
            return $reponse;
    }

    public function getByEquipeEtape($idE, $idEq){
        try {
            $all = $this->getAll();
            $result = array();
            foreach ($all as $one) {
                if ($one['id_equipe']==$idEq&&$one['id_etape']==$idE) {
                    $result[] = $one;
                }
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id,$data){
        try {
            $this->db->where('id_penalite', $id);
            $this->db->update('penalite', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($data){
        try {
            $this->db->where($data);
            $this->db->delete('penalite');
        } catch (Exception $e) {
            throw $e;
        }
    }

    


    
}