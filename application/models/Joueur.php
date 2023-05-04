<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Joueur extends CI_Model
    {
        private $id;
        private $nom;
        private $email;
        private $pwd;
        public function getid(){
            return $this->id;
        }
        public function setid($id){
            $this->id = $id;
            return $this;
        }
        public function getnom(){
            return $this->nom;
        }
        public function setnom($nom){
            $this->nom = $nom;
            return $this;
        }
        public function getemail(){
            return $this->email;
        }
        public function setemail($email){
            $this->email = $email;
            return $this;
        }
        public function getpwd(){
            return $this->pwd;
        }
        public function setpwd($pwd){
            $this->pwd = $pwd;
            return $this;
        }
        public function inscription(){
            $sql = "INSERT INTO Joueur VALUES(DEFAULT,%s,%s,%s)";
            $sql = sprintf($sql,$this->db->escape($this->nom),$this->db->escape($this->email),$this->db->escape($this->pwd));
            $this->db->query($sql);
        }
        public function login(){
            $sql = $this->db->query("select*from joueur where email=".$this->db->escape($this->email)." and pwd=".$this->db->escape($this->pwd));
            //$sql = sprintf($sql,$this->db->escape($this->email),$this->db->escape($this->pwd));
            /*if($query->num_rows()>1 ||$query->num_rows()==0){
                throw new Exception("Mot de passe ou email incorrect");
            }
            else{
                return $query->result_array();
            }*/
            return $sql->result_array();
        }
        public function getListeCheval(){
            $sql = $this->db->query("select*from v_cheval");
            return $sql->result_array();
        }
        public function insertionCheval($idJoueur, $idCheval, $ordre){
            $sql = "INSERT INTO joueurchevaux VALUES(".$idJoueur.",".$idCheval.",".$ordre.")";
            $this->db->query($sql);
        }
        public function tirageAleatoire(){
            $sql = $this->db->query("select*from v_joueurchevaux order by random() limit 5");
            return $sql->result_array();
        }
    }
?>