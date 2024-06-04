<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vide extends CI_Controller {

	public function index()
	{
		$data['view']="Utilisateur";
		$data['titre']="Insertion utilisateur";
		$data['nom']="Tatiana";
		$this->load->view('page',$data);
	}		
}
?>