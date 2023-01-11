DROP DATABASE IF EXISTS rduart;

CREATE DATABASE rduart;

USE rduart;

/* Tabala permis */
CREATE TABLE permis (
    id_permis INTEGER PRIMARY KEY AUTO_INCREMENT,

    permis VARCHAR(255)

);

/* Tabla de alumnos */
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,

    nom VARCHAR(50),
    
    cognom  VARCHAR(100),

    email VARCHAR(255),

    usuario VARCHAR(255),

    password VARCHAR(255),

    permis INTEGER,
    FOREIGN KEY (permis) REFERENCES permis(id_permis)

);

/* Tabla de moduls */
CREATE TABLE moduls (
    id_modul INT PRIMARY KEY AUTO_INCREMENT,

    modul VARCHAR(255),

    uf VARCHAR(255),

    profesor INT,
    FOREIGN KEY (profesor) REFERENCES usuarios (id_usuario)
);

/* Tabla de ejercicios */
CREATE TABLE exercicis (
    id_exercici INT PRIMARY KEY AUTO_INCREMENT,

    modul_FK INTEGER,
    FOREIGN KEY (modul_FK) REFERENCES moduls (id_modul),

    exercici VARCHAR(255)
);

/* Tabla de  */

/* Tabla de consultas */
CREATE TABLE consultes (
    id_consulta INT PRIMARY KEY AUTO_INCREMENT,
    
    usuario_consulta_FK INT,
    FOREIGN KEY (usuario_consulta_FK) REFERENCES usuarios(id_usuario),

    exercici_FK INT,
    FOREIGN KEY (exercici_FK) REFERENCES exercicis(id_exercici),

    comentari LONGTEXT,

    hora VARCHAR(100),

    date DATE,

    resposta LONGTEXT,

    acabada BOOLEAN
);

INSERT INTO permis VALUES 
    (0, "Admin"),
    (1, "Profesor"),
    (2, "Alumne");

INSERT INTO usuarios VALUES
    (1, "Gerard", "Pala", "gpala@insdanielblanxart.cat", "gpala", "P@ssw0rd", 1),
    (2, "Manel", "Moles", "mmoles@insdanielblanxart.cat", "mmoles", "P@ssw0rd", 1),
    (3, "Javier", "Cecilia", "jceci@insdanielblanxart.cat", "jceci", "P@ssw0rd", 0),
    (4, "Rafael", "Luiz", "rduart@insdanielblanxart.cat", "rduart", "P@ssw0rd", 0),
    (5, "Alberto", "Wang", "awang@insdanielblanxart.cat", "awang", "P@ssw0rd", 2),
    (6, "Adria", "Vallejo", "avalle@insdanielblanxart.cat", "avalle", "P@ssw0rd", 2);
    

INSERT INTO moduls VALUES
    (1, "MP02: Bases de Dades", "UF1", 2),
    (2, "MP02: Bases de Dades", "UF2", 2),
    (3, "MP02: Bases de Dades", "UF3", 2),
    (4, "MP03: Programacio", "UF1", 1),
    (5, "MP03: Programacio", "UF2", 1),
    (6, "MP03: Programacio", "UF3", 1);

INSERT INTO exercicis VALUES
    (1, 1, "Act-1.Gestió tasques versió 0.2 (HTML)"),
    (2, 1, "Act-2. Gestió de tasques (PHP)"),
    (3, 1, "Act-3. Descripció i model Entitat-Relació de l'aplicació a desenvolupar"),
    (4, 1, "Act-4. Base de dades a partir de Model E-R"),

    (5, 2, "Act-1. Gestió de tasques ev1. CRUDs"),
    (6, 2, "Act-2. Aplicació custom. CRUDs"),
    (7, 2, "Act-3. Gestió de tasques ev1. Subformularis"),
    (8, 2, "Act-4. Aplicació custom. Subformularis"),
    (9, 2, "Act-5. Fitxer faker.php per a database"),
    (10, 2, "Act-6. Informes amb fpdf"),

    (11, 4, "Exercici 1. Funcions"),
    (12, 4, "Exercici 2. Optimització de funcions"),
    (13, 4, "Exercici 3. Optimització de funcions i control de errors"),
    (14, 4, "Exercici 4. Akinator Blanxart's version"),
    (15, 4, "Exercici 5. Objectes i bucles"),
    (16, 4, "Exercici 6. Modificació de codi"),
    (17, 4, "Exercici 7. Modificació de codi (II)"),
    (18, 4, "Exercici 8. Mètodes d'ordenació de taules"),
    (19, 4, "Exercici 9. Accés a arrays i llistes");

INSERT INTO consultes VALUES
    (1, 5, 19, "Lorem ipsum dolor sit amet, consectet", "18:32:34 pm", "2022-12-19", null, 0),
    (2, 6, 8, "Lorem ipsum dolor sit amet, consectet", "18:32:34 pm", "2022-12-19", "Lorem ipsum dolor sit amet, consectet", 1),
    (3, 6, 13, "Lorem ipsum dolor sit amet, consectet", "18:32:34 pm", "2022-12-19", null, 0);