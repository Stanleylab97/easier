<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201019155919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonne ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE abonne ADD CONSTRAINT FK_76328BF0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_76328BF0BCF5E72D ON abonne (categorie_id)');
        $this->addSql('ALTER TABLE bordereau ADD agence_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C561D1F6E7C3 FOREIGN KEY (agence_id_id) REFERENCES agence (id)');
        $this->addSql('CREATE INDEX IDX_F7B4C561D1F6E7C3 ON bordereau (agence_id_id)');
        $this->addSql('ALTER TABLE compteur ADD bordereau_id INT NOT NULL, ADD carre VARCHAR(255) NOT NULL, ADD tarif VARCHAR(4) NOT NULL');
        $this->addSql('ALTER TABLE compteur ADD CONSTRAINT FK_4D021BD555D5304E FOREIGN KEY (bordereau_id) REFERENCES bordereau (id)');
        $this->addSql('CREATE INDEX IDX_4D021BD555D5304E ON compteur (bordereau_id)');
        $this->addSql('ALTER TABLE facture ADD periode_id_id INT NOT NULL, ADD compteur_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410C486B588 FOREIGN KEY (periode_id_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641072F48FDC FOREIGN KEY (compteur_id_id) REFERENCES compteur (id)');
        $this->addSql('CREATE INDEX IDX_FE866410C486B588 ON facture (periode_id_id)');
        $this->addSql('CREATE INDEX IDX_FE86641072F48FDC ON facture (compteur_id_id)');
        $this->addSql('ALTER TABLE quittance ADD facture_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE quittance ADD CONSTRAINT FK_D57587DDED7016E0 FOREIGN KEY (facture_id_id) REFERENCES facture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D57587DDED7016E0 ON quittance (facture_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonne DROP FOREIGN KEY FK_76328BF0BCF5E72D');
        $this->addSql('DROP INDEX IDX_76328BF0BCF5E72D ON abonne');
        $this->addSql('ALTER TABLE abonne DROP categorie_id');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C561D1F6E7C3');
        $this->addSql('DROP INDEX IDX_F7B4C561D1F6E7C3 ON bordereau');
        $this->addSql('ALTER TABLE bordereau DROP agence_id_id');
        $this->addSql('ALTER TABLE compteur DROP FOREIGN KEY FK_4D021BD555D5304E');
        $this->addSql('DROP INDEX IDX_4D021BD555D5304E ON compteur');
        $this->addSql('ALTER TABLE compteur DROP bordereau_id, DROP carre, DROP tarif');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410C486B588');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641072F48FDC');
        $this->addSql('DROP INDEX IDX_FE866410C486B588 ON facture');
        $this->addSql('DROP INDEX IDX_FE86641072F48FDC ON facture');
        $this->addSql('ALTER TABLE facture DROP periode_id_id, DROP compteur_id_id');
        $this->addSql('ALTER TABLE quittance DROP FOREIGN KEY FK_D57587DDED7016E0');
        $this->addSql('DROP INDEX UNIQ_D57587DDED7016E0 ON quittance');
        $this->addSql('ALTER TABLE quittance DROP facture_id_id');
    }
}
