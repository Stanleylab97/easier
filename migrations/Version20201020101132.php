<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201020101132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C561D1F6E7C3');
        $this->addSql('DROP INDEX IDX_F7B4C561D1F6E7C3 ON bordereau');
        $this->addSql('ALTER TABLE bordereau CHANGE agence_id_id agence_id INT NOT NULL');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C561D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('CREATE INDEX IDX_F7B4C561D725330D ON bordereau (agence_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641072F48FDC');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410C486B588');
        $this->addSql('DROP INDEX IDX_FE86641072F48FDC ON facture');
        $this->addSql('DROP INDEX IDX_FE866410C486B588 ON facture');
        $this->addSql('ALTER TABLE facture ADD periode_id INT NOT NULL, ADD compteur_id INT NOT NULL, DROP periode_id_id, DROP compteur_id_id');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('CREATE INDEX IDX_FE866410F384C1CF ON facture (periode_id)');
        $this->addSql('CREATE INDEX IDX_FE866410AA3B9810 ON facture (compteur_id)');
        $this->addSql('ALTER TABLE quittance DROP FOREIGN KEY FK_D57587DDED7016E0');
        $this->addSql('DROP INDEX UNIQ_D57587DDED7016E0 ON quittance');
        $this->addSql('ALTER TABLE quittance CHANGE facture_id_id facture_id INT NOT NULL');
        $this->addSql('ALTER TABLE quittance ADD CONSTRAINT FK_D57587DD7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D57587DD7F2DEE08 ON quittance (facture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C561D725330D');
        $this->addSql('DROP INDEX IDX_F7B4C561D725330D ON bordereau');
        $this->addSql('ALTER TABLE bordereau CHANGE agence_id agence_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C561D1F6E7C3 FOREIGN KEY (agence_id_id) REFERENCES agence (id)');
        $this->addSql('CREATE INDEX IDX_F7B4C561D1F6E7C3 ON bordereau (agence_id_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410F384C1CF');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410AA3B9810');
        $this->addSql('DROP INDEX IDX_FE866410F384C1CF ON facture');
        $this->addSql('DROP INDEX IDX_FE866410AA3B9810 ON facture');
        $this->addSql('ALTER TABLE facture ADD periode_id_id INT NOT NULL, ADD compteur_id_id INT NOT NULL, DROP periode_id, DROP compteur_id');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641072F48FDC FOREIGN KEY (compteur_id_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410C486B588 FOREIGN KEY (periode_id_id) REFERENCES periode (id)');
        $this->addSql('CREATE INDEX IDX_FE86641072F48FDC ON facture (compteur_id_id)');
        $this->addSql('CREATE INDEX IDX_FE866410C486B588 ON facture (periode_id_id)');
        $this->addSql('ALTER TABLE quittance DROP FOREIGN KEY FK_D57587DD7F2DEE08');
        $this->addSql('DROP INDEX UNIQ_D57587DD7F2DEE08 ON quittance');
        $this->addSql('ALTER TABLE quittance CHANGE facture_id facture_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE quittance ADD CONSTRAINT FK_D57587DDED7016E0 FOREIGN KEY (facture_id_id) REFERENCES facture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D57587DDED7016E0 ON quittance (facture_id_id)');
    }
}
