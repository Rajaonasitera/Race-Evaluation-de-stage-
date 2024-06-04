<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Admin_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('admin', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from admin";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $i++;
            }
            return $reponse;
    }

    public function get($id){
            $sql = "select * from admin where id_admin = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            return $row[0];
    }

    public function update($id,$data){
        try {
            $this->db->where('id_admin', $id);
            $this->db->update('admin', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_admin', $id);
            $this->db->delete('admin');
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
            $result = $this->db->get('admin')->result_array();
            if ($result==null) {
                return null;
            }
            return $result[0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    
}