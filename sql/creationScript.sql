CREATE TABLE ROLES
(
    POSTGRES_NAME varchar(32) NOT NULL  ,
    FRIENDLY_NAME varchar(32) NULL,
    CONSTRAINT PK_ROLES PRIMARY KEY (POSTGRES_NAME)
) ;

-- -----------------------------------------------------------------------------
--       TABLE : ARTICLES
-- -----------------------------------------------------------------------------

CREATE TABLE ARTICLES
(
    ID_ARTICLE serial NOT NULL  ,
    TITLE char(100) NULL  ,
    INTRODUCTION varchar(256) NULL  ,
    CONTENT text NULL  ,
    NB_LIKE int4 NULL  ,
    CONSTRAINT PK_ARTICLES PRIMARY KEY (ID_ARTICLE)
) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMENTARY
-- -----------------------------------------------------------------------------

CREATE TABLE COMMENTARY
(
    ID_ARTICLE int4 NOT NULL  ,
    ID_COMMENT serial NOT NULL  ,
    CONTENT text NULL  ,
    CONSTRAINT PK_COMMENTARY PRIMARY KEY (ID_ARTICLE, ID_COMMENT)
) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE COMMENTARY
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_COMMENTARY_ARTICLES
    ON COMMENTARY (ID_ARTICLE)
;

-- -----------------------------------------------------------------------------
--       TABLE : USERS
-- -----------------------------------------------------------------------------

CREATE TABLE USERS
(
    LOGIN varchar(20) NOT NULL  ,
    POSTGRES_NAME varchar(32) NOT NULL  ,
    PASSWORD char(32) NULL  ,
    NAME varchar(50) NULL  ,
    SURNAME varchar(50) NULL  ,
    CONSTRAINT PK_USERS PRIMARY KEY (LOGIN)
) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE USERS
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_USERS_ROLES
    ON USERS (POSTGRES_NAME)
;

-- -----------------------------------------------------------------------------
--       TABLE : WRITE
-- -----------------------------------------------------------------------------

CREATE TABLE WRITE
(
    LOGIN varchar(20) NOT NULL  ,
    ID_ARTICLE int4 NOT NULL
    ,   CONSTRAINT PK_WRITE PRIMARY KEY (LOGIN, ID_ARTICLE)
) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE WRITE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_WRITE_USERS
    ON WRITE (LOGIN)
;

CREATE  INDEX I_FK_WRITE_ARTICLES
    ON WRITE (ID_ARTICLE)
;

-- -----------------------------------------------------------------------------
--       TABLE : DISCUSS
-- -----------------------------------------------------------------------------

CREATE TABLE DISCUSS
(
    LOGIN varchar(20) NOT NULL  ,
    ID_ARTICLE int4 NOT NULL  ,
    ID_COMMENT int4 NOT NULL
    ,   CONSTRAINT PK_DISCUSS PRIMARY KEY (LOGIN, ID_ARTICLE, ID_COMMENT)
) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE DISCUSS
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_DISCUSS_USERS
    ON DISCUSS (LOGIN)
;

CREATE  INDEX I_FK_DISCUSS_COMMENTARY
    ON DISCUSS (ID_ARTICLE, ID_COMMENT)
;


-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE COMMENTARY ADD
    CONSTRAINT FK_COMMENTARY_ARTICLES
        FOREIGN KEY (ID_ARTICLE)
            REFERENCES ARTICLES (ID_ARTICLE) ON DELETE CASCADE;

ALTER TABLE USERS ADD
    CONSTRAINT FK_USERS_ROLES
        FOREIGN KEY (POSTGRES_NAME)
            REFERENCES ROLES (POSTGRES_NAME);

ALTER TABLE WRITE ADD
    CONSTRAINT FK_WRITE_USERS
        FOREIGN KEY (LOGIN)
            REFERENCES USERS (LOGIN);

ALTER TABLE WRITE ADD
    CONSTRAINT FK_WRITE_ARTICLES
        FOREIGN KEY (ID_ARTICLE)
            REFERENCES ARTICLES (ID_ARTICLE) ON DELETE CASCADE;

ALTER TABLE DISCUSS ADD
    CONSTRAINT FK_DISCUSS_USERS
        FOREIGN KEY (LOGIN)
            REFERENCES USERS (LOGIN);

ALTER TABLE DISCUSS ADD
    CONSTRAINT FK_DISCUSS_COMMENTARY
        FOREIGN KEY (ID_ARTICLE, ID_COMMENT)
            REFERENCES COMMENTARY (ID_ARTICLE, ID_COMMENT) ON DELETE CASCADE;

--Important :
--Les mot de passe des role doivent être le nom du role en majuscule
CREATE ROLE WEBUSER WITH PASSWORD 'WEBUSER';
GRANT SELECT ON ALL TABLES IN SCHEMA public TO WEBUSER;
ALTER ROLE "webuser" WITH LOGIN;

CREATE ROLE AUTHUSER WITH PASSWORD 'AUTHUSER';
GRANT SELECT ON ALL TABLES IN SCHEMA public TO AUTHUSER;
GRANT INSERT ON TABLE COMMENTARY TO AUTHUSER;
GRANT INSERT ON TABLE DISCUSS TO AUTHUSER;
ALTER ROLE "authuser" WITH LOGIN;

CREATE ROLE EDITOR WITH PASSWORD 'EDITOR';
GRANT SELECT ON ALL TABLES IN SCHEMA public TO EDITOR;
GRANT INSERT, UPDATE, DELETE ON TABLE ARTICLES TO EDITOR;
GRANT INSERT, UPDATE, DELETE ON TABLE WRITE TO EDITOR;
ALTER ROLE "editor" WITH LOGIN;

CREATE ROLE MODERATOR WITH PASSWORD 'MODERATOR';
GRANT SELECT ON ALL TABLES IN SCHEMA public TO MODERATOR;
GRANT INSERT,DELETE ON TABLE COMMENTARY TO MODERATOR;
GRANT INSERT,DELETE ON TABLE DISCUSS TO MODERATOR;
ALTER ROLE "moderator" WITH LOGIN;

GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO AUTHUSER;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO EDITOR;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO MODERATOR;

--Important :
--Les id des role doivent être identique au role dans postgres
INSERT INTO ROLES VALUES('authuser','Utilisateur');
INSERT INTO ROLES VALUES('editor','Rédacteur');
INSERT INTO ROLES VALUES('moderator','Moderateur');

--Important :
--Le mot de passe pour chaque utilisateur et :"password"
INSERT INTO USERS VALUES('lvolat','authuser','5f4dcc3b5aa765d61d8327deb882cf99','Louis','Volat');
INSERT INTO USERS VALUES('mumix','moderator','5f4dcc3b5aa765d61d8327deb882cf99','Toto','Vainsurvin');
INSERT INTO USERS VALUES('sgibert','editor','5f4dcc3b5aa765d61d8327deb882cf99','Samuel','Gibert');