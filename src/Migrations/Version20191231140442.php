<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191231140442 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Administratorzy (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) NOT NULL, haslo VARCHAR(25) NOT NULL, email VARCHAR(25) NOT NULL, data_ur DATE NOT NULL, pesel VARCHAR(11) NOT NULL, nr_tel VARCHAR(11) NOT NULL, UNIQUE INDEX UNIQ_7FD6E57AAA08CB10 (login), UNIQUE INDEX UNIQ_7FD6E57AE7927C74 (email), UNIQUE INDEX UNIQ_7FD6E57A3931747B (pesel), UNIQUE INDEX UNIQ_7FD6E57A9C3611CF (nr_tel), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Grupy_gorskie (id INT AUTO_INCREMENT NOT NULL, nazwa_grupy VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Odcinki_tras (id INT AUTO_INCREMENT NOT NULL, punkt_poczatkowy_id INT NOT NULL, punkt_koncowy_id INT NOT NULL, przowodnik_zatwierdzajacy_id INT NOT NULL, grupa_gorska_id INT NOT NULL, nazwa_odc VARCHAR(50) NOT NULL, dlugosc DOUBLE PRECISION NOT NULL, pkt_za_przejsce INT NOT NULL, pkt_za_powrot INT NOT NULL, czy_zatwierdzone_przez_przodownika TINYINT(1) NOT NULL, INDEX IDX_CC95DE533C0B5E93 (punkt_poczatkowy_id), INDEX IDX_CC95DE538CF59731 (punkt_koncowy_id), INDEX IDX_CC95DE53691CD510 (przowodnik_zatwierdzajacy_id), INDEX IDX_CC95DE536CC9CEA7 (grupa_gorska_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Odznaki (id INT AUTO_INCREMENT NOT NULL, zdobywca_id INT NOT NULL, typ_odznaki_id INT NOT NULL, potrzebna_ilosc_pkt INT NOT NULL, aktualna_ilosc_pkt INT NOT NULL, czy_zdobyto TINYINT(1) NOT NULL, kiedy_zdobyto DATE DEFAULT NULL, INDEX IDX_2FA3257B15CDDF7A (zdobywca_id), INDEX IDX_2FA3257BE50B905E (typ_odznaki_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Przodownicy_turystyki_gorskiej_PTTK (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) NOT NULL, haslo VARCHAR(25) NOT NULL, email VARCHAR(25) NOT NULL, data_ur DATE NOT NULL, pesel VARCHAR(11) NOT NULL, nr_tel VARCHAR(11) NOT NULL, UNIQUE INDEX UNIQ_7C85F3E4AA08CB10 (login), UNIQUE INDEX UNIQ_7C85F3E4E7927C74 (email), UNIQUE INDEX UNIQ_7C85F3E43931747B (pesel), UNIQUE INDEX UNIQ_7C85F3E49C3611CF (nr_tel), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE przodownik_turystyki_gorskiej_pttk_grupa_gorska (przodownik_turystyki_gorskiej_pttk_id INT NOT NULL, grupa_gorska_id INT NOT NULL, INDEX IDX_FF165D3DA3F4D67 (przodownik_turystyki_gorskiej_pttk_id), INDEX IDX_FF165D36CC9CEA7 (grupa_gorska_id), PRIMARY KEY(przodownik_turystyki_gorskiej_pttk_id, grupa_gorska_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Punkty (id INT AUTO_INCREMENT NOT NULL, grupa_gorska_id INT NOT NULL, nazwa_pkt VARCHAR(50) NOT NULL, szerokosc_geogr DOUBLE PRECISION NOT NULL, dlugosc_geogr DOUBLE PRECISION NOT NULL, wysokosc DOUBLE PRECISION NOT NULL, czy_zdef_przez_uzytk TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX UNIQ_718F1770827A72B1 (nazwa_pkt), INDEX IDX_718F17706CC9CEA7 (grupa_gorska_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Trasy (id INT AUTO_INCREMENT NOT NULL, grupa_gorska_id INT DEFAULT NULL, odznaka_id INT NOT NULL, data_utworzenia DATE NOT NULL, suma_pkt INT NOT NULL, dlugosc DOUBLE PRECISION NOT NULL, roznica_wysokosci DOUBLE PRECISION NOT NULL, data_pokonania DATE DEFAULT NULL, INDEX IDX_AE59B4BB6CC9CEA7 (grupa_gorska_id), INDEX IDX_AE59B4BB13204B24 (odznaka_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trasa_odcinek_trasy (trasa_id INT NOT NULL, odcinek_trasy_id INT NOT NULL, INDEX IDX_38CF5D5F518F4BA5 (trasa_id), INDEX IDX_38CF5D5F2F84E4DC (odcinek_trasy_id), PRIMARY KEY(trasa_id, odcinek_trasy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Turysci (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) NOT NULL, haslo VARCHAR(25) NOT NULL, email VARCHAR(25) NOT NULL, data_ur DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Typy_odznak (id INT AUTO_INCREMENT NOT NULL, nazwa_typu VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Odcinki_tras ADD CONSTRAINT FK_CC95DE533C0B5E93 FOREIGN KEY (punkt_poczatkowy_id) REFERENCES Punkty (id)');
        $this->addSql('ALTER TABLE Odcinki_tras ADD CONSTRAINT FK_CC95DE538CF59731 FOREIGN KEY (punkt_koncowy_id) REFERENCES Punkty (id)');
        $this->addSql('ALTER TABLE Odcinki_tras ADD CONSTRAINT FK_CC95DE53691CD510 FOREIGN KEY (przowodnik_zatwierdzajacy_id) REFERENCES Przodownicy_turystyki_gorskiej_PTTK (id)');
        $this->addSql('ALTER TABLE Odcinki_tras ADD CONSTRAINT FK_CC95DE536CC9CEA7 FOREIGN KEY (grupa_gorska_id) REFERENCES Grupy_gorskie (id)');
        $this->addSql('ALTER TABLE Odznaki ADD CONSTRAINT FK_2FA3257B15CDDF7A FOREIGN KEY (zdobywca_id) REFERENCES Turysci (id)');
        $this->addSql('ALTER TABLE Odznaki ADD CONSTRAINT FK_2FA3257BE50B905E FOREIGN KEY (typ_odznaki_id) REFERENCES Typy_odznak (id)');
        $this->addSql('ALTER TABLE przodownik_turystyki_gorskiej_pttk_grupa_gorska ADD CONSTRAINT FK_FF165D3DA3F4D67 FOREIGN KEY (przodownik_turystyki_gorskiej_pttk_id) REFERENCES Przodownicy_turystyki_gorskiej_PTTK (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE przodownik_turystyki_gorskiej_pttk_grupa_gorska ADD CONSTRAINT FK_FF165D36CC9CEA7 FOREIGN KEY (grupa_gorska_id) REFERENCES Grupy_gorskie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Punkty ADD CONSTRAINT FK_718F17706CC9CEA7 FOREIGN KEY (grupa_gorska_id) REFERENCES Grupy_gorskie (id)');
        $this->addSql('ALTER TABLE Trasy ADD CONSTRAINT FK_AE59B4BB6CC9CEA7 FOREIGN KEY (grupa_gorska_id) REFERENCES Grupy_gorskie (id)');
        $this->addSql('ALTER TABLE Trasy ADD CONSTRAINT FK_AE59B4BB13204B24 FOREIGN KEY (odznaka_id) REFERENCES Odznaki (id)');
        $this->addSql('ALTER TABLE trasa_odcinek_trasy ADD CONSTRAINT FK_38CF5D5F518F4BA5 FOREIGN KEY (trasa_id) REFERENCES Trasy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trasa_odcinek_trasy ADD CONSTRAINT FK_38CF5D5F2F84E4DC FOREIGN KEY (odcinek_trasy_id) REFERENCES Odcinki_tras (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Odcinki_tras DROP FOREIGN KEY FK_CC95DE536CC9CEA7');
        $this->addSql('ALTER TABLE przodownik_turystyki_gorskiej_pttk_grupa_gorska DROP FOREIGN KEY FK_FF165D36CC9CEA7');
        $this->addSql('ALTER TABLE Punkty DROP FOREIGN KEY FK_718F17706CC9CEA7');
        $this->addSql('ALTER TABLE Trasy DROP FOREIGN KEY FK_AE59B4BB6CC9CEA7');
        $this->addSql('ALTER TABLE trasa_odcinek_trasy DROP FOREIGN KEY FK_38CF5D5F2F84E4DC');
        $this->addSql('ALTER TABLE Trasy DROP FOREIGN KEY FK_AE59B4BB13204B24');
        $this->addSql('ALTER TABLE Odcinki_tras DROP FOREIGN KEY FK_CC95DE53691CD510');
        $this->addSql('ALTER TABLE przodownik_turystyki_gorskiej_pttk_grupa_gorska DROP FOREIGN KEY FK_FF165D3DA3F4D67');
        $this->addSql('ALTER TABLE Odcinki_tras DROP FOREIGN KEY FK_CC95DE533C0B5E93');
        $this->addSql('ALTER TABLE Odcinki_tras DROP FOREIGN KEY FK_CC95DE538CF59731');
        $this->addSql('ALTER TABLE trasa_odcinek_trasy DROP FOREIGN KEY FK_38CF5D5F518F4BA5');
        $this->addSql('ALTER TABLE Odznaki DROP FOREIGN KEY FK_2FA3257B15CDDF7A');
        $this->addSql('ALTER TABLE Odznaki DROP FOREIGN KEY FK_2FA3257BE50B905E');
        $this->addSql('DROP TABLE Administratorzy');
        $this->addSql('DROP TABLE Grupy_gorskie');
        $this->addSql('DROP TABLE Odcinki_tras');
        $this->addSql('DROP TABLE Odznaki');
        $this->addSql('DROP TABLE Przodownicy_turystyki_gorskiej_PTTK');
        $this->addSql('DROP TABLE przodownik_turystyki_gorskiej_pttk_grupa_gorska');
        $this->addSql('DROP TABLE Punkty');
        $this->addSql('DROP TABLE Trasy');
        $this->addSql('DROP TABLE trasa_odcinek_trasy');
        $this->addSql('DROP TABLE Turysci');
        $this->addSql('DROP TABLE Typy_odznak');
    }
}
