<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All extends CI_Controller {

	public function classementEquipe()
	{
		if ($this->input->get('categorie')==null) {
			$id_categ = 0;
		}else{
			$id_categ = $this->input->get('categorie');
		}
		$data['categorie'] = $this->Categorie_model->getAll();
		$i = count($data['categorie']);
		$data['categorie'][$i]['id_categorie'] = 0;
		$data['categorie'][$i]['libelle'] = 'Toutes catégories';
		if ($id_categ == 0) {
			$data['defaut'] = $data['categorie'][count($data['categorie'])-1];
			$data['general'] = $this->Classement_general_equipe_model->getAll();
		}else{
			$data['defaut'] = $this->Categorie_model->get($id_categ);
			$data['general'] = $this->Categorie_model->classement($data['defaut']['libelle']);
		}   
        $data['all'] = $this->Classement_equipe_model->getClassementByEquipe();
		$data['view']="Classement_equipe";
		$data['titre']="Classement general par equipe";
		$data['nom']="Tatiana";
		$this->load->view('page',$data);
	}
    
    public function classementEtape()
	{
        // $data['general'] = $this->Classement_general_model->getAll();
        $data['generalEquipe'] = $this->Classement_general_etape_model->getClassementByEquipe();
        // $data['etape'] = $this->Etape_model->getAll();
        $data['all'] = $this->Classement_etape_points_model->getClassementByEtape();
		$data['view']="Classement_etape";
		$data['titre']="Classement general pour chaque etape";
		$data['nom']="Tatiana";
		$this->load->view('page',$data);
	}

	public function classementGeneral()
	{
        $data['general'] = $this->Classement_general_model->getAll();
        // $data['generalEquipe'] = $this->Classement_general_etape_model->getClassementByEquipe();
        $data['etape'] = $this->Etape_model->getAll();
        // $data['all'] = $this->Classement_etape_points_model->getClassementByEtape();
		$data['view']="Classement_general";
		$data['titre']="Classement par coureur";
		$data['nom']="Tatiana";
		$this->load->view('page',$data);
	}

   
}
?>