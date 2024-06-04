<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($_SESSION['isAdmin']==false) {
            $data['erreur'] = "Vous n'avez pas accès";
            $this->load->view('erreur',$data);
        }

    }

    public function index(){
        try {
            $data['all'] = $this->Etape_model->getAll();
            array_multisort(array_column($data['all'], 'rang'), SORT_ASC, $data['all']);
            $data['view']="Etape_liste_admin";
            $data['titre']="Liste des etapes";
            $this->load->view('page',$data);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function affectTemps($id_etape){
        try {
            $data['all'] = $this->Etape_coureur_model->sansChrono($id_etape);
            $data['etape'] = $this->Etape_model->get($id_etape);
            $data['view']="FormulaireTemps";
            $data['titre']="Formulaire pour affecter les temps";
            $this->load->view('page',$data);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function affecter(){
        try {
            $id_etape = $this->input->post('id_etape');
            $all = $this->Etape_coureur_model->getByEtape($id_etape);
            foreach ($all as $one) {
               $obj['id_etape'] = $id_etape;
               $obj['id_coureur'] = $one['id_coureur'];
               $obj['temps_depart']=$this->input->post('temps_depart_'.$one['id_coureur']);
               $obj['temps_arriver']=$this->input->post('temps_arriver_'.$one['id_coureur']);
               $this->Temps_coureur_model->insert($obj);
            }
            redirect('admin/index');
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function importDonnees(){
        try {
            $data['view']="Import_donnees";
            $data['titre']="Importation de donnée";
            $this->load->view('page',$data);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function importD(){
        try {
            $file_etape = $_FILES['etape']['tmp_name'];
            $file_resultat = $_FILES['resultat']['tmp_name'];
            $this->Import_etape_model->importCsv($file_etape);
            $this->Import_resultat_model->importCsv($file_resultat);
            redirect('admin/importDonnees');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function importPoints(){
        try {
            $data['view']="Import_points";
            $data['titre']="Importation de points";
            $this->load->view('page',$data);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function importP(){
        try {
            $file_points = $_FILES['points']['tmp_name'];
            // var_dump("kjndlkdlaz");
            $this->Import_points_model->importCsv($file_points);
            redirect('admin/importPoints');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listePenalite(){
        try {
            $data['all']=$this->Penalite_model->getAll();
            $data['view']="Penalite_liste";
            $data['titre']="Liste des penalite";
            $this->load->view('page',$data);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function ajoutPenalite(){
        try {
            $data['etape']=$this->Etape_model->getAll();
            $data['equipe']=$this->Equipe_model->getAll();
            $data['view']="Penalite_ajout";
            $data['titre']="Ajout penalite";
            $this->load->view('page',$data);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function ajouter(){
        try {
            $penalite['id_etape'] = $this->input->post('id_etape');
            $penalite['id_equipe'] = $this->input->post('id_equipe');
            $penalite['temps'] = $this->input->post('temps');
            $this->Penalite_model->insert($penalite);
            redirect('admin/listePenalite');
        } catch (Exception $th) {
            throw $th;
        }
    }
    public function supprimerPenalite(){
        try {
            $penalite['id_etape'] = $this->input->post('id_etape');
            $penalite['id_equipe'] = $this->input->post('id_equipe');
            $penalite['temps'] = $this->input->post('temps');
            $this->Penalite_model->delete($penalite);
            redirect('admin/listePenalite');
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function pdf(){
        $data['equipe'] = $this->Equipe_model->get($this->input->post('id_equipe'));
        $data['points'] = $this->input->post('points');
        $this->load->view('Certificat.php',$data);
    }



}
?>