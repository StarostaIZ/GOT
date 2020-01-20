<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103224414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE trasa_odcinek_trasy');
        $this->addSql('ALTER TABLE odcinki_tras ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE trasa_odcinek_trasy (trasa_id INT NOT NULL, odcinek_trasy_id INT NOT NULL, INDEX IDX_38CF5D5F2F84E4DC (odcinek_trasy_id), INDEX IDX_38CF5D5F518F4BA5 (trasa_id), PRIMARY KEY(trasa_id, odcinek_trasy_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Odcinki_tras MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE Odcinki_tras DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE Odcinki_tras DROP id');
        $this->addSql('ALTER TABLE Odcinki_tras ADD PRIMARY KEY (punkt_poczatkowy_id, punkt_koncowy_id)');
    }
}
