<?php if (!defined('BASEPATH')) exit('No direct script acces allowed');

class Categorie_model extends CI_Model
{
    
    public function insert($data){
        try {
            $this->db->insert('categorie', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){
            $reponse = array();
            $sql = "select * from categorie";
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $i++;
            }
            return $reponse;
    }

    public function get($id){
            $sql = "select * from categorie where id_categorie = ".$id;
            $res = $this->db->query($sql);
            $row = $res->result_array();
            return $row[0];
    }

    public function update($id,$data){
        try {
            $this->db->where('id_categorie', $id);
            $this->db->update('categorie', $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $this->db->where('id_categorie', $id);
            $this->db->delete('categorie');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function classement($categorie){
        try {
            $sql = "SELECT id_equipe, 
                        sum(points) as points,
                        DENSE_RANK() OVER (ORDER BY sum(points) DESC) AS rang
                    FROM (
                        SELECT 
                            tables.id_etape,
                            tables.id_coureur,
                            tables.id_equipe,
                            tables.temps_depart,
                            tables.temps_arriver,
                            tables.rang,
                            COALESCE(points.points, 0) AS points 
                        FROM 
                            (
                                SELECT 
                                    id_etape,
                                    id_coureur,
                                    id_equipe,
                                    temps_depart,
                                    temp_arriver_reel,
                                    temps_arriver,
                                    DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY temps_arriver ASC) AS rang 
                                FROM (
                                                SELECT 
                                                    temps_coureur.id_etape,
                                                    coureur.id_coureur,
                                                    coureur.id_equipe,
                                                    temps_coureur.temps_depart,
                                                    temps_coureur.temps_arriver AS temp_arriver_reel,
                                                    COALESCE(temps_coureur.temps_arriver + COALESCE(penalites.temps, NULL),temps_coureur.temps_arriver) AS temps_arriver
                                                FROM 
                                                    temps_coureur
                                                JOIN 
                                                    coureur ON temps_coureur.id_coureur = coureur.id_coureur
                                                JOIN 
                                                    equipe ON coureur.id_equipe = equipe.id_equipe
                                                JOIN 
                                                    etape ON temps_coureur.id_etape = etape.id_etape
                                                LEFT JOIN 
                                                    (SELECT id_etape, id_equipe, sum(temps) AS temps FROM penalite GROUP BY id_etape, id_equipe) 
                                                    AS penalites 
                                                    ON temps_coureur.id_etape = penalites.id_etape AND coureur.id_equipe = penalites.id_equipe
                                ) AS temps WHERE temps.id_coureur IN (SELECT id_coureur FROM categorie_coureur WHERE libelle = '".$categorie."')
                            ) as tables
                        LEFT JOIN 
                            points 
                            ON tables.rang = points.rang
                        ORDER BY id_etape ASC, rang ASC
                    ) as tab 
                    GROUP BY id_equipe;";
            $reponse = array();
            $res = $this->db->query($sql);
            $i = 0;
            foreach ($res->result_array() as $row) {
                $reponse[$i] = $row;
                $reponse[$i]['equipe'] = $this->Equipe_model->get($reponse[$i]['id_equipe']);
                $i++;
            }
            return $reponse;        
        } catch (Exception $e) {
            throw $e;
        }
    }

}