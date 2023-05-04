DROP TABLE if exists Appro;
DROP TABLE if exists Demande;
DROP TABLE if exists chef_dept;
DROP TABLE if exists Note;
DROP TABLE if exists dept;
DROP TABLE if exists BRDetail;
DROP TABLE if exists BR;
DROP TABLE if exists BCDetail;
DROP TABLE if exists BC;
DROP TABLE if exists ProformaDetail;
DROP TABLE if exists Proforma;
DROP TABLE if exists Fournisseur;
DROP TABLE if exists produitQualite;
DROP TABLE if exists Produit;
DROP TABLE if exists qualite;
DROP TABLE IF exists rubrique;

CREATE TABLE Appro (
  idAppro INT AUTO_INCREMENT NOT NULL, 
  nom     varchar(50) NOT NULL, 
  prenom  varchar(50) NOT NULL, 
  login   varchar(50) NOT NULL, 
  mdp     varchar(100) NOT NULL, 
  PRIMARY KEY (idAppro)
);

CREATE TABLE BC (
  idBc                     INT AUTO_INCREMENT NOT NULL, 
  titre                    varchar(50) NOT NULL, 
  numero                   int NOT NULL, 
  FournisseuridFournisseur int NOT NULL, 
  dateCommande TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (idBc)
);

CREATE TABLE BCDetail (
  idBCDetail                     INT AUTO_INCREMENT NOT NULL, 
  BCidBc                         int NOT NULL, 
  ProformaDetailidProformaDetail int NOT NULL, 
  delaiPaiement                  int, 
  quantite int, 
  PRIMARY KEY (idBCDetail)
);

CREATE TABLE BR (
  idBr                     INT AUTO_INCREMENT NOT NULL,
  numero int, 
  DateReception            date NOT NULL, 
  idbc int,
  PRIMARY KEY (idBr)
);

CREATE TABLE BRDetail (
  idBRDetail INT AUTO_INCREMENT NOT NULL, 
  quantite   int, 
  BRidBr     int NOT NULL, 
  bcdetail int,
  PRIMARY KEY (idBRDetail)
);

ALTER TABLE BR ADD FOREIGN KEY (idbc) REFERENCES BC (idBc);
ALTER TABLE BRDetail ADD FOREIGN KEY (bcdetail) REFERENCES BCDetail (idBcDetail);

CREATE TABLE chef_dept (
  idChef_dept INT AUTO_INCREMENT NOT NULL, 
  nom         varchar(50) NOT NULL, 
  prenom      varchar(50) NOT NULL, 
  login       varchar(50) NOT NULL, 
  mdp         varchar(100) NOT NULL, 
  deptidDept  int NOT NULL, 
  PRIMARY KEY (idChef_dept)
);

CREATE TABLE Demande (
  idDemande        INT AUTO_INCREMENT NOT NULL, 
  quantite         int NOT NULL, 
  DateDemande      TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, 
  ProduitidProduit int NOT NULL, 
  etat             int DEFAULT 0 NOT NULL, 
  idDepartement    int NOT NULL,
  PRIMARY KEY (idDemande)
);

CREATE TABLE dept (
  idDept      INT AUTO_INCREMENT NOT NULL, 
  libelleDept varchar(50) NOT NULL, 
  PRIMARY KEY (idDept)
);

CREATE TABLE Fournisseur (
  idFournisseur  INT AUTO_INCREMENT NOT NULL, 
  nomFournisseur varchar(50) NOT NULL, 
  localisation   varchar(50) NOT NULL, 
  PRIMARY KEY (idFournisseur)
);

CREATE TABLE Produit (
  idProduit          INT AUTO_INCREMENT NOT NULL, 
  designation        varchar(50) NOT NULL, 
  rubriqueidRubrique int NOT NULL, 
  PRIMARY KEY (idProduit)
);

CREATE TABLE Proforma (
  idProforma               INT AUTO_INCREMENT NOT NULL, 
  numero                   int NOT NULL UNIQUE, 
  dateEmission             date NOT NULL, 
  FournisseuridFournisseur int NOT NULL, 
  PRIMARY KEY (idProforma)
);
CREATE TABLE Note (
  idNote INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
  idProformaDetail INTEGER NOT NULL,
  qualiteNote DOUBLE DEFAULT 0 CHECK(qualiteNote>=0),
  quantiteNote DOUBLE DEFAULT 0 CHECK(quantiteNote>=0),
  prixNote DOUBLE DEFAULT 0 CHECK(prixNote>=0)
);

CREATE TABLE qualite(
  idQualite INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
  type varchar(50) NOT NULL
);


CREATE TABLE ProformaDetail (
  idProformaDetail INTEGER AUTO_INCREMENT NOT NULL, 
  quantite int NOT NULL, 
  delaiLivraison date NOT NULL, 
  lieuLivraison varchar(50) NOT NULL, 
  prixU float NOT NULL, 
  ProformaidProforma int NOT NULL, 
  ProduitidProduit int NOT NULL, 
  idQualite int,
  PRIMARY KEY (idProformaDetail),
  FOREIGN KEY (ProformaidProforma) REFERENCES Proforma (idProforma),
  FOREIGN KEY (ProduitidProduit) REFERENCES Produit (idProduit),
  FOREIGN KEY (idQualite) REFERENCES qualite (idQualite)
);

CREATE TABLE rubrique (
  idRubrique INTEGER AUTO_INCREMENT NOT NULL, 
  genre varchar(50) NOT NULL, 
  PRIMARY KEY (idRubrique)
);

ALTER TABLE chef_dept  ADD FOREIGN KEY (deptidDept) REFERENCES dept (idDept);
ALTER TABLE Produit ADD FOREIGN KEY (rubriqueidRubrique) REFERENCES rubrique (idRubrique);
ALTER TABLE Demande ADD FOREIGN KEY (ProduitidProduit) REFERENCES Produit (idProduit);
ALTER TABLE ProformaDetail  ADD FOREIGN KEY (ProformaidProforma) REFERENCES Proforma (idProforma);
ALTER TABLE BCDetail ADD FOREIGN KEY (BCidBc) REFERENCES BC (idBc);
ALTER TABLE BCDetail ADD FOREIGN KEY (ProformaDetailidProformaDetail) REFERENCES ProformaDetail (idProformaDetail);
ALTER TABLE ProformaDetail  ADD FOREIGN KEY (ProduitidProduit) REFERENCES Produit (idProduit);
ALTER TABLE BC ADD ForeigN KEY (FournisseuridFournisseur) REFERENCES Fournisseur (idFournisseur);
ALTER TABLE BRDetail ADD FOREIGN KEY (BRidBr) REFERENCES BR (idBr);
ALTER TABLE Proforma ADD FOREIGN KEY (FournisseuridFournisseur) REFERENCES Fournisseur (idFournisseur);

ALTER TABLE Demande
ADD COLUMN idQualite INTEGER NOT NUL;

ALTER TABLE ProformaDetail
ADD FOREIGN KEY (idQualite) REFERENCES qualite (idQualite);

ALTER TABLE Produit 
ADD COLUMN codeProduit VARCHAR(10) Unique NOT NULL;

INSERT INTO dept VALUES
(default,'Securite');

INSERT INTO chef_dept VALUES
(default,'Lova','Elisa','lova@gmail.com','lova',1);

INSERT INTO rubrique VALUES
(default,'Tenue'),
(default,'Electro-menager');

insert into Produit values
(default,'Gant',1,'GNT'),
(default,'Botte',1,'BT'),
(default,'Combinaison',1,'CBN'),
(default,'Aspirateur',2,'ASP'),
(default,'Serpillere',2,'SRP');


insert into qualite values
(default, 'Cuir'),
(default, 'Polyester'),
(default, 'Antiderapantes'),
(default, 'Caoutchouc'),
(default, 'Jetable'),
(default, 'Protection chimique'),
(default, 'Robots'),
(default, 'Balais'),
(default, 'A Frange'),
(default, 'Eponge'),
(default, 'Plate');

create table produitQualite(
  idProduit int,
  idQualite int,
  foreign key(idProduit) REFERENCES Produit(idProduit),
  foreign key(idQualite) REFERENCES qualite(idQualite)
);

insert into produitQualite values 
(1,1),
(1,2),
(2,3),
(2,4),
(3,5),
(3,6),
(4,7),
(4,8),
(5,9),
(5,10),
(5,11);

create or replace view v_ProduitQualite as 
select pq.idProduit, p.designation, pq.idQualite, q.type as qualite from 
produitQualite pq 
join Produit p on pq.idProduit=p.idProduit 
join qualite q on q.idQualite=pq.idQualite;

create or replace view v_rubriqueProduit as 
select p.idproduit, p.designation,p.codeProduit, p.rubriqueidrubrique,r.genre 
from Produit p join rubrique r on p.rubriqueidrubrique=r.idRubrique;

create or replace view v_produit as 
select vrp.*,vp.idqualite,vp.qualite 
from v_rubriqueProduit vrp join v_ProduitQualite vp on vp.idproduit=vrp.idproduit;

create or replace view v_demande as 
select d.iddemande,d.quantite,d.datedemande,d.produitidproduit,
vp.designation,p.codeProduit,p.rubriqueidrubrique,vp.genre,d.etat,d.iddepartement,dept.libelledept,d.idqualite,q.type 
from Demande d join Produit p on p.idProduit=d.produitidproduit 
join v_rubriqueProduit vp on vp.idProduit=d.produitidproduit 
join dept on dept.iddept=d.iddepartement 
join qualite q on d.idqualite=q.idqualite;



CREATE TABLE GroupeDemande(
  id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
  quantite int4 NOT NULL,
  DateGroupage TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  ProduitidProduit int4 NOT NULL,
  idDemande varchar(100)
);

ALTER TABLE BCDetail
ADD COLUMN idGroupeDemande INTEGER NOT NULL,
ADD FOREIGN KEY(idGroupeDemande) REFERENCES GroupeDemande(id);

alter table ProformaDetail add column idGroupeDemande int;
alter table ProformaDetail add FOREIGN KEY (idGroupeDemande) REFERENCES GroupeDemande(id);
ALTER TABLE BRDetail ADD COLUMN etat int DEFAULT 0;
ALTER TABLE Demande ADD COLUMN recu int DEFAULT 0;

CREATE OR REPLACE VIEW ProduitRubrique
AS 
SELECT * FROM Produit 
JOIN Rubrique 
ON Produit.rubriqueidRubrique = Rubrique.idRubrique; 

CREATE OR REPLACE VIEW PRDemande 
AS
SELECT * FROM Demande 
JOIN ProduitRubrique
ON Demande.ProduitidProduit = ProduitRubrique.idProduit;

CREATE OR REPLACE VIEW PRDDepartement 
AS
SELECT * FROM PRDemande 
JOIN Dept
ON PRDemande.idDepartement = Dept.idDept;


CREATE OR REPLACE VIEW PRDemandeG 
AS
SELECT * FROM GroupeDemande 
JOIN ProduitRubrique
ON GroupeDemande.ProduitidProduit = ProduitRubrique.idProduit
;


CREATE OR REPLACE VIEW BRDetailPRDG AS
SELECT PRDemandeG.*,BRDetail.quantite
AS recu,etat,BCDetail.idgroupedemande
FROM BRDetail 
JOIN bcdetail 
ON BRDetail.bcdetail = bcdetail.idBCDetail
JOIN PRDemandeG 
ON bcdetail.idgroupedemande = PRDemandeG.id;

CREATE OR REPLACE VIEW v_brdetail AS
SELECT BRDetail.*,BCDetail.idgroupedemande
FROM BRDetail 
JOIN bcdetail 
ON BRDetail.bcdetail = bcdetail.idBCDetail;

alter table ProformaDetail add column idGroupeDemande int;
alter table ProformaDetail add FOREIGN KEY (idGroupeDemande) REFERENCES GroupeDemande(id);

INSERT INTO Appro VALUES
(DEFAULT,'RALIJAONA','Tolotra Fanomezantsoa','Tolotra','0000');

INSERT INTO Dept VALUES
(DEFAULT,'Information-Technologie'),
(DEFAULT,'Ressources-Humaines'),
(DEFAULT,'Production'),
(DEFAULT,'Ventes et Marketing'),
(DEFAULT,'Service Client'),
(DEFAULT,'Administration generale'),
(DEFAULT,'Comptabilite et finance');

INSERT INTO chef_dept VALUES
(DEFAULT,'RANAIVOMANANA','David Laroch','e001','0000',1),
(DEFAULT,'RAKOTOZANANY','Fenitra Fitahiana','e002','0000',2),
(DEFAULT,'RAFANANTENANA','Faly Nomena','e003','0000',3),
(DEFAULT,'RASOANIRINA','Ravao Todisoa','e004','0000',4),
(DEFAULT,'TANTELINIANA','Nomentsoa Henikaja','e005','0000',5),
(DEFAULT,'FARAMALALA','Steevy','e006','0000',6),
(DEFAULT,'ARIVINOMENA','Donald','e007','0000',7);

CREATE OR REPLACE view v_chefDept AS
SELECT cd.*,dept.* FROM chef_dept cd 
JOIN dept
ON cd.deptidDept = dept.iddept;

INSERT INTO Fournisseur VALUES 

(DEFAULT,'SOCOMA','Lot IV W 54 ZX Anosizato Est'),
(DEFAULT,'VETYLING','IB Isoraka'),
(DEFAULT,'CORNALINE FACTORY','Lot IIY13X Ambaranjana '),
(DEFAULT,'Braseries SATR ','4G67+G33, Rue Docteur Joseph Raseta '),
(DEFAULT,'SYGMA Distribution','111 rue de Liège Tsaralalana'),
(DEFAULT,'SOCOLAIT','5H23+MQF,Rue Dr Razafimpanilo '),
(DEFAULT,'Habibo Group','LOT III C 42 IFARIHY Tanjombato '),
(DEFAULT,'SOREDIM SA','Rue Ravoninahitriniavo Ankorondrano'),
(DEFAULT,'VISTA','Dans tout '),
(DEFAULT,'LINGTOOK','Dans tout ');

create or replace view V_ProformaNonNote as
   select
     Proforma.*,
     Fournisseur.nomFournisseur,
     ProformaDetail.*
   from 
     Proforma
   join
    Fournisseur
     on Proforma.FournisseuridFournisseur = Fournisseur.idFournisseur
    join ProformaDetail
        on proforma.idProforma=ProformaDetail.proformaidproforma
   where ProformaDetail.proformaidProforma not in 
     (
       select idProformaDetail from note
     )
   ;


  create or replace view v_MoinsDisant as
    select
      ProformaDetail.idProformaDetail as idProformaDetail,
      Proforma.idProforma as idProforma,
      Proforma.numero as numero,
      Proforma.dateEmission,
      ProformaDetail.delaiLivraison,
      ProformaDetail.lieuLivraison,
      ProformaDetail.ProduitidProduit as idProduit,
      Produit.designation,
      ProformaDetail.quantite,
      ProformaDetail.prixu as prix, 
      Qualite.type as qualite,
      nomFournisseur 
    from 
      Proforma
    join
      ProformaDetail
      on Proforma.idProforma = ProformaDetail.ProformaidProforma
    join
      Produit
      on ProformaDetail.ProduitidProduit = Produit.idProduit
    join Qualite
      on ProformaDetail.idQualite = Qualite.idQualite
    join Fournisseur
      on Proforma.FournisseuridFournisseur = Fournisseur.idFournisseur
    WHERE idgroupedemande NOT IN(SELECT idgroupedemande FROM bcdetail);


ALTER TABLE ProformaDetail 
ADD COLUMN Etat INTEGER DEFAULT 0;


ALTER TABLE BC 
ADD COLUMN etat INTEGER NOT NULL DEFAULT 0;

CREATE VIEW DetailCommande as select BC.*,Bcdetail.*,Produit.codeProduit,Produit.designation,rubrique.genre,Fournisseur.*,ProformaDetail.prixu from bc join bcdetail on bcdetail.bcidbc=bc.idbc join ProformaDetail on ProformaDetail.idProformaDetail=BCdetail.ProformaDetailidProformaDetail join Produit on Produit.idProduit=ProformaDetail.ProduitidProduit join Fournisseur on Fournisseur.idFournisseur=BC.fournisseuridfournisseur join rubrique on rubrique.idRubrique=Produit.rubriqueidRubrique join qualite on qualite.idqualite=ProformaDetail.idqualite;


CREATE or replace VIEW DetailProforma as select Proforma.*,ProformaDetail.quantite,ProformaDetail.idqualite,ProformaDetail.delaiLivraison,ProformaDetail.lieuLivraison,ProformaDetail.prixU,ProformaDetail.ProduitidProduit,Produit.codeProduit,Produit.designation,rubrique.genre,ProformaDetail.idGroupeDemande,ProformaDetail.idProformaDetail,ProformaDetail.etat,Note.prixNote from Proforma join proformadetail on proformadetail.ProformaidProforma=proforma.idproforma  left join Note on Note.idProformaDetail=ProformaDetail.idProformaDetail join Produit on Produit.idProduit=ProformaDetail.ProduitidProduit join rubrique on rubrique.idRubrique=Produit.rubriqueidRubrique join qualite on qualite.idqualite=ProformaDetail.idqualite;

--fonction getcommande 
CREATE FUNCTION getCommande(dateregroup DATE)
RETURNS TABLE (
  proforma INT,
  fournisseur INT,
  quantite INT,
  produit INT, 
  prix DOUBLE,
  total DOUBLE,
  etat INT
)
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE f_idProformaDetail INT;
  DECLARE f_fournisseuridfournisseur INT;
  DECLARE f_quantite INT;
  DECLARE f_produitidproduit INT;
  DECLARE f_prixU DOUBLE;
  DECLARE f_total DOUBLE;
  DECLARE f_etat INT;
  DECLARE g_id INT;
  DECLARE g_quantite INT;
  DECLARE g_produitidproduit INT;
  DECLARE q DOUBLE;
  DECLARE actuel DOUBLE;

  DECLARE cur_g CURSOR FOR SELECT id, quantite, produitidProduit FROM GroupeDemande WHERE DateGroupage = dateregroup;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur_g;

  group_loop: LOOP
    FETCH cur_g INTO g_id, g_quantite, g_produitidproduit;

    IF done THEN
      LEAVE group_loop;
    END IF;

    SET q = 0;
    SET actuel = 0;

    DECLARE cur_f CURSOR FOR 
      SELECT idProformaDetail, fournisseuridfournisseur, quantite, produitidproduit, prixU, quantite * prixU AS total, etat 
      FROM DetailProforma 
      WHERE produitidProduit = g_produitidproduit AND idGroupeDemande = g_id 
      ORDER BY prixU ASC, prixNote DESC;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur_f;

    detail_loop: LOOP
      FETCH cur_f INTO f_idProformaDetail, f_fournisseuridfournisseur, f_quantite, f_produitidproduit, f_prixU, f_total, f_etat;

      IF done THEN
        CLOSE cur_f;
        LEAVE detail_loop;
      END IF;

      SET q = q + f_quantite;
      SET actuel = f_quantite;

      IF q > g_quantite THEN
        SET proforma = f_idProformaDetail;
        SET fournisseur = f_fournisseuridfournisseur;
        SET quantite = -(q - g_quantite - actuel);
        SET produit = f_produitidproduit;
        SET prix = f_prixU;
        SET total = quantite * prix;
        SET etat = f_etat;
        RETURN NEXT;
        CLOSE cur_f;
        LEAVE group_loop;
      END IF;

      IF q = g_quantite THEN
        SET proforma = f_idProformaDetail;
        SET fournisseur = f_fournisseuridfournisseur;
        SET quantite = f_quantite;
        SET produit = f_produitidproduit;
        SET prix = f_prixU;
        SET total = quantite * prix;
        SET etat = f_etat;
        RETURN NEXT;
        CLOSE cur_f;
        LEAVE group_loop;
      END IF;

      SET proforma = f_idProformaDetail;
      SET fournisseur = f_fournisseuridfournisseur;
      SET quantite = f_quantite;
      SET produit = f_produitidproduit;
      SET prix = f_prixU;
      SET total = quantite * prix;
      SET etat = f_etat;
      RETURN NEXT;
    END LOOP;

    CLOSE cur_f;
  END LOOP;

  CLOSE cur_g
