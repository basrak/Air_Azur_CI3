DROP DATABASE IF EXISTS AIR_AZUR;

CREATE DATABASE IF NOT EXISTS AIR_AZUR;
USE AIR_AZUR;
# -----------------------------------------------------------------------------
#       TABLE : AEROPORT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AEROPORT
 (
   IDARPT INTEGER(2) NOT NULL AUTO_INCREMENT ,
   NOMARPT VARCHAR(20) NULL  ,
   VILLEARPT VARCHAR(30) NULL  
   , PRIMARY KEY (IDARPT) 
 ) 
;

# -----------------------------------------------------------------------------
#       TABLE : VOLGEN
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VOLGEN
 (
   IDVOL INTEGER(5) NOT NULL AUTO_INCREMENT ,
   IDARPT INTEGER(2) NOT NULL  ,
   IDARPT_ARRIVEE INTEGER(2) NOT NULL  ,
   CODEVOL VARCHAR(10) NULL  ,
   PRIXVOL DECIMAL(13,2) NULL  ,
   PLACESVOL INTEGER(3) NULL  ,
   JOURVOL VARCHAR(10) NULL  
   , PRIMARY KEY (IDVOL) 
 ) 
;

# -----------------------------------------------------------------------------
#       TABLE : VOL
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VOL
 (
   IDVOL INTEGER(5) NOT NULL  ,
   DATEDEPART DATETIME NOT NULL  ,
   DATEARRIVEE DATETIME NULL  
   , PRIMARY KEY (IDVOL,DATEDEPART) 
 ) 
 ;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE VOL
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_VOL_VOLGEN
     ON VOL (IDVOL ASC);

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLIENT
 (
   IDCLIENT INTEGER(2) NOT NULL AUTO_INCREMENT ,
   NOMCLIENT VARCHAR(30) NULL  ,
   PRENOMCLIENT VARCHAR(30) NULL  ,
   ADRCLIENT VARCHAR(50) NULL  ,
   CPCLIENT INTEGER(5) NULL  ,
   VILLECLIENT VARCHAR(30) NULL  ,
   TELCLIENT CHAR(15) NULL  ,
   MAILCLIENT VARCHAR(30) NULL  
   , PRIMARY KEY (IDCLIENT) 
 ) 
 ;

# -----------------------------------------------------------------------------
#       TABLE : RESERVATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RESERVATION
 (
   IDUSERS INTEGER(3) NOT NULL  ,
   IDRESERV INTEGER(4) NOT NULL  ,
   IDCLIENT INTEGER(2) NOT NULL  ,
   IDVOL INTEGER(5) NOT NULL  ,
   DATEDEPART DATETIME NOT NULL  ,
   DATERESERV DATE NULL  ,
   NBRRESERV INTEGER(3) NULL  
   , PRIMARY KEY (IDUSERS,IDRESERV) 
 ) 
 ;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RESERVATION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RESERVATION_USERS
     ON RESERVATION (IDUSERS ASC);

CREATE  INDEX I_FK_RESERVATION_CLIENT
     ON RESERVATION (IDCLIENT ASC);

CREATE  INDEX I_FK_RESERVATION_VOL
     ON RESERVATION (IDVOL ASC,DATEDEPART ASC);


# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE VOLGEN
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_VOLGEN_AEROPORT
     ON VOLGEN (IDARPT ASC);

CREATE  INDEX I_FK_VOLGEN_AEROPORT1
     ON VOLGEN (IDARPT_ARRIVEE ASC);

# -----------------------------------------------------------------------------
#       TABLE : USERS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USERS
 (
   IDUSERS INTEGER(3) NOT NULL  AUTO_INCREMENT,
   LOGIN VARCHAR(15) NOT NULL  ,
   MDP VARCHAR(20) NOT NULL  ,
   uSTATUS VARCHAR(10) NOT NULL,
   NOMAGENCE VARCHAR(30) UNIQUE NULL  ,
   ADRAGENCE VARCHAR(50) NULL  ,
   CPAGENCE INTEGER(5) NULL  ,
   VILLEAGENCE VARCHAR(30) NULL  ,
   TELAGENCE VARCHAR(15) NULL  ,
   MAILAGENCE VARCHAR(30) NULL 
   , PRIMARY KEY (IDUSERS) 
 ) 
;


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE VOL 
  ADD FOREIGN KEY FK_VOL_VOLGEN (IDVOL)
      REFERENCES VOLGEN (IDVOL) on delete cascade on update cascade;


ALTER TABLE RESERVATION 
  ADD FOREIGN KEY FK_RESERVATION_USERS (IDUSERS)
      REFERENCES USERS (IDUSERS) ;


ALTER TABLE RESERVATION 
  ADD FOREIGN KEY FK_RESERVATION_CLIENT (IDCLIENT)
      REFERENCES CLIENT (IDCLIENT) ;


ALTER TABLE RESERVATION 
  ADD FOREIGN KEY FK_RESERVATION_VOL (IDVOL,DATEDEPART)
      REFERENCES VOL (IDVOL,DATEDEPART) ;


ALTER TABLE VOLGEN 
  ADD FOREIGN KEY FK_VOLGEN_AEROPORT (IDARPT)
      REFERENCES AEROPORT (IDARPT) ;


ALTER TABLE VOLGEN 
  ADD FOREIGN KEY FK_VOLGEN_AEROPORT1 (IDARPT_ARRIVEE)
      REFERENCES AEROPORT (IDARPT) ;

# -----------------------------------------------------------------------------
#       TRIGGERS
#-----------------------------------------------------------------------------




# -----------------------------------------------------------------------------
#       INSERTION DES VALEURS
# -----------------------------------------------------------------------------

INSERT INTO `users` (`LOGIN`, `MDP`, `uSTATUS`, `NOMAGENCE`, `ADRAGENCE`, `CPAGENCE`, `VILLEAGENCE`, `TELAGENCE`, `MAILAGENCE`) VALUES
('admin1', 'admin', 'admin', null, null, null, null, null, null),
('admin2', 'admin', 'admin', null, null, null, null, null, null),
('AZ_ADS', 'agence', 'agence', 'Agence du Soleil', '2 rue de la lune', 75011, 'Paris', '01-02-03-04-05', 'ads@az.com'),
('AZ_AA', 'agence', 'agence', 'Agence anonyme', '10 avenue du pastis', 13000, 'Marseille', '04-01-02-03-04', 'peuchere@yahoo.fr');

INSERT INTO `aeroport` (`NOMARPT`, `VILLEARPT`) VALUES
('Alger', 'Algérie'),
('Amsterdam', 'Pays-Bas'),
('Athènes', 'Grèce'),
('Berlin','Allemagne'),
('Bruxelles','Belgique'),
('LeCap','Afrique du Sud'),
('Dakar','Sénégal'),
('Dublin','Irlande'),
('Doha','Qatar'),
('La Havane','Cuba'),
('Lima','Perou'),
('Lisbonne','Portugal'),
('Madrid','Espagne'),
('Moscou','Russie'),
('Mexico','Mexique'),
('Oslo','Norvege'),
('Paris CDG','France'),
('Paris Orly','France'),
('Rabat','Maroc'),
('Séoul','Corée du Sud'),
('Tokyo','Japon');

INSERT INTO `client`(`NOMCLIENT`, `PRENOMCLIENT`, `ADRCLIENT`, `CPCLIENT`, `VILLECLIENT`, `TELCLIENT`, `MAILCLIENT`) VALUES 
("Durand", "Alain", "1 rue de l'avenir", "75008", "Paris", "0102030405", "alain.durand@gmail.com"),
("Dupond", "Jean", "3 rue de l'abreuvoir", "69000", "Lyon", "0102030505", "jean.dupond@hotmail.com"),
("Poireau", "Robert", "58 boulevard du pré", "33000", "Bordeaux", "0502030405", "rpoireau@gmail.com"),
("Neymar", "Jean", "5 avenue du petit pont", "78100", "Saint Germain en Laye", "0105304051", "neymar@yahoo.com");

INSERT INTO `volgen` (`IDARPT`, `IDARPT_ARRIVEE`, `CODEVOL`, `PRIXVOL`, `PLACESVOL`, `JOURVOL`) VALUES
(1, 2, 'AIR5001', '600.00', 120, 'lundi'),
(1, 2, 'AIR5002', '600.00', 120, 'Mardi');

INSERT INTO `vol` (`IDVOL`, `DATEDEPART`, `DATEARRIVEE`) VALUES
(1, '2018-03-21 17:00:00', '2018-03-21 19:00:00'),
(1, '2018-04-21 18:00:00', '2018-04-21 19:00:00'),
(2, '2018-03-21 18:00:00', '2018-03-21 19:00:00'),
(2, '2018-04-21 18:00:00', '2018-04-21 19:00:00');

INSERT INTO `reservation`(`IDUSERS`, `IDRESERV`, `IDCLIENT`, `IDVOL`, `DATEDEPART`, `DATERESERV`, `NBRRESERV`) VALUES 
(4, 1, 1, 1, '2018-03-21 17:00:00', '2018-01-01 14:00:00', 3),
(4, 2, 2, 2, '2018-03-21 18:00:00', '2018-01-02 15:00:00', 1);
