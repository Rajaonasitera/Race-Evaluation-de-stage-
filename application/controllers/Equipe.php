<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipe extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($_SESSION['isAdmin']==true) {
            $data['erreur'] = "Vous n'avez pas accès";
            $this->load->view('erreur',$data);
        }

    }

    public function index(){
        try {
            $data['chrono'] = $this->Etape_coureur_model->getEtapeChrono($_SESSION['user']['id_equipe']);
            $data['all'] = $this->Etape_model->getAll();
            array_multisort(array_column($data['all'], 'rang'), SORT_ASC, $data['all']);
            $data['view']="Etape_liste_equipe";
            $data['titre']="Liste des etapes";
            $this->load->view('page',$data);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function affectCoureur($id_etape){
        try {
            $data['all'] = $this->Coureur_model->getByEquipe($_SESSION['user']['id_equipe']);
            $data['etape'] = $this->Etape_model->get($id_etape);
            $data['view']="FormulaireCoureur";
            $data['titre']="Formulaire pour affecter le coureur";
            $this->load->view('page',$data);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function affecter(){
        try {
            $options = $this->input->post('id_coureur');
            $id_etape = $this->input->post('id_etape');
            foreach ($options as $id_coureur) {
               $obj['id_etape'] = $id_etape;
               $obj['id_coureur'] = $id_coureur;
               $this->Etape_coureur_model->insert($obj);
            }
            redirect('equipe/index');
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }

    public function ajoutCoureur($id_etape){
        try {
            $data['chrono'] = $this->Etape_coureur_model->getByEtapeCoureurOne($id_etape,$_SESSION['user']['id_equipe']);
            $data['all'] = $this->Etape_coureur_model->coureurPasEtape($id_etape,$_SESSION['user']['id_equipe']);
            $data['etape'] = $this->Etape_model->get($id_etape);
            $data['view']="FormulaireAjoutCoureur";
            $data['titre']="Formulaire pour affecter le coureur";
            $this->load->view('page',$data);
        } catch (Exception $e) {
            $data['erreur'] = $e->getMessage();
            $this->load->view('erreur',$data);
        }
    }



}
?>