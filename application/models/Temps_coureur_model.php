<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Temps_coureur_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('temps_coureur', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from temps_coureur";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['etape'] = $this->Etape_model->get($reponse[$i]['id_etape']);
                $reponse[$i]['coureur'] = $this->Coureur_model->get($reponse[$i]['id_coureur']);
                $i++;
            }
            return $reponse;
    }

    public function get($id){
            $sql = "select * from temps_coureur where id_temps_coureur = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            $data = $row[0];
            $data['etape'] = $this->Etape_model->get($data['id_etape']);
            $data['coureur'] = $this->Coureur_model->get($data['id_coureur']);
            return $data;
    }

    public function getByEtapeCoureur($idC, $idE){
        $sql = "select * from temps_coureur where id_etape = ".$idE." and id_coureur = ".$idC;
        $res = $this->db->query($sql);
        $row = $res->result_array();
        $data = $row[0];
        $data['etape'] = $this->Etape_model->get($data['id_etape']);
        $data['coureur'] = $this->Coureur_model->get($data['id_coureur']);
        return $data;
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

    public function update($id,$data){
        try {
            $this->db->where('id_temps_coureur', $id);
            $this->db->update('temps_coureur', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_temps_coureur', $id);
            $this->db->delete('temps_coureur');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function test($id_etape){
        try {
            $all = $this->getByEtape($id_etape);
            if ($all==null) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    
}