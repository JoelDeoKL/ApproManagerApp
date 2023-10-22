<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021215018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE proces_verbal (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, operateur_id INT DEFAULT NULL, motif VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_5B95250B60BB6FE6 (auteur_id), INDEX IDX_5B95250B3F192FC (operateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proces_verbal ADD CONSTRAINT FK_5B95250B60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE proces_verbal ADD CONSTRAINT FK_5B95250B3F192FC FOREIGN KEY (operateur_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proces_verbal DROP FOREIGN KEY FK_5B95250B60BB6FE6');
        $this->addSql('ALTER TABLE proces_verbal DROP FOREIGN KEY FK_5B95250B3F192FC');
        $this->addSql('DROP TABLE proces_verbal');
    }
}
