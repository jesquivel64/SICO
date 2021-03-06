<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130619131221 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("CREATE TABLE Accion (id INT AUTO_INCREMENT NOT NULL, tipo_accion_id INT DEFAULT NULL, documento_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, fecha DATETIME NOT NULL, completada TINYINT(1) DEFAULT NULL, INDEX IDX_8DAEE682DD25ED3B (tipo_accion_id), INDEX IDX_8DAEE68245C0CF75 (documento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Adjunto (id INT AUTO_INCREMENT NOT NULL, documento_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, path VARCHAR(255) DEFAULT NULL, INDEX IDX_B701F5AC45C0CF75 (documento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Carrera (id INT AUTO_INCREMENT NOT NULL, facultad_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, INDEX IDX_A3F4AC392EEB81 (facultad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE carrera_centro (carrera_id INT NOT NULL, centro_id INT NOT NULL, INDEX IDX_2BAD9B63C671B40F (carrera_id), INDEX IDX_2BAD9B63298137A7 (centro_id), PRIMARY KEY(carrera_id, centro_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Centro (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Comentario (id INT AUTO_INCREMENT NOT NULL, documento_id INT DEFAULT NULL, comentario VARCHAR(255) NOT NULL, timestamp DATETIME NOT NULL, usuario VARCHAR(255) DEFAULT NULL, finalizado DATETIME DEFAULT NULL, tiempo INT DEFAULT NULL, curso TINYINT(1) DEFAULT NULL, editable TINYINT(1) DEFAULT NULL, INDEX IDX_4CCE4D245C0CF75 (documento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Coordinacion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Departamento (id INT AUTO_INCREMENT NOT NULL, tipo_departamento_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) DEFAULT NULL, INDEX IDX_58D54C138CCBB0AA (tipo_departamento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE departamento_documento (departamento_id INT NOT NULL, documento_id INT NOT NULL, INDEX IDX_D94A08495A91C08D (departamento_id), INDEX IDX_D94A084945C0CF75 (documento_id), PRIMARY KEY(departamento_id, documento_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Documento (id INT AUTO_INCREMENT NOT NULL, tipo_id INT DEFAULT NULL, coordinacion_id INT DEFAULT NULL, centro_id INT DEFAULT NULL, instancia_id INT DEFAULT NULL, facultad_id INT DEFAULT NULL, carrera_id INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, autor VARCHAR(255) DEFAULT NULL, entregado VARCHAR(255) DEFAULT NULL, destinatario LONGTEXT DEFAULT NULL, recibio VARCHAR(255) DEFAULT NULL, fecha_de_emision DATETIME DEFAULT NULL, fecha_de_envio DATETIME DEFAULT NULL, fecha_de_recibido DATETIME DEFAULT NULL, fecha_de_respuesta DATETIME DEFAULT NULL, tiempo INT NOT NULL, respondido TINYINT(1) DEFAULT NULL, recibido TINYINT(1) NOT NULL, responder TINYINT(1) DEFAULT NULL, clasificar TINYINT(1) DEFAULT NULL, copia TINYINT(1) DEFAULT NULL, tipoSolicitud_id INT DEFAULT NULL, INDEX IDX_3440AC64A9276E6C (tipo_id), INDEX IDX_3440AC64360A43D5 (coordinacion_id), INDEX IDX_3440AC646F11911A (tipoSolicitud_id), INDEX IDX_3440AC64298137A7 (centro_id), INDEX IDX_3440AC64BBADF29B (instancia_id), INDEX IDX_3440AC64392EEB81 (facultad_id), INDEX IDX_3440AC64C671B40F (carrera_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE enviado_departamento (documento_id INT NOT NULL, departamento_id INT NOT NULL, INDEX IDX_B10478B245C0CF75 (documento_id), INDEX IDX_B10478B25A91C08D (departamento_id), PRIMARY KEY(documento_id, departamento_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE documento_respuesta (documento_id INT NOT NULL, respuesta_id INT NOT NULL, INDEX IDX_A85B84B945C0CF75 (documento_id), INDEX IDX_A85B84B9D9BA57A2 (respuesta_id), PRIMARY KEY(documento_id, respuesta_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Facultad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE facultad_centro (facultad_id INT NOT NULL, centro_id INT NOT NULL, INDEX IDX_51EA9DF0392EEB81 (facultad_id), INDEX IDX_51EA9DF0298137A7 (centro_id), PRIMARY KEY(facultad_id, centro_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Instancia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE TipoAccion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE TipoDepartamento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE TipoDocumento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, plural VARCHAR(255) NOT NULL, imagen VARCHAR(255) NOT NULL, color VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE TipoSolicitud (id INT AUTO_INCREMENT NOT NULL, coordinacion_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, INDEX IDX_5F58AA3F360A43D5 (coordinacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Accion ADD CONSTRAINT FK_8DAEE682DD25ED3B FOREIGN KEY (tipo_accion_id) REFERENCES TipoAccion (id)");
        $this->addSql("ALTER TABLE Accion ADD CONSTRAINT FK_8DAEE68245C0CF75 FOREIGN KEY (documento_id) REFERENCES Documento (id)");
        $this->addSql("ALTER TABLE Adjunto ADD CONSTRAINT FK_B701F5AC45C0CF75 FOREIGN KEY (documento_id) REFERENCES Documento (id)");
        $this->addSql("ALTER TABLE Carrera ADD CONSTRAINT FK_A3F4AC392EEB81 FOREIGN KEY (facultad_id) REFERENCES Facultad (id)");
        $this->addSql("ALTER TABLE carrera_centro ADD CONSTRAINT FK_2BAD9B63C671B40F FOREIGN KEY (carrera_id) REFERENCES Carrera (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE carrera_centro ADD CONSTRAINT FK_2BAD9B63298137A7 FOREIGN KEY (centro_id) REFERENCES Centro (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE Comentario ADD CONSTRAINT FK_4CCE4D245C0CF75 FOREIGN KEY (documento_id) REFERENCES Documento (id)");
        $this->addSql("ALTER TABLE Departamento ADD CONSTRAINT FK_58D54C138CCBB0AA FOREIGN KEY (tipo_departamento_id) REFERENCES TipoDepartamento (id)");
        $this->addSql("ALTER TABLE departamento_documento ADD CONSTRAINT FK_D94A08495A91C08D FOREIGN KEY (departamento_id) REFERENCES Departamento (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE departamento_documento ADD CONSTRAINT FK_D94A084945C0CF75 FOREIGN KEY (documento_id) REFERENCES Documento (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE Documento ADD CONSTRAINT FK_3440AC64A9276E6C FOREIGN KEY (tipo_id) REFERENCES TipoDocumento (id)");
        $this->addSql("ALTER TABLE Documento ADD CONSTRAINT FK_3440AC64360A43D5 FOREIGN KEY (coordinacion_id) REFERENCES Coordinacion (id)");
        $this->addSql("ALTER TABLE Documento ADD CONSTRAINT FK_3440AC646F11911A FOREIGN KEY (tipoSolicitud_id) REFERENCES TipoSolicitud (id)");
        $this->addSql("ALTER TABLE Documento ADD CONSTRAINT FK_3440AC64298137A7 FOREIGN KEY (centro_id) REFERENCES Centro (id)");
        $this->addSql("ALTER TABLE Documento ADD CONSTRAINT FK_3440AC64BBADF29B FOREIGN KEY (instancia_id) REFERENCES Instancia (id)");
        $this->addSql("ALTER TABLE Documento ADD CONSTRAINT FK_3440AC64392EEB81 FOREIGN KEY (facultad_id) REFERENCES Facultad (id)");
        $this->addSql("ALTER TABLE Documento ADD CONSTRAINT FK_3440AC64C671B40F FOREIGN KEY (carrera_id) REFERENCES Carrera (id)");
        $this->addSql("ALTER TABLE enviado_departamento ADD CONSTRAINT FK_B10478B245C0CF75 FOREIGN KEY (documento_id) REFERENCES Documento (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE enviado_departamento ADD CONSTRAINT FK_B10478B25A91C08D FOREIGN KEY (departamento_id) REFERENCES Departamento (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE documento_respuesta ADD CONSTRAINT FK_A85B84B945C0CF75 FOREIGN KEY (documento_id) REFERENCES Documento (id)");
        $this->addSql("ALTER TABLE documento_respuesta ADD CONSTRAINT FK_A85B84B9D9BA57A2 FOREIGN KEY (respuesta_id) REFERENCES Documento (id)");
        $this->addSql("ALTER TABLE facultad_centro ADD CONSTRAINT FK_51EA9DF0392EEB81 FOREIGN KEY (facultad_id) REFERENCES Facultad (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE facultad_centro ADD CONSTRAINT FK_51EA9DF0298137A7 FOREIGN KEY (centro_id) REFERENCES Centro (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE TipoSolicitud ADD CONSTRAINT FK_5F58AA3F360A43D5 FOREIGN KEY (coordinacion_id) REFERENCES Coordinacion (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE carrera_centro DROP FOREIGN KEY FK_2BAD9B63C671B40F");
        $this->addSql("ALTER TABLE Documento DROP FOREIGN KEY FK_3440AC64C671B40F");
        $this->addSql("ALTER TABLE carrera_centro DROP FOREIGN KEY FK_2BAD9B63298137A7");
        $this->addSql("ALTER TABLE Documento DROP FOREIGN KEY FK_3440AC64298137A7");
        $this->addSql("ALTER TABLE facultad_centro DROP FOREIGN KEY FK_51EA9DF0298137A7");
        $this->addSql("ALTER TABLE Documento DROP FOREIGN KEY FK_3440AC64360A43D5");
        $this->addSql("ALTER TABLE TipoSolicitud DROP FOREIGN KEY FK_5F58AA3F360A43D5");
        $this->addSql("ALTER TABLE departamento_documento DROP FOREIGN KEY FK_D94A08495A91C08D");
        $this->addSql("ALTER TABLE enviado_departamento DROP FOREIGN KEY FK_B10478B25A91C08D");
        $this->addSql("ALTER TABLE Accion DROP FOREIGN KEY FK_8DAEE68245C0CF75");
        $this->addSql("ALTER TABLE Adjunto DROP FOREIGN KEY FK_B701F5AC45C0CF75");
        $this->addSql("ALTER TABLE Comentario DROP FOREIGN KEY FK_4CCE4D245C0CF75");
        $this->addSql("ALTER TABLE departamento_documento DROP FOREIGN KEY FK_D94A084945C0CF75");
        $this->addSql("ALTER TABLE enviado_departamento DROP FOREIGN KEY FK_B10478B245C0CF75");
        $this->addSql("ALTER TABLE documento_respuesta DROP FOREIGN KEY FK_A85B84B945C0CF75");
        $this->addSql("ALTER TABLE documento_respuesta DROP FOREIGN KEY FK_A85B84B9D9BA57A2");
        $this->addSql("ALTER TABLE Carrera DROP FOREIGN KEY FK_A3F4AC392EEB81");
        $this->addSql("ALTER TABLE Documento DROP FOREIGN KEY FK_3440AC64392EEB81");
        $this->addSql("ALTER TABLE facultad_centro DROP FOREIGN KEY FK_51EA9DF0392EEB81");
        $this->addSql("ALTER TABLE Documento DROP FOREIGN KEY FK_3440AC64BBADF29B");
        $this->addSql("ALTER TABLE Accion DROP FOREIGN KEY FK_8DAEE682DD25ED3B");
        $this->addSql("ALTER TABLE Departamento DROP FOREIGN KEY FK_58D54C138CCBB0AA");
        $this->addSql("ALTER TABLE Documento DROP FOREIGN KEY FK_3440AC64A9276E6C");
        $this->addSql("ALTER TABLE Documento DROP FOREIGN KEY FK_3440AC646F11911A");
        $this->addSql("DROP TABLE Accion");
        $this->addSql("DROP TABLE Adjunto");
        $this->addSql("DROP TABLE Carrera");
        $this->addSql("DROP TABLE carrera_centro");
        $this->addSql("DROP TABLE Centro");
        $this->addSql("DROP TABLE Comentario");
        $this->addSql("DROP TABLE Coordinacion");
        $this->addSql("DROP TABLE Departamento");
        $this->addSql("DROP TABLE departamento_documento");
        $this->addSql("DROP TABLE Documento");
        $this->addSql("DROP TABLE enviado_departamento");
        $this->addSql("DROP TABLE documento_respuesta");
        $this->addSql("DROP TABLE Facultad");
        $this->addSql("DROP TABLE facultad_centro");
        $this->addSql("DROP TABLE Instancia");
        $this->addSql("DROP TABLE TipoAccion");
        $this->addSql("DROP TABLE TipoDepartamento");
        $this->addSql("DROP TABLE TipoDocumento");
        $this->addSql("DROP TABLE TipoSolicitud");
        $this->addSql("DROP TABLE fos_user");
    }
}
