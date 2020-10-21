<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201021093246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compteur ADD abonne_id INT NOT NULL');
        $this->addSql('ALTER TABLE compteur ADD CONSTRAINT FK_4D021BD5C325A696 FOREIGN KEY (abonne_id) REFERENCES abonne (id)');
        $this->addSql('CREATE INDEX IDX_4D021BD5C325A696 ON compteur (abonne_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compteur DROP FOREIGN KEY FK_4D021BD5C325A696');
        $this->addSql('DROP INDEX IDX_4D021BD5C325A696 ON compteur');
        $this->addSql('ALTER TABLE compteur DROP abonne_id');
    }
}
