<?php
class BRDetail extends CI_Model
{
    private $idBrDetail;
    private $quantite;
    private $BRidBr;
    private $bcdetail;
    private $codeproduit;
    private $designation;
    private $quantiteCommande;
    private $quantiterestant;
    public function setquantiterestant($variable){
        $this->quantiterestant = $variable;
    }
    public function getquantiterestant(){
        return $this->quantiterestant;
    }
    public function setquantiteCommande($variable){
        $this->quantiteCommande = $variable;
    }
    public function getquantiteCommande(){
        return $this->quantiteCommande;
    }
    public function setcodeproduit($variable){
        $this->codeproduit = $variable;
    }
    public function getcodeproduit(){
        return $this->codeproduit;
    }
    public function setdesignation($variable){
        $this->designation = $variable;
    }
    public function getdesignation(){
        return $this->designation;
    }

    public function setidBrDetail($variable)
    {
        $this->idBrDetail = $variable;
    }
    public function getidBrDetail()
    {
        return $this->idBrDetail;
    }
    public function setbcdetail($variable)
    {
        $this->bcdetail = $variable;
    }
    public function getbcdetail()
    {
        return $this->bcdetail;
    }
    public function setquantite($idlogin)
    {
        $this->quantite = $idlogin;
    }
    public function getquantite()
    {
        return $this->quantite;
    }
    public function setBRidBr($idlogin)
    {
        $this->BRidBr = $idlogin;
    }
    public function getBRidBr()
    {
        return $this->BRidBr;
    }
    public function addBRDetail()
    {
        $sql = "INSERT INTO BRDetail(quantite,BRidBR,bcdetail) values ('" . $this->getquantiteCommande() . "','" . $this->selectlastBR() . "','" . $this->getbcdetail() . "')";
        $this->db->query($sql);
    }
    public function selectlastBR(){
        $requete="SELECT idBr from BR order by idBr DESC Limit 1";
        $query=$this->db->query($requete);
        $query=$query->result_array();
        $mvt=0;
        foreach($query as $query){
            $mvt=$query['idbr'];
        }
        return $mvt;
    }
    public function getBcDetailPresent($date,$id){
        $requete = "SELECT  * from DetailCommande where regroupement in (select id from groupedemande where idbc=".$id." and dategroupage='".$date."')";
        $query = $this->db->query( $requete );
        return $query->result_array();
    }
}
