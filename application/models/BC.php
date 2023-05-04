<?php 
    require_once 'BCDetail.php';
    class BC extends CI_Model
    {
        private $idBc;
        private $titre;
        private $numero;
        private $FournisseuridFournisseur;
        private $Fournisseurnom;
        private $Fournisseurlocation;
        private $datecommande;
        private $bcdetail;
        private $ht;
        private $tva;
        private $ttc;
        private $montantlettre;
    
        public function setmontantlettre($idlogin){
            $this->montantlettre = $idlogin;
        }
        public function getmontantlettre(){
            return $this->montantlettre;
        }
        public function setht($idlogin){
            $this->ht = $idlogin;
        }
        public function getht(){
            return $this->ht;
        }
        public function settva($idlogin){
            $this->tva = $idlogin;
        }
        public function gettva(){
            return $this->tva;
        }
        public function setttc($idlogin){
            $this->ttc = $idlogin;
        }
        public function getttc(){
            return $this->ttc;
        }
        public function setFournisseurnom($idlogin){
            $this->Fournisseurnom = $idlogin;
        }
        public function getFournisseurnom(){
            return $this->Fournisseurnom;
        }
        public function setFournisseurlocation($idlogin){
            $this->Fournisseurlocation = $idlogin;
        }
        public function getFournisseurlocation(){
            return $this->Fournisseurlocation;
        }
        public function setidBc($variable){
            $this->idBc = $variable;
        }
        public function getidBc(){
            return $this->idBc;
        }
        public function settitre($idlogin){
            $this->titre = $idlogin;
        }
        public function gettitre(){
            return $this->titre;
        }
        public function setnumero($idlogin){
            $this->numero = $idlogin;
        }
        public function getnumero(){
            return $this->numero;
        }
        public function setFournisseuridFournisseur($idlogin){
            $this->FournisseuridFournisseur = $idlogin;
        }
        public function getFournisseuridFournisseur(){
            return $this->FournisseuridFournisseur;
        }
        public function setbcdetail($idlogin){
            $this->bcdetail = $idlogin;
        }
        public function getbcdetail(){
            return $this->bcdetail;
        }
        public function setdatecommande(){
            $this->datecommande = date("d/m/Y");
        }
        public function getdatecommande(){
            return $this->datecommande;
        }
        public function addBC(){
            $sql = "INSERT INTO BC(titre,numero,FournisseuridFournisseur) values ('".$this->gettitre()."','".$this->getnumero()."','".$this->getFournisseuridFournisseur()."')";
            $this->db->query($sql);

        }
        public function updateEtatBC($id){
            $sql = "Update BC set etat=1 where idbc=".$id;
            $this->db->query($sql);

        }
        public function getMontant($date,$fournisseur){
            $requete = "select fournisseur,sum(total) as ht,(sum(total)*0.2) as TVA,sum(total)+(sum(total)*0.2) as TTC from getCommande('".$date."') where fournisseur=".$fournisseur." group by fournisseur";
            $query = $this->db->query( $requete );
            return $query->result_array();

        }
        public function selectlastmvt(){
            $requete="SELECT numero from BC order by idbc DESC Limit 1";
            $query=$this->db->query($requete);
            $query=$query->result_array();

            $requete1="SELECT * from BC";
            $query1=$this->db->query($requete1);
            $query1=$query1->result_array();
            $count=0;
            foreach($query1 as $query1){
                $count=$count+1;
            }
            $mvt=0;
            foreach($query as $query){
                $mvt=$query['numero']+1;
            }
            if($count==0){
                $mvt=$mvt+1;
            }
            return $mvt;
        }
        public function saveBondeCommande(){
            $this->addBC();
            for($i=0;$i<count($this->getbcdetail());$i++){
                $this->getbcdetail()[$i]->addBCDetail();
                $this->getbcdetail()[$i]->updateProformaDetail($this->getbcdetail()[$i]->getProformaDetailidProformaDetail());
            }
        }
        public function getbonCommande($date){
            $requete = "select Fournisseur.* from getCommande('".$date."') join Fournisseur on Fournisseur.idFournisseur=fournisseur where getCommande.etat=0 group by idfournisseur";
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
        public function getbonCommandeDetail($date,$fournisseur){
            $requete = "select Fournisseur.*,DetailProforma.*,getCommande.quantite as quantiteaprendre,getCommande.total from getCommande('".$date."') join Fournisseur on Fournisseur.idFournisseur=fournisseur join DetailProforma on detailproforma.idproformadetail=proforma where getCommande.etat=0 and fournisseur=".$fournisseur."";
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
        public function genererBonCommande($date){
            $bc=array();
            $i=0;
            foreach ($this->getbonCommande($date) as $bdc) {
                //set bc
                $bc[$i]=new BC();
                $bc[$i]->settitre("Bon de commande");
                $bc[$i]->setdatecommande();
                $bc[$i]->setFournisseuridFournisseur($bdc['idfournisseur']);
                $bc[$i]->setFournisseurnom($bdc['nomfournisseur']);
                $bc[$i]->setFournisseurlocation($bdc['localisation']);
                $bc[$i]->setnumero($this->selectlastmvt());
                foreach ($this->getMontant($date,$bdc['idfournisseur']) as $montant) {
                    $bc[$i]->setht(number_format($montant['ht']));
                    $bc[$i]->settva(number_format($montant['tva']));
                    $bc[$i]->setttc(number_format($montant['ttc']));
                    $bc[$i]->setmontantlettre($montant['ttc']);
                }
                // set bcdetail
                $bcdetail=array();
                $j=0;
                foreach ($this->getbonCommandeDetail($date,$bdc['idfournisseur']) as $bcd) {
                    $bcdetail[$j]=new BCDetail();
                    $bcdetail[$j]->setcodeproduit($bcd['codeproduit']);
                    $bcdetail[$j]->setdesignation($bcd['designation']);
                    $bcdetail[$j]->setquantite($bcd['quantiteaprendre']);
                    $bcdetail[$j]->setprixu(number_format($bcd['prixu']));
                    $bcdetail[$j]->settotal(number_format($bcd['total']));
                    $bcdetail[$j]->setProformaDetailidProformaDetail($bcd['idproformadetail']);
                    $bcdetail[$j]->setregroupement($bcd['idgroupedemande']);
                    $j=$j+1;
                }
                $bc[$i]->setbcdetail($bcdetail);
                $i=$i+1;
            }
            return $bc;
        }

        public function voirBondeCommande($date){
            $bc=array();
            $i=0;
            foreach ($this->getBcPresent($date) as $bdc) {
                $detail=new BCDetail();
                //set bc
                $bc[$i]=new BC();
                $bc[$i]->settitre($bdc['titre']);
                $bc[$i]->setdatecommande();
                $bc[$i]->setFournisseuridFournisseur($bdc['fournisseuridfournisseur']);
                $bc[$i]->setFournisseurnom($bdc['nomfournisseur']);
                $bc[$i]->setFournisseurlocation($bdc['localisation']);
                $bc[$i]->setnumero($bdc['numero']);
                foreach ($this->getMontant($date,$bdc['fournisseuridfournisseur']) as $montant) {
                    $bc[$i]->setht(number_format($montant['ht']));
                    $bc[$i]->settva(number_format($montant['tva']));
                    $bc[$i]->setttc(number_format($montant['ttc']));
                    $bc[$i]->setmontantlettre($montant['ttc']);
                }
                // set bcdetail
                $bcdetail=array();
                $j=0;
                foreach ($detail->getBcDetailPresent($date,$bdc['idbc']) as $bcd) {
                    $bcdetail[$j]=new BCDetail();
                    $bcdetail[$j]->setcodeproduit($bcd['codeproduit']);
                    $bcdetail[$j]->setdesignation($bcd['designation']);
                    $bcdetail[$j]->setquantite($bcd['quantite']);
                    $bcdetail[$j]->setprixu(number_format($bcd['prixu']));
                    $bcdetail[$j]->settotal(number_format($bcd['quantite']*$bcd['prixu']));
                    $bcdetail[$j]->setProformaDetailidProformaDetail($bcd['proformadetailidproformadetail']);
                    $bcdetail[$j]->setregroupement($bcd['idgroupedemande']);
                    $bcdetail[$j]->setdelaiPaiement($bcd['delaipaiement']);
                    $j=$j+1;
                }
                $bc[$i]->setbcdetail($bcdetail);
                $i=$i+1;
            }
            return $bc;            

        }
        public function getBcPresent($date){
            $requete = "SELECT  BC.*,Fournisseur.* from BC join Bcdetail on bcdetail.bcidbc=bc.idbc join ProformaDetail on ProformaDetail.idProformaDetail=BCdetail.ProformaDetailidProformaDetail join Produit on Produit.idProduit=ProformaDetail.ProduitidProduit join Fournisseur on Fournisseur.idFournisseur=BC.fournisseuridfournisseur join rubrique on rubrique.idRubrique=Produit.rubriqueidRubrique join qualite on qualite.idqualite=ProformaDetail.idqualite where BCdetail.idgroupedemande in (select id from groupedemande where dategroupage='".$date."') group by idbc,fournisseur.idfournisseur";
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
        public function DetailProforma($idqualite,$produitidproduit) {
            $requete = "SELECT * FROM DetailProforma where produitidproduit=".$produitidproduit." and idqualite=".$idqualite." order by prixu ASC";
            $query = $this->db->query( $requete );
            return $query->result_array();
    
        }
        public function getAllCommande(){
            $requete = "SELECT * FROM BC join Fournisseur on Fournisseur.idFournisseur=BC.FournisseuridFournisseur where etat=0";
            $query = $this->db->query( $requete );
            return $query->result_array();           
        }
        public function getAllCommandeVoir(){
            $requete = "SELECT * FROM BC join Fournisseur on Fournisseur.idFournisseur=BC.FournisseuridFournisseur where etat=1";
            $query = $this->db->query( $requete );
            return $query->result_array();           
        }
    }
