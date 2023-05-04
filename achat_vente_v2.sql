CREATE TABLE Appro (
  idAppro SERIAL NOT NULL, 
  nom     varchar(50) NOT NULL, 
  prenom  varchar(50) NOT NULL, 
  login   varchar(50) NOT NULL, 
  mdp     varchar(100) NOT NULL, 
  PRIMARY KEY (idAppro));
CREATE TABLE BC (
  idBc                     SERIAL NOT NULL, 
  titre                    varchar(50) NOT NULL, 
  numero                   int4 NOT NULL, 
  FournisseuridFournisseur int4 NOT NULL, 
  dateCommande date DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (idBc));
CREATE TABLE BCDetail (
  idBCDetail                     SERIAL NOT NULL, 
  BCidBc                         int4 NOT NULL, 
  ProformaDetailidProformaDetail int4 NOT NULL, 
  delaiPaiement                  int4, 
  quantite int4, 
  PRIMARY KEY (idBCDetail));

--nanampiako le table br sy brdetail
CREATE TABLE BR (
  idBr                     SERIAL NOT NULL,
  numero int, 
  DateReception            date NOT NULL, 
  idbc int,
  PRIMARY KEY (idBr));
CREATE TABLE BRDetail (
  idBRDetail SERIAL NOT NULL, 
  quantite   int4, 
  BRidBr     int4 NOT NULL, 
  bcdetail int,
  PRIMARY KEY (idBRDetail));

ALTER TABLE BR ADD FOREIGN KEY (idbc) REFERENCES BC (idbc);
ALTER TABLE BRDetail ADD FOREIGN KEY (bcdetail) REFERENCES BCDetail (idBcDetail);

CREATE TABLE chef_dept (
  idChef_dept SERIAL NOT NULL, 
  nom         varchar(50) NOT NULL, 
  prenom      varchar(50) NOT NULL, 
  login       varchar(50) NOT NULL, 
  mdp         varchar(100) NOT NULL, 
  deptidDept  int4 NOT NULL, 
  PRIMARY KEY (idChef_dept));
CREATE TABLE Demande (
  idDemande        SERIAL NOT NULL, 
  quantite         int4 NOT NULL, 
  DateDemande      date DEFAULT CURRENT_TIMESTAMP NOT NULL, 
  ProduitidProduit int4 NOT NULL, 
  etat             int4 DEFAULT 0 NOT NULL, 
  PRIMARY KEY (idDemande));
CREATE TABLE dept (
  idDept      SERIAL NOT NULL, 
  libelleDept varchar(50) NOT NULL, 
  PRIMARY KEY (idDept));
CREATE TABLE Fournisseur (
  idFournisseur  SERIAL NOT NULL, 
  nomFournisseur varchar(50) NOT NULL, 
  localisation   varchar(50) NOT NULL, 
  PRIMARY KEY (idFournisseur));
CREATE TABLE Produit (
  idProduit          SERIAL NOT NULL, 
  designation        varchar(50) NOT NULL, 
  rubriqueidRubrique int4 NOT NULL, 
  PRIMARY KEY (idProduit));
CREATE TABLE Proforma (
  idProforma               SERIAL NOT NULL, 
  numero                   int4 NOT NULL UNIQUE, 
  dateEmission             date NOT NULL, 
  FournisseuridFournisseur int4 NOT NULL, 
  PRIMARY KEY (idProforma));
CREATE TABLE ProformaDetail (
  idProformaDetail   SERIAL NOT NULL, 
  quantite           int4 NOT NULL, 
  qualite            varchar(50) NOT NULL, 
  delaiLivraison     date NOT NULL, 
  lieuLivraison      varchar(50) NOT NULL, 
  prixU              float8 NOT NULL, 
  ProformaidProforma int4 NOT NULL, 
  ProduitidProduit   int4 NOT NULL, 
  PRIMARY KEY (idProformaDetail));
CREATE TABLE rubrique (
  idRubrique SERIAL NOT NULL, 
  genre      varchar(50) NOT NULL, 
  PRIMARY KEY (idRubrique));
ALTER TABLE chef_dept ADD CONSTRAINT FKchef_dept261860 FOREIGN KEY (deptidDept) REFERENCES dept (idDept);
ALTER TABLE Produit ADD CONSTRAINT FKProduit590254 FOREIGN KEY (rubriqueidRubrique) REFERENCES rubrique (idRubrique);
ALTER TABLE Demande ADD CONSTRAINT FKDemande826349 FOREIGN KEY (ProduitidProduit) REFERENCES Produit (idProduit);
ALTER TABLE ProformaDetail ADD CONSTRAINT FKProformaDe380539 FOREIGN KEY (ProformaidProforma) REFERENCES Proforma (idProforma);
ALTER TABLE BCDetail ADD CONSTRAINT FKBCDetail934782 FOREIGN KEY (BCidBc) REFERENCES BC (idBc);
ALTER TABLE BCDetail ADD CONSTRAINT FKBCDetail805987 FOREIGN KEY (ProformaDetailidProformaDetail) REFERENCES ProformaDetail (idProformaDetail);
ALTER TABLE ProformaDetail ADD CONSTRAINT FKProformaDe66380 FOREIGN KEY (ProduitidProduit) REFERENCES Produit (idProduit);
ALTER TABLE BC ADD CONSTRAINT FKBC703323 FOREIGN KEY (FournisseuridFournisseur) REFERENCES Fournisseur (idFournisseur);
ALTER TABLE BRDetail ADD CONSTRAINT FKBRDetail428154 FOREIGN KEY (BRidBr) REFERENCES BR (idBr);

ALTER TABLE Proforma ADD CONSTRAINT FKProforma265569 FOREIGN KEY (FournisseuridFournisseur) REFERENCES Fournisseur (idFournisseur);

ALTER TABLE Demande 
ADD COLUMN idDepartement INTEGER NOT NULL,
ADD FOREIGN KEY(idDepartement) REFERENCES dept(idDept);


CREATE TABLE Note (
  idNote INTEGER NOT NULL PRIMARY KEY,
  idProformaDetail INTEGER NOT NULL,
  qualiteNote DOUBLE PRECISION DEFAULT 0 CHECK(qualiteNote>=0),
  quantiteNote DOUBLE PRECISION DEFAULT 0 CHECK(quantiteNote>=0),
  prixNote DOUBLE PRECISION DEFAULT 0 CHECK(prixNote>=0)
);

CREATE TABLE qualite(
  idQualite SERIAL NOT NULL PRIMARY KEY,
  type varchar(50) NOT NULL
);

ALTER TABLE Demande
ADD COLUMN idQualite INTEGER NOT NULL,
ADD FOREIGN KEY(idQualite) REFERENCES qualite(idQualite);

ALTER TABLE ProformaDetail
DROP COLUMN qualite,
ADD COLUMN idQualite INTEGER,
ADD FOREIGN KEY(idQualite) REFERENCES qualite(idQualite);

ALTER TABLE Produit 
ADD COLUMN codeProduit VARCHAR(10) Unique NOT NULL;



-----------------------Mbola-------------------------------------------------------------------------------------------------------
insert into dept values
(default,'Securite');

insert into chef_dept values
(default,'Lova','Elisa','lova@gmail.com','lova',1);

insert into rubrique values
(default,'Tenue'),
(default,'Electro-menager');

insert into produit values
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
  foreign key(idProduit) REFERENCES produit(idProduit),
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
join produit p on pq.idProduit=p.idProduit 
join qualite q on q.idQualite=pq.idQualite;

create or replace view v_rubriqueProduit as 
select p.idproduit, p.designation,p.codeProduit, p.rubriqueidrubrique,r.genre 
from produit p join rubrique r on p.rubriqueidrubrique=r.idRubrique;

create or replace view v_produit as 
select vrp.*,vp.idqualite,vp.qualite 
from v_rubriqueProduit vrp join v_ProduitQualite vp on vp.idproduit=vrp.idproduit;

create or replace view v_demande as 
select d.iddemande,d.quantite,d.datedemande,d.produitidproduit,
vp.designation,p.codeProduit,p.rubriqueidrubrique,vp.genre,d.etat,d.iddepartement,dept.libelledept,d.idqualite,q.type 
from demande d join produit p on p.idProduit=d.produitidproduit 
join v_rubriqueProduit vp on vp.idProduit=d.produitidproduit 
join dept on dept.iddept=d.iddepartement 
join qualite q on d.idqualite=q.idqualite;

----------------------------------------------------------------------------------------------------------------------------
CREATE TABLE GroupeDemande(
  id SERIAL PRIMARY KEY,
  quantite int4 NOT NULL,
  DateGroupage date DEFAULT CURRENT_TIMESTAMP NOT NULL,
  ProduitidProduit int4 NOT NULL,
  idDemande varchar(100)
);

ALTER TABLE BCDetail
ADD COLUMN idGroupeDemande INTEGER NOT NULL,
ADD FOREIGN KEY(idGroupeDemande) REFERENCES GroupeDemande(id);

alter table ProformaDetail add column idGroupeDemande int;
alter table ProformaDetail add FOREIGN KEY (idGroupeDemande) REFERENCES GroupeDemande(id);
--------------------------------------------------------------------Mitasoa----------------------
ALTER TABLE BRDetail ADD COLUMN etat int DEFAULT 0;
ALTER TABLE Demande ADD COLUMN recu int DEFAULT 0;

CREATE OR REPLACE VIEW ProduitRubrique
AS 
SELECT * FROM Produit 
JOIN Rubrique 
ON Produit.rubriqueidRubrique = Rubrique.idRubrique; 

CREATE OR REPLACE VIEW PRDemande -- ProduitRubriqueDemande
AS
SELECT * FROM Demande 
JOIN ProduitRubrique
ON Demande.ProduitidProduit = ProduitRubrique.idProduit;

CREATE OR REPLACE VIEW PRDDepartement -- ProduitRubriqueDemandeDepartement
AS
SELECT * FROM PRDemande 
JOIN Dept
ON PRDemande.idDepartement = Dept.idDept;


CREATE OR REPLACE VIEW PRDemandeG -- ProduitRubriqueDemandeGrouper
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
-- Grossistes PPN
(DEFAULT,'SOCOMA','Lot IV W 54 ZX Anosizato Est'),
-- Ventes de lingerie
(DEFAULT,'VETYLING','IB Isoraka'),
--Ventes des vetements
(DEFAULT,'CORNALINE FACTORY','Lot IIY13X Ambaranjana '),
-- Vente des boissons et d'alcool gazeux
(DEFAULT,'Braseries SATR ','4G67+G33, Rue Docteur Joseph Raseta '),
-- Ventes des produites eclectroniques
(DEFAULT,'SYGMA Distribution','111 rue de Liège Tsaralalana'),
-- Ventes des prosuits laitiers
(DEFAULT,'SOCOLAIT','5H23+MQF,Rue Dr Razafimpanilo '),
-- Ventes de jus de fruit, des produits laitiers et des pates alimentaires
(DEFAULT,'Habibo Group','LOT III C 42 IFARIHY Tanjombato '),
-- Grossistes PPN
(DEFAULT,'SOREDIM SA','Rue Ravoninahitriniavo Ankorondrano'),
-- Vente des produits electroniques
(DEFAULT,'VISTA','Dans tout '),
-- Ventes de lingerie
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

---------------------------------Reynolds-----------------------------
-- view moinsDisant
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
-------------------------------------------Miora-------------------------
ALTER TABLE ProformaDetail 
ADD COLUMN Etat INTEGER DEFAULT 0;


ALTER TABLE BC 
ADD COLUMN etat INTEGER NOT NULL DEFAULT 0;

--Bon de commande
CREATE VIEW DetailCommande as select BC.*,Bcdetail.*,Produit.codeProduit,Produit.designation,rubrique.genre,Fournisseur.*,ProformaDetail.prixu from bc join bcdetail on bcdetail.bcidbc=bc.idbc join ProformaDetail on ProformaDetail.idProformaDetail=BCdetail.ProformaDetailidProformaDetail join Produit on Produit.idProduit=ProformaDetail.ProduitidProduit join Fournisseur on Fournisseur.idFournisseur=BC.fournisseuridfournisseur join rubrique on rubrique.idRubrique=Produit.rubriqueidRubrique join qualite on qualite.idqualite=ProformaDetail.idqualite;


--Proforma
CREATE or replace VIEW DetailProforma as select proforma.*,ProformaDetail.quantite,ProformaDetail.idqualite,ProformaDetail.delaiLivraison,ProformaDetail.lieuLivraison,ProformaDetail.prixU,ProformaDetail.ProduitidProduit,Produit.codeProduit,Produit.designation,rubrique.genre,ProformaDetail.idGroupeDemande,ProformaDetail.idProformaDetail,ProformaDetail.etat,Note.prixNote from proforma join proformadetail on proformadetail.ProformaidProforma=proforma.idproforma  left join Note on Note.idProformaDetail=ProformaDetail.idProformaDetail join Produit on Produit.idProduit=ProformaDetail.ProduitidProduit join rubrique on rubrique.idRubrique=Produit.rubriqueidRubrique join qualite on qualite.idqualite=ProformaDetail.idqualite;

--fonction getcommande 
create or replace function getCommande(dateregroup date)
returns table (
  proforma int,
	fournisseur int,
  quantite int,
  produit int, 
  prix double precision,
  total double precision,
  etat int
) 
language plpgsql
as
$$
  declare
    f record;
    g record;
    q double precision;
    actuel double precision;
    begin
    for g in (select * from GroupeDemande where DateGroupage=dateregroup)
    loop
      q:=0;
      actuel:=0;
     for f in (select * from DetailProforma where ProduitidProduit=g.produitidproduit and idGroupeDemande=g.id order by prixU ASC,prixNote DESC)
      loop
        q:=q+f.quantite;
        actuel:=f.quantite;
        if q>g.quantite then
          proforma:=f.idProformaDetail;
          fournisseur:=f.fournisseuridfournisseur;
          quantite:=-(q-g.quantite-actuel);
          produit:=f.produitidproduit;
          prix:=f.prixU;
          total:=quantite*prix;
          etat:=f.etat;
          return next;
          EXIT;
        end if;
        if q=g.quantite then
        proforma:=f.idProformaDetail;
        fournisseur:=f.fournisseuridfournisseur;
        quantite:=f.quantite;
        produit:=f.produitidproduit;
        prix:=f.prixU;
        total:=quantite*prix;
        etat:=f.etat;
        return next;
        EXIT;
        end if;
        proforma:=f.idProformaDetail;
        fournisseur:=f.fournisseuridfournisseur;
        quantite:=f.quantite;
        produit:=f.produitidproduit;
        prix:=f.prixU;
        total:=quantite*prix;
        etat:=f.etat;
        return next;
      end loop;
    end loop;
    end;
$$;
