<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529075510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE extra (id INT AUTO_INCREMENT NOT NULL, omschrijving VARCHAR(255) NOT NULL, meerprijs DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE functie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, kamer_id_id INT NOT NULL, image_file VARCHAR(255) NOT NULL, INDEX IDX_C53D045F2C391598 (kamer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kamer (id INT AUTO_INCREMENT NOT NULL, soort_id_id INT DEFAULT NULL, prijs DOUBLE PRECISION NOT NULL, INDEX IDX_4DD4F6A61D9D252B (soort_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kamer_extra (kamer_id INT NOT NULL, extra_id INT NOT NULL, INDEX IDX_1E4286AA78ECB459 (kamer_id), INDEX IDX_1E4286AA2B959FC6 (extra_id), PRIMARY KEY(kamer_id, extra_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisatie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_nr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservering (id INT AUTO_INCREMENT NOT NULL, kamers_id INT NOT NULL, users_id INT NOT NULL, checkin_date DATETIME NOT NULL, checkout_date DATETIME NOT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_F2E439ACF5BEB8C1 (kamers_id), INDEX IDX_F2E439AC67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soort (id INT AUTO_INCREMENT NOT NULL, omschrijving VARCHAR(255) NOT NULL, meerprijs DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, organisaties_id INT DEFAULT NULL, functions_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', last_activity VARCHAR(255) NOT NULL, tel_nr VARCHAR(255) NOT NULL, mobile_nr VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, insertion_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), INDEX IDX_957A647976A88266 (organisaties_id), INDEX IDX_957A64799011893B (functions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F2C391598 FOREIGN KEY (kamer_id_id) REFERENCES kamer (id)');
        $this->addSql('ALTER TABLE kamer ADD CONSTRAINT FK_4DD4F6A61D9D252B FOREIGN KEY (soort_id_id) REFERENCES soort (id)');
        $this->addSql('ALTER TABLE kamer_extra ADD CONSTRAINT FK_1E4286AA78ECB459 FOREIGN KEY (kamer_id) REFERENCES kamer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kamer_extra ADD CONSTRAINT FK_1E4286AA2B959FC6 FOREIGN KEY (extra_id) REFERENCES extra (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439ACF5BEB8C1 FOREIGN KEY (kamers_id) REFERENCES kamer (id)');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439AC67B3B43D FOREIGN KEY (users_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A647976A88266 FOREIGN KEY (organisaties_id) REFERENCES organisatie (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64799011893B FOREIGN KEY (functions_id) REFERENCES functie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kamer_extra DROP FOREIGN KEY FK_1E4286AA2B959FC6');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64799011893B');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F2C391598');
        $this->addSql('ALTER TABLE kamer_extra DROP FOREIGN KEY FK_1E4286AA78ECB459');
        $this->addSql('ALTER TABLE reservering DROP FOREIGN KEY FK_F2E439ACF5BEB8C1');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A647976A88266');
        $this->addSql('ALTER TABLE kamer DROP FOREIGN KEY FK_4DD4F6A61D9D252B');
        $this->addSql('ALTER TABLE reservering DROP FOREIGN KEY FK_F2E439AC67B3B43D');
        $this->addSql('DROP TABLE extra');
        $this->addSql('DROP TABLE functie');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE kamer');
        $this->addSql('DROP TABLE kamer_extra');
        $this->addSql('DROP TABLE organisatie');
        $this->addSql('DROP TABLE reservering');
        $this->addSql('DROP TABLE soort');
        $this->addSql('DROP TABLE fos_user');
    }
}
