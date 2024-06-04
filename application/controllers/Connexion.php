<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connexion extends CI_Controller {


// ---------------------------------------------------------- Connexion affichage admin

	public function index($data=null)
	{
        // echo $data['error'];
		$this->load->view('login',$data);
	}		

// ---------------------------------------------------------- Accueil client

    public function Equipe($data=null){
        $this->load->view('',$data);
    }

// ---------------------------------------------------------- Connexion admin

    public function Enter(){
        try {
            $email = $this->input->post('email');
            $mdp = $this->input->post('mdp');
            if ($email==null||$mdp==null) {
                throw new Exception("Veuillez verifier l'email et le mots de passe");
            }
            $admin = $this->Admin_model->check($email,$mdp);
            $equipe = $this->Equipe_model->check($email,$mdp);

            if ($admin!=null&&$equipe==null) {
                echo $admin;
                $this->session->set_userdata('user',$admin);
                $this->session->set_userdata('isAdmin', true);
                redirect('admin');
            }else if ($admin==null&&$equipe!=null) {
                $this->session->set_userdata('user',$equipe);
                $this->session->set_userdata('isAdmin', false);
                var_dump('jdkjzld');
                redirect('equipe');
            }else{
                $data['error']="Il y a une erreur, <br> Veuillez verifier l'email et le mots de passe";
                $this->index($data);
            }
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }


// ---------------------------------------------------------- Deconnection


    public function deconnexion(){
        try {
            $view = 'connexion/';
            $this->session->sess_destroy();
            redirect($view);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }


    public function truncate(){
        try {
            $data = array();
            $data[] = "points_temp";
            $data[] = "resultat_temp";
            $data[] = "etape_temp";
            $data[] = "etape_coureur";
            $data[] = "temps_coureur";
            $data[] = "points";
            $data[] = "categorie_coureur";
            $data[] = "categorie";
            $data[] = "coureur";
            $data[] = "etape";
            $data[] = "equipe";
            $data[] = "genre";
            $data[] = "penalite";

            var_dump(count($data));
            
            for ($i=0; $i < count($data); $i++) { 
                $this->db->query("TRUNCATE ".$data[$i]." CASCADE");
            }
           $seq[] = "admin_id_admin_seq";
           $seq[] = "categorie_id_categorie_seq";
           $seq[] = "coureur_id_coureur_seq";
           $seq[] = "equipe_id_equipe_seq";
           $seq[] = "etape_coureur_id_etape_coureur_seq";
           $seq[] = "etape_id_etape_seq";
           $seq[] = "genre_id_genre_seq";
           $seq[] = "points_id_point_seq";
           $seq[] = "temps_coureur_id_temps_coureur_seq";
           for ($i=0; $i < count($seq); $i++) { 
            $this->db->query("ALTER SEQUENCE ".$seq[$i]." RESTART WITH 1;");
        }
            redirect("admin/");
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function gerer(){
        try {
            $coureur = $this->Coureur_model->getAll();
            $etape1 = $this->Etape_model->getRang(1);
            $timestamp = strtotime($etape1['date_debut']);
            $year = (int) date('Y', $timestamp);
            for ($i=0; $i < count($coureur); $i++) { 
                $time= strtotime($coureur[$i]['date_naissance']);
                $dtn = (int) date('Y', $time);;
                $this->db->query("insert into categorie_coureur(id_coureur,libelle) values(".$coureur[$i]['id_coureur'].",'".$coureur[$i]['genre']['libelle']."')");
                if ($year-$dtn < 18) {
                    $this->db->query("insert into categorie_coureur(id_coureur,libelle) values(".$coureur[$i]['id_coureur'].",'Junior')");

                }
            }
            $sql = "INSERT INTO categorie(libelle)
            SELECT DISTINCT 
                            libelle
            FROM categorie_coureur;
            ";
            $this->db->query($sql);
            redirect("admin/");
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    
}
?>