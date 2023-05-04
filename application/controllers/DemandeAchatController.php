<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DemandeAchatController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
		session_start();	
	}
	public function loginChefDepartement(){
		$this->load->model('ChefDept');
		$email=$_GET['email'];
		$mdp=$_GET['mdp'];
		$data = $this->ChefDept->login($email,$mdp);
			//echo count($data);
			if(count($data)==1){
				foreach($data as $data){}
				$_SESSION['idChefDept']=$data['deptidDept'];
				$_SESSION['libelle']=$data['libelleDept'];
				$data['rubrique']=$this->ChefDept->getListeRubrique();
				$data['rubrique1']=$this->ChefDept->getListeRubrique();
				$data['rubrique2']=$this->ChefDept->getListeRubrique();
				$data['qualite']=$this->ChefDept->getQualite();
				$data['page']='DemandeAchat.php';
				$this->load->view('AcceuilDept',$data);
			}
			else{
				$data['message']='Identifiant ou mot de passe incorrect';
				$this->load->view('LoginDepartement',$data);
			}
	}
	public function acc(){
		$this->load->model('ChefDept');
		$data['rubrique']=$this->ChefDept->getListeRubrique();
		$data['rubrique1']=$this->ChefDept->getListeRubrique();
		$data['rubrique2']=$this->ChefDept->getListeRubrique();
		$data['qualite']=$this->ChefDept->getQualite();
		$data['page']='DemandeAchat.php';
		$this->load->view('AcceuilDept',$data);

	}
	public function getDesignationByRubrique($idRubrique){
		$this->load->model('ChefDept');
		$designation=$this->ChefDept->getDesignationByRubrique($idRubrique);	
		echo json_encode($designation);
	}
	public function getQualiteByDesignation($idDesignation){
		$this->load->model('ChefDept');
		$qualite=$this->ChefDept->getQualiteByDesignation($idDesignation);
		echo json_encode($qualite);
	}
    public function insertDemandeTemporaire($tab){
		$this->load->model('ChefDept');
		$tab=explode('-',$tab);
		/*echo $tab[0];
		echo $tab[1];
		echo $tab[2];*/
		$this->ChefDept->insertDemandeTemporaire($tab[0],$tab[1],$_SESSION['idChefDept'],$tab[2]);
		$data['liste']=$this->ChefDept->getDemandeTemporaire($_SESSION['idChefDept']);
		$this->load->view('ListeTemporaireDemande',$data);
	}
	function saveDemande(){
		$this->load->model('ChefDept');
		$this->ChefDept->saveDemande($_SESSION['idChefDept']);
	}
	function deleteLigneDemande($idDemande){
		$this->load->model('ChefDept');
		$this->ChefDept->deleteLigneDemande($idDemande);
		$data['liste']=$this->ChefDept->getDemandeTemporaire($_SESSION['idChefDept']);
		$this->load->view('ListeTemporaireDemande',$data);
	}
	function newRubrique($rubrique){
		$this->load->model('ChefDept');
		$this->ChefDept->newRubrique($rubrique);
		$rubrique=$this->ChefDept->getListeRubrique();
		echo json_encode($rubrique);
	}
	function newQualite($qualite){
		$this->load->model('ChefDept');
		$this->ChefDept->newQualite($qualite);
		$qualite=$this->ChefDept->getQualite();
		echo json_encode($qualite);
	}
	function newDesignation(){
		$rubrique=$_GET['rubrique'];
		$qualites=explode(',',$_GET['qualites']);
		$designation=$_GET['designation'];
		$code=$_GET['code'];
		$this->load->model('ChefDept');
		$this->ChefDept->newProduit($designation,$rubrique,$code);
		$lastProduct=$this->ChefDept->getLastProduitInserer();
		foreach($lastProduct as $lastProduct){}
		echo $lastProduct['idproduit'];
		for($i=0;$i<count($qualites);$i++){
			$this->ChefDept->newProduitQualite($lastProduct['idproduit'],$qualites[$i]);
		}
		$designation=$this->ChefDept->getDesignationByRubrique($rubrique);
		//echo json_encode($designation);
	}
	function fillSelectOption(){
		$this->load->model('ChefDept');
		$val="";
		if(strcmp($_GET['categorie'],'rubrique')==0){
			$val=$this->ChefDept->getListeRubrique();
		}
		if($_GET['categorie']=='produit'){
			$val=$this->ChefDept->getListeProduit();
		}
		if($_GET['categorie']=='qualite'){
			$val=$this->ChefDept->getQualite();
		}
		echo json_encode($val);
	}
	function rechercher(){
		$this->load->model('ChefDept');
		$data['result']=$this->ChefDept->getInfoToUpdate($_GET['categorie'],$_GET['search']);
		if(strcmp($_GET['categorie'],'rubrique')==0)		$this->load->view('ResultatRubrique',$data);
		if(strcmp($_GET['categorie'],'produit')==0)			$this->load->view('ResultatProduit',$data);
		if(strcmp($_GET['categorie'],'qualite')==0)			$this->load->view('ResultatQualite',$data);
	}
	function updateQualite(){
		$this->load->model('ChefDept');
		//echo $_GET['qualite'];
		$this->ChefDept->updateQualite($_GET['idqualite'],$_GET['qualite']);
		$val=$this->ChefDept->getQualite();
		echo json_encode($val);
	}
	function deleteQualite($idQualite){
		$this->load->model('ChefDept');
		//echo $_GET['qualite'];
		$this->ChefDept->deleteQualite($idQualite);
		$val=$this->ChefDept->getQualite();
		echo json_encode($val);
	}
	function updateRubrique(){
		$this->load->model('ChefDept');
		//echo $_GET['qualite'];
		$this->ChefDept->updateRubrique($_GET['idrubrique'],$_GET['rubrique']);
		$val=$this->ChefDept->getListeRubrique();
		echo json_encode($val);
	}
	function deleteRubrique($idRubrique){
		$this->load->model('ChefDept');
		//echo $_GET['qualite'];
		$this->ChefDept->deleteRubrique($idRubrique);
		$val=$this->ChefDept->getListeRubrique();
		echo json_encode($val);
	}
	function deleteProduitQualite(){
		$this->load->model('ChefDept');
		//echo $_GET['qualite'];
		$this->ChefDept->deleteProduitQualite($_GET['idQualite'],$_GET['idProduit']);
		$data['result']=$this->ChefDept->getInfoToUpdate('produit',$_GET['idProduit']);
		$this->load->view('ResultatProduit',$data);
	}
	function updateProduit(){
		$this->load->model('ChefDept');
		$this->ChefDept->updateProduit($_GET['idproduit'],$_GET['designation'],$_GET['code']);
		$val=$this->ChefDept->getListeProduitAll();
		echo json_encode($val);
	}
}
