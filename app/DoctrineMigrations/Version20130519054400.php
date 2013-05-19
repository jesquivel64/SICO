<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130519054400 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("CREATE TABLE documento_respuesta (documento_id INT NOT NULL, respuesta_id INT NOT NULL, INDEX IDX_A85B84B945C0CF75 (documento_id), INDEX IDX_A85B84B9D9BA57A2 (respuesta_id), PRIMARY KEY(documento_id, respuesta_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE documento_respuesta ADD CONSTRAINT FK_A85B84B945C0CF75 FOREIGN KEY (documento_id) REFERENCES Documento (id)");
        $this->addSql("ALTER TABLE documento_respuesta ADD CONSTRAINT FK_A85B84B9D9BA57A2 FOREIGN KEY (respuesta_id) REFERENCES Documento (id)");
        $this->addSql("ALTER TABLE comentario CHANGE timestamp timestamp DATETIME NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DROP TABLE documento_respuesta");
        $this->addSql("ALTER TABLE Comentario CHANGE timestamp timestamp DATETIME NOT NULL");
    }
}
