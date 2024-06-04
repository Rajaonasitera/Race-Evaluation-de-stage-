<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Etape_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('etape', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from etape";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $i++;
            }
            return $reponse;
    }

    public function get($id){
            $sql = "select * from etape where id_etape = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            return $row[0];
    }

    public function update($id,$data){
        try {
            $this->db->where('id_etape', $id);
            $this->db->update('etape', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_etape', $id);
            $this->db->delete('etape');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getRang($id){
        $sql = "select * from etape where rang = ".$id;
        $res = $this->db->query($sql);
        $row = $res->result_array();
        return $row[0];
}


    
}