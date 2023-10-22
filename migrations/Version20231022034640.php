<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022034640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration CHANGE date_declaration date_declaration DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport CHANGE date_fabrication date_fabrication DATE DEFAULT NULL, CHANGE date_expiration date_expiration DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration CHANGE date_declaration date_declaration DATETIME NOT NULL');
        $this->addSql('ALTER TABLE rapport CHANGE date_fabrication date_fabrication DATETIME NOT NULL, CHANGE date_expiration date_expiration DATETIME NOT NULL');
    }
}
