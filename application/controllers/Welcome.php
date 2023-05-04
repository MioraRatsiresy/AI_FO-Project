<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		session_start();
	}
	public function index()
	{
		$this->load->view('LoginDepartement');	
	}
	public function indexAppro(){
		$data = "";
		$this->load->view('LoginAppro', $data);
	}
	public function login(){
		if(!empty($_POST['log']) && !empty($_POST['mdp'])){
			$this->load->model('Login');
        	$idChefAppro = $this->Login->seLoguer($_POST['log'],$_POST['mdp']);
        	if($idChefAppro!=null){
        		echo "Successfull , redirect page ??????";
        		$_SESSION['idChefAppro'] = $idChefAppro;
        		 redirect(base_url('Welcome/listeDemande'));
        	}else{
        		redirect(base_url('Welcome/indexAppro?error'));
        	}
		}else{
			redirect(base_url('Welcome/indexAppro?error=ok'));
		}
	}

	public function listeDemande(){
		$this->load->model('Demande');
		$order = "0";
		if(!empty($_GET['id'])){
			$order = $_GET['id'];
		}
		$etat = "0";
		if(!empty($_GET['filtre'])){
			$etat = $_GET['filtre'];
		}
		if(!empty($_POST['choix']) && $_POST['choix']!=""){
			$action = 0;
			if(!empty($_POST["valider"])){
				$action = 2;
			}
			if(!empty($_POST["annuler"])){
				$action = 3;
			}
			$this->Demande->actionDemande($_POST['choix'],$action);
		}
		$data['page'] = 'ListeDemande.php';
		$data['listeDemande'] = $this->Demande->listeDemande($order,$etat);
		$this->load->view('AcceuilAppro', $data);
	}
	public function listeDemandeDept(){
		$this->load->model('Demande');
		$order = "0";
		if(!empty($_GET['id'])){
			$order = $_GET['id'];
		}
		$etat = "0";
		if(!empty($_GET['filtre'])){
			$etat = $_GET['filtre'];
		}
		$data['listeDemande'] = $this->Demande->listeDemandeDept("0",$etat,$_SESSION['idChefDept']);
		$this->load->view('ListeDemandeDept', $data);
	}
	public function listeDemande1(){
		$this->load->model('Demande');
		$order = "0";
		if(!empty($_GET['id'])){
			$order = $_GET['id'];
		}
		$etat = "0";
		if(!empty($_GET['filtre'])){
			$etat = $_GET['filtre'];
		}
		if(!empty($_POST['choix']) && $_POST['choix']!=""){
			$action = 0;
			if(!empty($_POST["valider"])){
				$action = 2;
			}
			if(!empty($_POST["annuler"])){
				$action = 3;
			}
			$this->Demande->actionDemande($_POST['choix'],$action);
		}
	
		$data['listeDemande'] = $this->Demande->listeDemande($order,$etat);
		$this->load->view('ListeDemande', $data);
	}


	public function listeDemandeGrouper(){
		$this->load->model('Demande');
		$order = "0";
		if(!empty($_GET['id'])){
			$order = $_GET['id'];
		}
		$data["br"] = $this->Demande->BRDetail();
		$data['listeDemandeGrouper'] = $this->Demande->getDemandeGrouper($order);
		if(!empty($_GET["disp"])){
			$this->Demande->Dispatch();
			redirect('Welcome/listeDemande');
		}
		$data['page'] = 'DemandeGrouper.php';
		$this->load->view('AcceuilAppro', $data);
	}
	//Reynolds
	public function updatePrix()
	{
		// parameters
		$prix = $this->input->get('prix');
		$idProformaDetail = $this->input->get('idProformaDetail');
		$noteQualite = $this->input->get('noteQualite');

		$prix-=$noteQualite;

		// load model
		$this->load->model('ProformaModel');

		// $this->ProformaModel->updatePrix($idProformaDetail, $prix);

		// load view
		$this->moinsDisant();
	}

	public function insertNoteProforma()
	{	
		// parameters
		$qualiteNote = $this->input->get('qualiteNote');
		$quantiteNote = $this->input->get('quantiteNote');
		$prixNote = $this->input->get('prixNote');
		$idProforma = $this->input->get('idProforma');

		// load model
		$this->load->model('ProformaModel');

		// insert Note Proforma
		// $this->ProformaModel->insertNoteProforma($idProforma, $qualiteNote, $quantiteNote, $prixNote);

		// load view
		$this->listProforma();
	}

	public function noterProforma()
	{
		// load view
		$this->load->view('noterProforma');

	}

	public function listProforma()
	{
		// load model
		$this->load->model('ProformaModel');

		// list Proforma
		$data['listProforma'] = $this->ProformaModel->selectV_ProformaNonNote();

		// load view
		$this->load->view('listProforma', $data);
	}
	

	// ------------------

	public function moinsDisant()
	{
		// load model
		$this->load->model('ProformaModel');
		$data['product'] = $this->ProformaModel->selectProduitInGroup();
		$proform = [];
		foreach($data['product'] as $list){
			array_push($proform,$this->ProformaModel->moinsDisantPerProduct($list['idproduit']));
		}
		// listProforma order by Prix asc
		$data['MoinsDisant'] = $proform;

		//load view
		$this->load->view('moinsDisant', $data);

	}

	public function insertProforma()
	{
		// get all parameters
		$numero = $this->input->get('numero');
		$date = $this->input->get('date');
		$designation = $this->input->get('designation');
		$fournisseur = $this->input->get('fournisseur');
		$delai = $this->input->get('delai');
		$lieu = $this->input->get('lieu');
		$produitLength = $this->input->get('produitLength');

		// demande

		// load model
		$this->load->model('ProformaModel');

		// insert proforma
		$this->ProformaModel->insertProforma($numero, $date, $fournisseur);

		// get idProforma
		$idProforma = $this->ProformaModel->getId($numero, $date, $fournisseur);

		// insert proformadetail
		for ($i=1; $i <= $produitLength ; $i++) { 
			if ($this->input->get('produit'.$i) !== null) {
				$produit = $this->input->get('produit'.$i);
				$Qualite = $this->input->get('Qualite'.$i);
				$Quantite = $this->input->get('Quantite'.$i);
				$demande = $this->ProformaModel->getIdGroupement($produit);
				$Prix = $this->input->get('Prix'.$i);

				$this->ProformaModel->insertProformaDetail($Quantite, $delai, $lieu, $Prix, $idProforma, $produit, $Qualite, $demande);

			}
		}

		//redirect
		$this->saisieProforma1();
	}
	public function saisieProforma1()
	{
		//load models
		$this->load->model('FournisseurModel');
		$this->load->model('ProformaModel');
		$this->load->model('Demande');
		$order = "0";
		if(!empty($_GET['id'])){
			$order = $_GET['id'];
		}
		$data["br"] = $this->Demande->BRDetail();
		$data['listeDemandeGrouper'] = $this->Demande->getDemandeGrouper($order);
		//list Fournisseur
		$data['listFournisseur'] = $this->FournisseurModel->select('fournisseur');
		
		//list Produit
		$data['listProduit'] = $this->FournisseurModel->select('produit');

		//list Rubrique
		$data['listRubrique'] = $this->FournisseurModel->select('rubrique');

		//list Qualite
		$data['listQualite'] = $this->FournisseurModel->select('qualite');

		// numero proforma
		$data['numeroProforma'] = $this->ProformaModel->getNumero();

		//list demande
		$data['listDemande'] = $this->FournisseurModel->select('groupedemande');
		$data['page'] = 'saisieProforma.php';
		//load view
		$this->load->view('AcceuilAppro', $data);
	}
	public function saisieProforma()
	{
		//load models
		$this->load->model('Demande');
		$order = "0";
		if(!empty($_GET['id'])){
			$order = $_GET['id'];
		}
		$data["br"] = $this->Demande->BRDetail();
		$data['listeDemandeGrouper'] = $this->Demande->besoin($order);
		$this->load->model('FournisseurModel');
		$this->load->model('ProformaModel');

		//list Fournisseur
		$data['listFournisseur'] = $this->FournisseurModel->select('fournisseur');
		
		//list Produit
		$data['listProduit'] = $this->FournisseurModel->select('produit');

		//list Rubrique
		$data['listRubrique'] = $this->FournisseurModel->select('rubrique');

		//list Qualite
		$data['listQualite'] = $this->FournisseurModel->select('qualite');

		// numero proforma
		$data['numeroProforma'] = $this->ProformaModel->getNumero();

		//list demande
		$data['listDemande'] = $this->FournisseurModel->select('groupedemande');

		//load view
		$this->load->view('saisieProforma', $data);
	}

	public function fournisseurView()
	{
		$this->load->model('FournisseurModel');

		$data['listFournisseur'] = null;

		/*
			$data['listFournisseur'] = $this->FournisseurModel->select('fournisseur');
			$this->FournisseurModel->insertFournisseur("Tolotra", "JumboScore");
			$this->FournisseurModel->updateFournisseur(2, "Tolotra", "Shoprite");
			$this->FournisseurModel->deleteFournisseur(2);
		*/

		$this->load->view('fournisseurView', $data);
	}
//----------------------------------
	public function indexBon(){
		$this->load->model('GroupeDemande');
		$liste['demande']=$this->GroupeDemande->selectRegroupementDemande();
		$this->load->view('index',$liste);

	}
	function BC()
	{
		$this->load->library('pdf');
		$this->load->model('BC');
		$liste['bc']=$this->BC->voirBondeCommande($_GET['date']);
		if(isset($_GET['value'])){
			$liste['value']=$_GET['value'];
		}
		else{
			$liste['value']=0;
		}
		if(isset($_GET['page'])){
			$liste['page']=$_GET['page'];
		}
		else{
			$liste['page']=1;
		}
		$liste['date']=$_GET['date'];
		$html = $this->load->view('voirbcpdf', $liste, true);
		$this->pdf->createPDF($html, 'mypdf', false);
	}
	public function validerbc(){
		$this->load->model('BC');
		$liste['bc']=$this->BC->genererBonCommande($_POST['date']);
		$bc=$liste['bc'][$_POST['index']];
		for($i=0;$i<count($bc->getbcdetail());$i++){
		$bc->getbcdetail()[$i]->setdelaiPaiement($_POST['delai']);
		}
		$bc->saveBondeCommande();
		redirect('Welcome/indexBon');
	}

	public function voirBC(){
		$this->load->model('BC');
		$liste['bc']=$this->BC->voirBondeCommande($_GET['date']);
		if(isset($_GET['value'])){
			$liste['value']=$_GET['value'];
		}
		else{
			$liste['value']=0;
		}
		if(isset($_GET['page'])){
			$liste['page']=$_GET['page'];
		}
		else{
			$liste['page']=1;
		}
		$liste['date']=$_GET['date'];
		$this->load->view('voirbc',$liste);
	}
	public function genererBC(){
		$this->load->model('BC');
		$liste['bc']=$this->BC->genererBonCommande($_GET['date']);
		if(isset($_GET['value'])){
			$liste['value']=$_GET['value'];
		}
		else{
			$liste['value']=0;
		}
		if(isset($_GET['page'])){
			$liste['page']=$_GET['page'];
		}
		else{
			$liste['page']=1;
		}
		$liste['date']=$_GET['date'];
		$this->load->view('bc',$liste);
	}
	public function BRinformation(){
		$this->load->model('BR');
		$liste['br']=$this->BR->genererSaisieBR($_GET['idbc']);
		$liste['idbc']=$_GET['idbc'];
		$this->load->view('brresult',$liste);
	}
	public function saisiebr(){
		$this->load->Model('BC');
		$liste['bc']=$this->BC->getAllCommande();
		$this->load->view('br',$liste);
	}
	public function saveBR(){
		$this->load->model('BR');
		$liste['br']=$this->BR->genererSaisieBR($_POST['idbc']);
		$br=$liste['br'][0];
		var_dump($br);
		$br->setdateReception($_POST['reception']);
		for($i=0;$i<count($br->getBrDetail());$i++){
			$param='quantite:'.$i;
			$br->getBrDetail()[$i]->setquantiteCommande($_POST[$param]);
		}
		$br->updateEtatBC($_POST['idbc']);
		$br->saveBondeReception();
		redirect('Welcome/indexBon');
	}
	public function voirbondereceptionparcommande(){
		$this->load->Model('BC');
		$liste['bc']=$this->BC->getAllCommandeVoir();		
		$this->load->view('voirbr',$liste);
	}
	public function voirbondereception(){
		$this->load->model('BR');
		$liste['br']=$this->BR->voirBondereception($_GET['idbc']);
		$liste['idbc']=$_GET['idbc'];
		//var_dump($liste['br']);
		$this->load->view('brresult1',$liste);
	}
	public function BR(){
		$this->load->library('pdf');
		$this->load->model('BR');
		$liste['br']=$this->BR->voirBondereception($_GET['idbc']);
		$liste['idbc']=$_GET['idbc'];
		$html = $this->load->view('voirbrpdf', $liste, true);
		$this->pdf->createPDF($html, 'mypdf', false);
	}
	
}
?>