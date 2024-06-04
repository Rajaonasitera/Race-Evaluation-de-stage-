<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Genre_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('genre', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from genre";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $i++;
            }
            return $reponse;
    }

    public function get($id){
            $sql = "select * from genre where id_genre = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            return $row[0];
    }

    public function update($id,$data){
        try {
            $this->db->where('id_genre', $id);
            $this->db->update('genre', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_genre', $id);
            $this->db->delete('genre');
        } catch (Exception $e) {
            throw $e;
        }
    }



    
}