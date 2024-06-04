<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Coureur_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('coureur', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from coureur";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['equipe'] = $this->Equipe_model->get($reponse[$i]['id_equipe']);
                $reponse[$i]['genre'] = $this->Genre_model->get($reponse[$i]['id_genre']);
                $i++;
            }
            return $reponse;
    }

    public function get($id){
            $sql = "select * from coureur where id_coureur = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            $data = $row[0];
            $data['equipe'] = $this->Equipe_model->get($data['id_equipe']);
            $data['genre'] = $this->Genre_model->get($data['id_genre']);
            return $data;
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

    public function update($id,$data){
        try {
            $this->db->where('id_coureur', $id);
            $this->db->update('coureur', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_coureur', $id);
            $this->db->delete('coureur');
        } catch (Exception $e) {
            throw $e;
        }
    }

    


    
}