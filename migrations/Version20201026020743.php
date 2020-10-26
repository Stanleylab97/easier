<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026020743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonne (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, num_abonne VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, INDEX IDX_76328BF0BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bordereau (id INT AUTO_INCREMENT NOT NULL, agence_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, quartier VARCHAR(255) NOT NULL, INDEX IDX_F7B4C561D725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compteur (id INT AUTO_INCREMENT NOT NULL, bordereau_id INT NOT NULL, abonne_id INT NOT NULL, num_police VARCHAR(255) NOT NULL, puissance VARCHAR(255) NOT NULL, carre VARCHAR(255) NOT NULL, INDEX IDX_4D021BD555D5304E (bordereau_id), INDEX IDX_4D021BD5C325A696 (abonne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, periode_id INT NOT NULL, compteur_id INT NOT NULL, num_fact VARCHAR(255) NOT NULL, last_index INT NOT NULL, new_index INT NOT NULL, nbkwh INT NOT NULL, montant_fact BIGINT NOT NULL, tarif VARCHAR(4) NOT NULL, INDEX IDX_FE866410F384C1CF (periode_id), INDEX IDX_FE866410AA3B9810 (compteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periode (id INT AUTO_INCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, period_fact VARCHAR(255) NOT NULL, date_echeance DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quittance (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, date_reglement DATETIME NOT NULL, moyen VARCHAR(255) NOT NULL, transaction_id BIGINT NOT NULL, num_quittance VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D57587DD7F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonne ADD CONSTRAINT FK_76328BF0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C561D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE compteur ADD CONSTRAINT FK_4D021BD555D5304E FOREIGN KEY (bordereau_id) REFERENCES bordereau (id)');
        $this->addSql('ALTER TABLE compteur ADD CONSTRAINT FK_4D021BD5C325A696 FOREIGN KEY (abonne_id) REFERENCES abonne (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE quittance ADD CONSTRAINT FK_D57587DD7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compteur DROP FOREIGN KEY FK_4D021BD5C325A696');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C561D725330D');
        $this->addSql('ALTER TABLE compteur DROP FOREIGN KEY FK_4D021BD555D5304E');
        $this->addSql('ALTER TABLE abonne DROP FOREIGN KEY FK_76328BF0BCF5E72D');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410AA3B9810');
        $this->addSql('ALTER TABLE quittance DROP FOREIGN KEY FK_D57587DD7F2DEE08');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410F384C1CF');
        $this->addSql('DROP TABLE abonne');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE bordereau');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE compteur');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE periode');
        $this->addSql('DROP TABLE quittance');
    }
}
