<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103205616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE odcinki_tras DROP FOREIGN KEY FK_CC95DE536CC9CEA7');
        $this->addSql('DROP INDEX IDX_CC95DE536CC9CEA7 ON odcinki_tras');
        $this->addSql('ALTER TABLE odcinki_tras DROP grupa_gorska_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Odcinki_tras ADD grupa_gorska_id INT NOT NULL');
        $this->addSql('ALTER TABLE Odcinki_tras ADD CONSTRAINT FK_CC95DE536CC9CEA7 FOREIGN KEY (grupa_gorska_id) REFERENCES grupy_gorskie (id)');
        $this->addSql('CREATE INDEX IDX_CC95DE536CC9CEA7 ON Odcinki_tras (grupa_gorska_id)');
    }
}
