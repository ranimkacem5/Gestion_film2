<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241226215337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD movies_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD63453F590A4 FOREIGN KEY (movies_id) REFERENCES movie (id)');
        $this->addSql('CREATE INDEX IDX_497DD63453F590A4 ON categorie (movies_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD63453F590A4');
        $this->addSql('DROP INDEX IDX_497DD63453F590A4 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP movies_id');
    }
}
