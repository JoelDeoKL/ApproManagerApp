<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021083549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE declaration (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, user_id INT DEFAULT NULL, qte_achete VARCHAR(255) NOT NULL, qte_vendue VARCHAR(255) NOT NULL, date_declaration DATETIME NOT NULL, nature VARCHAR(255) NOT NULL, INDEX IDX_7AA3DAC2F347EFB (produit_id), INDEX IDX_7AA3DAC2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom_produit VARCHAR(255) NOT NULL, date_arrive DATE DEFAULT NULL, provenance VARCHAR(255) NOT NULL, quantite VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, auteur_id INT DEFAULT NULL, user_id INT DEFAULT NULL, quantite VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, date_fabrication DATETIME NOT NULL, date_expiration DATETIME NOT NULL, type VARCHAR(255) NOT NULL, nom_producteur VARCHAR(255) NOT NULL, INDEX IDX_BE34A09CF347EFB (produit_id), INDEX IDX_BE34A09C60BB6FE6 (auteur_id), INDEX IDX_BE34A09CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, user_id INT DEFAULT NULL, quantite VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4B365660F347EFB (produit_id), INDEX IDX_4B365660A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_declaration (stock_id INT NOT NULL, declaration_id INT NOT NULL, INDEX IDX_A56D7CF6DCD6110 (stock_id), INDEX IDX_A56D7CF6C06258A3 (declaration_id), PRIMARY KEY(stock_id, declaration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, postnom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE declaration ADD CONSTRAINT FK_7AA3DAC2F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE declaration ADD CONSTRAINT FK_7AA3DAC2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE stock_declaration ADD CONSTRAINT FK_A56D7CF6DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_declaration ADD CONSTRAINT FK_A56D7CF6C06258A3 FOREIGN KEY (declaration_id) REFERENCES declaration (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration DROP FOREIGN KEY FK_7AA3DAC2F347EFB');
        $this->addSql('ALTER TABLE declaration DROP FOREIGN KEY FK_7AA3DAC2A76ED395');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A76ED395');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09CF347EFB');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C60BB6FE6');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09CA76ED395');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660F347EFB');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660A76ED395');
        $this->addSql('ALTER TABLE stock_declaration DROP FOREIGN KEY FK_A56D7CF6DCD6110');
        $this->addSql('ALTER TABLE stock_declaration DROP FOREIGN KEY FK_A56D7CF6C06258A3');
        $this->addSql('DROP TABLE declaration');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stock_declaration');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
