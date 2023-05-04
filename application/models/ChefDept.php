<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class ChefDept extends CI_Model
    {
        private $idchef_dept;
        private $nom;
        private $prenom;
        private $login;
        private $mdp;
        private $deptiddept;
        public function getidchef_dept(){
            return $this->idchef_dept;
        }
        public function setidchef_dept($idchef_dept){
            $this->idchef_dept = $idchef_dept;
            return $this;
        }
        public function getnom(){
            return $this->nom;
        }
        public function setnom($nom){
            $this->nom = $nom;
            return $this;
        }
        public function getprenom(){
            return $this->prenom;
        }
        public function setprenom($prenom){
            $this->prenom = $prenom;
            return $this;
        }
        public function getmdp(){
            return $this->mdp;
        }
        public function setmdp($mdp){
            $this->mdp = $mdp;
            return $this;
        }
        public function getlogin(){
            return $this->login;
        }
        public function setlogin($login){
            $this->login = $login;
            return $this;
        }
        public function getdeptiddept(){
            return $this->deptiddept;
        }
        public function setdeptiddept($deptiddept){
            $this->deptiddept = $deptiddept;
            return $this;
        }
        public function login($email,$mdp){
            $sql = $this->db->query("select*from v_chefDept where login='".$email."' and mdp='".$mdp."'");
            return $sql->result_array();
        }
        public function getListeRubrique(){
            $sql = $this->db->query("select*from rubrique");
            return $sql->result_array();
        }
        public function getDesignationByRubrique($idRubrique){
            $sql = $this->db->query("select*from produit where rubriqueidrubrique=".$idRubrique);
            return $sql->result_array();
        }
        public function getQualiteByDesignation($idDesignation){
            $sql = $this->db->query("select*from v_ProduitQualite where idProduit=".$idDesignation);
            return $sql->result_array();
        }
        public function getQualite(){
            $sql = $this->db->query("select*from qualite");
            return $sql->result_array();
        }
        public function insertDemandeTemporaire($quantite,$produitidproduit,$iddepartement,$idqualite){
            $sql = "INSERT INTO demande VALUES(default,".$quantite.",current_date,".$produitidproduit.",0,".$iddepartement.",".$idqualite.")";
            //echo $sql;
            $this->db->query($sql);
        }
        public function getDemandeTemporaire($idDept){
            $sql = $this->db->query("select*from v_demande where etat=0 and iddepartement=".$idDept);
            return $sql->result_array();
        }
        public function saveDemande($idDept){
            $sql = "update demande set etat=1 where etat=0 and iddepartement=".$idDept;
            $this->db->query($sql);
        }
        public function newRubrique($rubrique){
            $sql = "insert into rubrique values(default,'".$rubrique."')";
            $this->db->query($sql);
        }
        public function newQualite($qualite){
            $sql = "insert into qualite values(default,'".$qualite."')";
            $this->db->query($sql);
        }
        public function newProduit($designation,$idRubrique,$code){
            $sql = "insert into produit values(default,'".$designation."',".$idRubrique.",'".$code."')";
            $this->db->query($sql);
        }
        public function newProduitQualite($idProduit,$idQualite){
            $sql = "insert into produitQualite values('".$idProduit."',".$idQualite.")";
            $this->db->query($sql);
        }
        public function updateLigneDemande($idDemande,$quantite){
            $sql = "update demande set quantite=".$quantite." where iddemande=".$idDemande;
            $this->db->query($sql);
        }
        public function deleteLigneDemande($idDemande){
            $sql = "delete from demande where iddemande=".$idDemande;
            $this->db->query($sql);
        }
        public function getLastProduitInserer(){
            $sql=$this->db->query("select last_value as idProduit from produit_idproduit_seq");
            return $sql->result_array();
        }
        public function getListeProduit(){
            $sql=$this->db->query("select*from v_rubriqueproduit");
            return $sql->result_array();
        }
        public function getInfoToUpdate($categorie,$search){
            if(strcmp($categorie,'rubrique')==0){
                $sql=$this->db->query("select*from rubrique where idrubrique=".$search);
                //echo "select*from rubrique where idrubrique=".$search;
            }
            if(strcmp($categorie,'produit')==0){
                $sql=$this->db->query("select*from v_produit where idproduit=".$search);
                //echo "select*from v_produit where idproduit=".$search;
            }
            if(strcmp($categorie,'qualite')==0){
                $sql=$this->db->query("select*from qualite where idqualite=".$search);
                //echo "select*from qualite where idqualite=".$search;
            }
            return $sql->result_array();
        }
        public function updateQualite($idQualite, $qualite){
            $sql = "update qualite set type='".$qualite."' where idqualite=".$idQualite;
            $this->db->query($sql);
        }
        public function deleteQualite($idQualite){
            $sql = "delete from produitqualite where idqualite=".$idQualite;
            $this->db->query($sql);
            $sql = "delete from qualite where idqualite=".$idQualite;
            $this->db->query($sql);
        }
        public function updateRubrique($idRubrique, $rubrique){
            $sql = "update rubrique set genre='".$rubrique."' where idrubrique=".$idRubrique;
            $this->db->query($sql);
        }
        public function deleteRubrique($idRubrique){
            $sql = "delete from produit where rubriqueidrubrique=".$idRubrique;
            $this->db->query($sql);
            $sql = "delete from rubrique where idrubrique=".$idRubrique;
            $this->db->query($sql);
        }
        public function deleteProduitQualite($idQualite,$idProduit){
            $sql = "delete from produitqualite where idProduit=".$idProduit." and idQualite=".$idQualite;
            $this->db->query($sql);
        }
        public function getListeProduitAll(){
            $sql=$this->db->query("select*from v_produit");
            return $sql->result_array();
        }
        public function updateProduit($idProduit, $designation, $code){
            $sql = "update produit set designation='".$designation."', codeproduit='".$code."' where idproduit=".$idProduit;
            //echo $sql;
            $this->db->query($sql);
        }
    }
