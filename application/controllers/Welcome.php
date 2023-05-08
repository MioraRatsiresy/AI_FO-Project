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
		//categorie
		$url = 'https://intelligenceartificielle.alwaysdata.net/AI_BO_Project/IA-Categorie';

		$response = file_get_contents($url);
	
		$data['categorie'] = json_decode($response, true);

		//actualite
		$actualite_url='https://intelligenceartificielle.alwaysdata.net/AI_BO_Project/IA-Actualite';
		$response1 = file_get_contents($actualite_url);
		$data['actualite']= json_decode($response1, true);

		//evenement
		$event_url='https://intelligenceartificielle.alwaysdata.net/AI_BO_Project/IA-Evenement';
		$response2 = file_get_contents($event_url);
		$data['event']= json_decode($response2, true);

		$this->load->view('index',$data);	
	}
	public function detail($titre,$id)
	{
		$url = 'https://intelligenceartificielle.alwaysdata.net/AI_BO_Project/Actualites-Front/'.$titre.'/'.$id.'';

		$response = file_get_contents($url);
	
		$data = json_decode($response, true);

		$this->load->view('detail', $data);
	}	
}
?>