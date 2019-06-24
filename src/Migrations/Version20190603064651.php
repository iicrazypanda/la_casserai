<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603064651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kamer DROP FOREIGN KEY FK_4DD4F6A61D9D252B');
        $this->addSql('DROP INDEX IDX_4DD4F6A61D9D252B ON kamer');
        $this->addSql('ALTER TABLE kamer CHANGE soort_id_id soort_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE kamer ADD CONSTRAINT FK_4DD4F6A63DEE50DF FOREIGN KEY (soort_id) REFERENCES soort (id)');
        $this->addSql('CREATE INDEX IDX_4DD4F6A63DEE50DF ON kamer (soort_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kamer DROP FOREIGN KEY FK_4DD4F6A63DEE50DF');
        $this->addSql('DROP INDEX IDX_4DD4F6A63DEE50DF ON kamer');
        $this->addSql('ALTER TABLE kamer CHANGE soort_id soort_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE kamer ADD CONSTRAINT FK_4DD4F6A61D9D252B FOREIGN KEY (soort_id_id) REFERENCES soort (id)');
        $this->addSql('CREATE INDEX IDX_4DD4F6A61D9D252B ON kamer (soort_id_id)');
    }
}
