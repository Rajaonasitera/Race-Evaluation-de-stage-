<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Equipe_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('equipe', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from equipe";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $i++;
            }
            return $reponse;
    }

    public function get($id){
            $sql = "select * from equipe where id_equipe = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            return $row[0];
    }

    

    public function update($id,$data){
        try {
            $this->db->where('id_equipe', $id);
            $this->db->update('equipe', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_equipe', $id);
            $this->db->delete('equipe');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function check($email,$mdp){
        try {
            $where = array(
                'email' => $email,
                'mots_de_passe' => $mdp,
            );
            $this->db->where($where);
            $result = $this->db->get('equipe')->result_array();
            if ($result==null) {
                return null;
            }
            return $result[0];
        } catch (Exception $e) {
            throw $e;
        }
    }


    
}