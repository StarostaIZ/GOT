<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103224516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE trasa_odcinek_trasy (trasa_id INT NOT NULL, odcinek_trasy_id INT NOT NULL, INDEX IDX_38CF5D5F518F4BA5 (trasa_id), INDEX IDX_38CF5D5F2F84E4DC (odcinek_trasy_id), PRIMARY KEY(trasa_id, odcinek_trasy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trasa_odcinek_trasy ADD CONSTRAINT FK_38CF5D5F518F4BA5 FOREIGN KEY (trasa_id) REFERENCES Trasy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trasa_odcinek_trasy ADD CONSTRAINT FK_38CF5D5F2F84E4DC FOREIGN KEY (odcinek_trasy_id) REFERENCES Odcinki_tras (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE trasa_odcinek_trasy');
    }
}
