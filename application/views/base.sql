-- chauffeur
-- chargement
-- mode de Paiement
-- telephone
-- tapadalana
-- icone

-- create database transport;

CREATE EXTENSION IF NOT EXISTS pgcrypto;
CREATE TABLE cooperative (
  nom varchar(50),
  siege varchar(80),
  nif varchar(50),
  stat varchar(50),
  slogan_fr text,
  slogan_mg text,
  about_fr text,
  about_mg text,
  email varchar(50),
  telephone varchar(20),
  logo varchar(100)
);

CREATE TABLE services(
    id SERIAL PRIMARY KEY,
    img varchar(80),
    services_fr varchar(80),
    details_fr text,
    services_mg varchar(80),
    details_mg text
);

CREATE TABLE partenaire(
    id SERIAL PRIMARY KEY NOT NULL,
    entreprisepartenaire VARCHAR(40) NOT NULL,
    logoentreprisepartenaire VARCHAR(80),
    partenairedescription text,
    siteweb varchar(80),
    email varchar(80),
    contact varchar(20),
    etat_partenaire int default 1 -- 1 actif 0 inactif
);

SELECT * FROM partenaire;

CREATE TABLE faq(
    id SERIAL PRIMARY KEY NOT NULL,
    question_fr text NOT NULL,
    reponse_fr text NOT NULL,
    question_mg text NOT NULL,
    reponse_mg text NOT NULL,
    etat_faq int default 1 -- 1 actif 0 inactif
);

 
CREATE TABLE testimonials(
  id SERIAL PRIMARY KEY NOT NULL,
  temoignage text NOT NULL,
  datetestimonials timestamp default current_timestamp,
  status_temoignant varchar(50), -- exemple : client, partenaire,client passager,recepteur de colis,...
  etat_temoignage int default 1-- 1 en cours de validation --2 valide --0 supprimé
);

CREATE TABLE lien (
  id SERIAL,
  typelien varchar(50),
  lien varchar(200),
  icone varchar(50),
  etat int, -- 0 : supprimer, 1 : en attente d'approbation, 2 : valider
  PRIMARY KEY (id)
);

CREATE TABLE region (
  id SERIAL,
  region_fr varchar(255) UNIQUE,
  region_mg varchar(255) UNIQUE,
  etat int4, -- 0 : supprimer, 1 : en attente d'approbation, 2 : valider
  PRIMARY KEY (id)
);


CREATE TABLE status (
  id SERIAL NOT NULL,
  status varchar(50) UNIQUE,
  etat int4, -- 0 : supprimer, 1 : en attente d'approbation, 2 : valider
  PRIMARY KEY (id)
);


CREATE SEQUENCE seq_utilisateur START WITH 1;
-- ALTER SEQUENCE seq_utilisateur RESTART WITH 1;
CREATE TABLE utilisateur (
  id varchar(100) NOT NULL DEFAULT ('Utilisateur' || nextval('seq_utilisateur')),
  pseudo varchar(50),
  mdp varchar(200),
  nomcomplet varchar(100),
  numtel varchar(50),
  cin varchar(20),
  dtn date CHECK (DATE_PART('year', AGE(CURRENT_DATE, dtn)) >= 18),
  sexe char(1), -- m, f
  etat int DEFAULT 0,  -- 0 : supprimer, 1 : en attente d'approbation, 2 : valider
  status int REFERENCES status(id), -- 1 : Client, 2: Client fidèle, 3 : chauffeur, 4 : bureaucrate, 5 : admin, 6 : superadmin 
  dateenregistrement timestamp DEFAULT current_timestamp,
  parain varchar(100) default NULL REFERENCES utilisateur(id), -- La personne qui l'a embauchée
  regionid int REFERENCES region(id) default NULL,
  PRIMARY KEY (id)
);

CREATE SEQUENCE seq_typetransport START WITH 1;
-- ALTER SEQUENCE seq_typetransport RESTART 1;
CREATE TABLE typetransport (
  id varchar(100) NOT NULL DEFAULT ('Type_Transport' || nextval('seq_typetransport')),
  nom varchar(50),
  etat int4,
  PRIMARY KEY (id)
);


CREATE SEQUENCE seq_vehicule START WITH 1;
-- ALTER SEQUENCE seq_vehicule RESTART WITH 1;
CREATE TABLE vehicule (
  id varchar(100) NOT NULL DEFAULT ('Vehicule' || nextval('seq_vehicule')),
  immatriculation varchar(12),
  description TEXT,
  photo varchar(255),
  etat int default 0,-- 0 supprimer 1 en attente 2 valider
  statusvehicule int default 0, -- 0 en stationnement --9 en route
  typetransport varchar(100) REFERENCES typetransport(id),
  adminid varchar(100) NOT NULL REFERENCES utilisateur(id),
  PRIMARY KEY (id)
);



CREATE TABLE vehiculeindisponibilite(
  id SERIAL PRIMARY KEY,
  vehiculeid varchar(100) REFERENCES vehicule(id),
  datedebut timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  datefin timestamp CHECK(datedebut < datefin),
  raison text,
  etat int default 0 --0 en cours de validation  -- 8 validé  -- 15 refusé
);


CREATE SEQUENCE seq_trajet START WITH 1;
-- ALTER SEQUENCE seq_trajet RESTART WITH 1;
CREATE TABLE trajet (
  id varchar(100) NOT NULL DEFAULT ('Trajet' || nextval('seq_trajet')),
  depart int REFERENCES region(id) NOT NULL,
  arrive int REFERENCES region(id) NOT NULL,
  dureetrajet INTERVAL NOT NULL,
  distance INT NOT NULL,
  prix decimal(10,2) CHECK (prix >= 100000),
  etat int default 2, -- 0 supprimer 2 valider
  PRIMARY KEY (id)
);

CREATE TABLE trajet_route (
  id SERIAL PRIMARY KEY,
  trajet VARCHAR(100) REFERENCES Trajet(id),
  regionA int REFERENCES Region(id),
  regionB int REFERENCES Region(id),
  dureetrajet INTERVAL NOT NULL,
  distance INT NOT NULL,
  prix decimal(10,2) CHECK (prix >= 10000),
  etat int -- 0 supprimer  2 valider
);


CREATE SEQUENCE seq_voyage START WITH 1;
-- ALTER SEQUENCE seq_voyage RESTART WITH 1;
CREATE TABLE voyage (
  id varchar(100) DEFAULT ('Voyage' || nextval('seq_voyage')),
  datedepart timestamp DEFAULT CURRENT_TIMESTAMP,
  bureaucrate varchar(100) REFERENCES utilisateur(id),
  vehicule varchar(100) NOT NULL REFERENCES vehicule(id),
  trajetid varchar(100) NOT NULL REFERENCES trajet(id),
  etat int default 0, -- 0 : supprimer, 1 : en attente, 2 : valider
  PRIMARY KEY (id)
);

CREATE TABLE commission(
  id SERIAL PRIMARY KEY,
  commission decimal(10,2) CHECK(commission > 0),
  datecommission date DEFAULT CURRENT_DATE
);

CREATE TABLE tva (
  id SERIAL NOT NULL,
  valeur decimal(10,2) CHECK(valeur > 0),
  dateenregistrement date DEFAULT CURRENT_DATE,
  PRIMARY KEY (id)
);

CREATE SEQUENCE seq_caract START WITH 1;
CREATE TABLE vehiculecaracteristique (
  id varchar(100) NOT NULL DEFAULT ('Vehicule_Caracteristique' || nextval('seq_caract')),
  caracteristique varchar(50), -- Tonnage(Camion/Forgon), Longueur(Camion/Forgon), Largeur(Camion/Forgon), nombre de place(Bus)
  unite varchar(20),
  etat int4, -- 0 : supprimer, 1 : en attente, 2 : valider
  PRIMARY KEY (id)
);

CREATE TABLE detail_voiture (
  vehicule varchar(100) NOT NULL REFERENCES vehicule(id),
  caracteristiqueid varchar(100) NOT NULL REFERENCES vehiculecaracteristique(id),
  valeur decimal(10,2) CHECK(valeur > 0)
);


CREATE TABLE affectationvoyage(
  chauffeurid varchar(100) NOT NULL REFERENCES utilisateur(id),
  voyageid varchar(100) NOT NULL REFERENCES voyage(id)
);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
CREATE SEQUENCE seq_mode_paiement START WITH 1;
CREATE TABLE modedepaiement (
  id varchar(100) NOT NULL DEFAULT ('Paiement' || nextval('seq_mode_paiement')),
  mode varchar(50),
  PRIMARY KEY (id)
);

CREATE TABLE place(
  voyageid varchar(100) NOT NULL REFERENCES voyage(id),
  clientid varchar(100) NOT NULL REFERENCES utilisateur(id),
  numeroplace int CHECK (numeroplace > 0),
  datereservation timestamp default current_timestamp
);

-- LAST
CREATE TABLE vehiculeemplacement(
  vehiculeid varchar(100) NOT NULL REFERENCES vehicule(id),
  regionid int not null REFERENCES region(id),
  datearrive timestamp default current_timestamp
);

CREATE TABLE typeemballage(
  id SERIAL PRIMARY KEY,
  nomtypeemballage VARCHAR(45) NOT NULL UNIQUE
);

CREATE SEQUENCE seq_reception START WITH 1;
CREATE TABLE receptionmarchandise(
  id VARCHAR(100) PRIMARY KEY DEFAULT ('Reception' || nextval('seq_reception')),
  dateheurereception TIMESTAMP DEFAULT current_timestamp,
  expediteur VARCHAR(100) REFERENCES utilisateur(id), -- Utilisateur6, Utilisateur7
  nomreceptionniste VARCHAR(100) NOT NULL, -- nom en malgache
  cinreceptionniste VARCHAR(30) NOT NULL,
  contactreceptionniste VARCHAR(30) NOT NULL
);


CREATE TABLE naturemarchandise(
  id SERIAL PRIMARY KEY NOT NULL,
  nature VARCHAR(45) NOT NULL,
  prixunitaire decimal(10,2) CHECK (prixunitaire >= 1000)
);

CREATE TABLE stockage(
  id SERIAL PRIMARY KEY NOT NULL,
  nomstockage VARCHAR(40) NOT NULL,
  temperaturerecommande boolean
);

CREATE SEQUENCE seq_marchandise START WITH 1;
-- ALTER SEQUENCE seq_marchandise RESTART WITH 1;
CREATE TABLE marchandise (
  id VARCHAR(100) PRIMARY KEY DEFAULT ('Marchandise' || nextval('seq_marchandise')),
  nommarchandise VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  photo VARCHAR(40) NOT NULL,
  quantite int DEFAULT 1 CHECK (quantite > 0),
  naturemarchandise int references naturemarchandise(id), -- 1 : Produit alimentaire, 2 : Produit textile, 3 : Produit pharmaceutique, 4 : Engrais, 5 : Matériel de construction 
  poids decimal(10,2) CHECK (poids > 0),
  volume decimal(10,2) CHECK (volume > 0),
  fragilite int CHECK(fragilite >= 0 AND fragilite <= 10), -- 0: pas fragile, 10: très fragile
  receptionmarchandise varchar(100) NOT NULL REFERENCES receptionmarchandise(id), -- Reception1, Reception2, Reception3, Reception4, Reception5
  voyageid varchar(100) not null REFERENCES voyage(id),-- Voyage1, Voyage2, Voyage3, Voyage4, Voyage5, Voyage6, Voyage7, Voyage8
  typeemballage int default NULL REFERENCES typeemballage(id), -- 1: Carton, 2 : Emballage en bois, 3 : Emballage en scotch
  prixemballage decimal(10,2) default 0 CHECK(prixemballage >= 0),
  prixcolis decimal(10,2) CHECK(prixcolis > 500)
);

CREATE TABLE stockagemarchandise(
  marchandiseid VARCHAR(100) REFERENCES marchandise(id), -- Marchandise1, Marchandise2, Marchandise3, Marchandise4, Marchandise5, Marchandise6, Marchandise7, Marchandise8, Marchandise9, Marchandise10, Marchandise11, Marchandise12, Marchandise13, Marchandise14, Marchandise15
  stockageid int REFERENCES stockage(id), -- 1 : refroidisseur A, 2 : stockage A, 3 : refroidisseur B, 4 : stockage B
  temperature decimal(10,2) default 0 
);

CREATE TABLE chargement(
    marchandiseid VARCHAR(100) REFERENCES marchandise(id),
    voyageid varchar(100) NOT NULL REFERENCES voyage(id),
    datechargement timestamp DEFAULT CURRENT_TIMESTAMP,
    status int CHECK (status > 0), -- 0 : endommagé non payé, 1 : endommagé et payé, 2 : égratignure non payé, 3 : égratignure payé, 4 : bien arrivé non payé, 5 : bien arrivé et payé
    datearrivee timestamp default NULL
);


CREATE SEQUENCE seq_facture START WITH 1;
CREATE TABLE facture (
  id varchar(100) NOT NULL DEFAULT ('Facturecontroller' || nextval('seq_facture')),
  datefacture timestamp DEFAULT CURRENT_TIMESTAMP,
  clientid varchar(100) NOT NULL REFERENCES utilisateur(id),
  voyageid varchar(100) NOT NULL REFERENCES voyage(id),
  etat int CHECK(etat >= 0), -- 0 : non payé, 1 : payé à moitié non approuvé, 2 : payé totalement non approuvé, 3 : 1 : payé à moitié approuvé, 4 : payé totalement approuvé
  PRIMARY KEY (id)
);

CREATE SEQUENCE seq_factdetail START WITH 1;
CREATE TABLE facturedetail (
  id varchar(100) NOT NULL DEFAULT ('Facture_Detail' || nextval('seq_factdetail')),
  designation varchar(100),
  prixunitaire decimal(10,2),
  quantite int,
  totalht decimal(10,2),
  totaltva decimal(10,2),
  totalttc decimal(10,2),
  factureid varchar(100) NOT NULL REFERENCES facture(id),
  valeur decimal(10,2),
  unite varchar(50),
  PRIMARY KEY (id)
);

CREATE TABLE typedevis(
    id SERIAL PRIMARY KEY,
    nomtypedevis VARCHAR(50) UNIQUE NOT NULL -- Volume, Poids, Fragilité, Température
);

CREATE TABLE montantdevis(
    typedevisid INT REFERENCES typedevis(id),
    valeurdebut DECIMAL(10, 3) NOT NULL CHECK ( valeurdebut >= 0),
    valeurfin DECIMAL(10, 3) NOT NULL CHECK ( valeurfin >= 0),
    prixunitaire DECIMAL(10, 3) NOT NULL CHECK ( prixunitaire >= 1000)
);

---VIEWS
CREATE VIEW v_voyage as
SELECT voyage.*,vehicule.photo as imagevehicule,typetransport.nom as typetransport,trajet.prix,trajet.distance,region_depart.region_fr as depart_fr,region_arrivee.region_fr as arrive_fr,region_depart.region_mg as depart_mg,region_arrivee.region_mg as arrive_mg from voyage join Vehicule on vehicule.id=voyage.vehicule join typetransport on typetransport.id=vehicule.typetransport join trajet on trajet.id=voyage.trajetid JOIN region AS region_depart ON trajet.depart = region_depart.id JOIN region AS region_arrivee ON trajet.arrive = region_arrivee.id;

CREATE VIEW v_trajet as
SELECT trajet.*,region_depart.region_fr as region_depart_fr,region_arrivee.region_fr as region_arrivee_fr,region_depart.region_mg as region_depart_mg,region_arrivee.region_mg as region_arrivee_mg from trajet JOIN region AS region_depart ON trajet.depart = region_depart.id JOIN region AS region_arrivee ON trajet.arrive = region_arrivee.id;

CREATE VIEW v_montantdevis AS
SELECT * FROM montantdevis JOIN typedevis t on t.id = montantdevis.typedevisid;


CREATE OR REPLACE VIEW v_utilisateur AS SELECT utilisateur.*, r.etat AS etatregion, r.region_fr FROM utilisateur
    left JOIN region r on r.id = utilisateur.regionid;


CREATE VIEW v_vehicule AS
SELECT vehicule.id as vehicule_id, vehicule.immatriculation, vehicule.description, vehicule.photo, vehicule.etat as vehicule_etat, vehicule.statusvehicule, vehicule.typetransport, vehicule.adminid,
       t.nom as nom_typetransport, t.etat as typetransport_etat,
       u.*
FROM vehicule JOIN typetransport t on t.id = vehicule.typetransport
              JOIN v_utilisateur u on vehicule.adminid = u.id;

SELECT * FROM v_vehicule;

SELECT * FROM v_montantdevis;

SELECT *FROM utilisateur;

select * from marchandise join receptionmarchandise on receptionmarchandise.id=marchandise.receptionmarchandise;