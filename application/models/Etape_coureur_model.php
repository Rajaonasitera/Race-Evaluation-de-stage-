<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Etape_coureur_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('etape_coureur', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from etape_coureur";
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
            $sql = "select * from etape_coureur where id_etape_coureur = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            $data = $row[0];
            $data['etape'] = $this->Etape_model->get($data['id_etape']);
            $data['coureur'] = $this->Coureur_model->get($data['id_coureur']);
            return $data;
    }

    public function getByEtapeCoureur(){
        $reponse = array();
        $sql = "SELECT 
                    etape_coureur.id_etape,
                    etape_coureur.id_coureur,
                    etape.date_debut,
                    temps_coureur.temps_arriver,
                    (temps_coureur.temps_arriver - etape.date_debut) as chrono
                FROM etape_coureur
                LEFT JOIN temps_coureur
                ON etape_coureur.id_etape = temps_coureur.id_etape
                AND etape_coureur.id_coureur = temps_coureur.id_coureur
                LEFT JOIN etape
                ON etape.id_etape = etape_coureur.id_etape
                ORDER BY etape.rang ASC;";
        $res = $this->db->query($sql);
        $i = 0;
        // var_dump($res->result_array());
        foreach ($res->result_array() as $row) {
            $reponse[$i] = $row;
            $reponse[$i]['etape'] = $this->Etape_model->get($reponse[$i]['id_etape']);
            $reponse[$i]['coureur'] = $this->Coureur_model->get($reponse[$i]['id_coureur']);
            // var_dump("---------------");
            // var_dump($this->Coureur_model->get($reponse[$i]['id_coureur']));
            $i++;
        }
        
        return $reponse;
    }

    public function sansChrono($id_etape){
        $reponse = array();
        $sql = "SELECT * FROM (SELECT 
                    etape_coureur.id_etape,
                    etape_coureur.id_coureur,
                    etape.date_debut,
                    temps_coureur.temps_arriver,
                    (temps_coureur.temps_arriver - etape.date_debut) as chrono
                FROM etape_coureur
                LEFT JOIN temps_coureur
                ON etape_coureur.id_etape = temps_coureur.id_etape
                AND etape_coureur.id_coureur = temps_coureur.id_coureur
                LEFT JOIN etape
                ON etape.id_etape = etape_coureur.id_etape
                ORDER BY etape.rang ASC) as tab
                WHERE tab.temps_arriver IS NULL AND id_etape = ".$id_etape.";";
        $res = $this->db->query($sql);
        $i = 0;
        // var_dump($res->result_array());
        foreach ($res->result_array() as $row) {
            $reponse[$i] = $row;
            $reponse[$i]['etape'] = $this->Etape_model->get($reponse[$i]['id_etape']);
            $reponse[$i]['coureur'] = $this->Coureur_model->get($reponse[$i]['id_coureur']);
            // var_dump("---------------");
            // var_dump($this->Coureur_model->get($reponse[$i]['id_coureur']));
            $i++;
        }
        
        return $reponse;
    }

    public function getByEtapeCoureurOne($idE, $idEq){
        try {
            $res = array();
            $data = $this->getByEtapeCoureur();
            
            for ($i=0; $i < count($data); $i++) { 
                if ($data[$i]['id_etape']==$idE&&$data[$i]['coureur']['id_equipe']==$idEq) {
                    $res[] = $data[$i];
                }
            }
        // var_dump($res);
        return $res;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getEtapeChrono($idE){
        try {
            $etape = $this->Etape_model->getAll();
            array_multisort(array_column($etape, 'rang'), SORT_ASC, $etape);
            $rep = array();
            $j = 0;
            
            for ($i=0; $i < count($etape); $i++) { 
               $rep[$j]['etape'] = $etape[$i];
               $rep[$j]['chrono'] = $this->getByEtapeCoureurOne($etape[$i]['id_etape'],$idE);
               $j++;
            }
            return $rep;
        } catch (Exception $e) {
            throw $e;
        }
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
            $this->db->where('id_etape_coureur', $id);
            $this->db->update('etape_coureur', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_etape_coureur', $id);
            $this->db->delete('etape_coureur');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function test($id_etape, $id_equipe){
        try {
            $all = $this->getByEtape($id_etape);
            for ($i=0; $i < count($all); $i++) { 
                if ($all[$i]['coureur']['id_equipe']==$id_equipe) {
                    return false;
                    var_dump("hkhhj");
                }
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function coureurPasEtape($id_etape, $id_equipe){
        try {
            $reponse = array();
            $sql = "SELECT * FROM coureur WHERE id_equipe = ".$id_equipe." AND id_coureur NOT IN(SELECT id_coureur FROM etape_coureur WHERE id_etape = ".$id_etape.");";
            $res = $this->db->query($sql);
            $i = 0;
            // var_dump($res->result_array());
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['coureur'] = $this->Coureur_model->get($reponse[$i]['id_coureur']);   
                $i++;
            }
            
            return $reponse;
        } catch (Exception $e) {
            throw $e;
        }
    }

    
}