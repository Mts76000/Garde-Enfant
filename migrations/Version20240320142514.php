<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320142514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE add_creche (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, tarif VARCHAR(255) NOT NULL, max_enfant VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, agrement VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, brochure_filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE full_child (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, consigne_alimentaire LONGTEXT NOT NULL, traitement LONGTEXT NOT NULL, vaccin INT NOT NULL, alergie LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_575C10A8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, id_child_id INT NOT NULL, date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_10C31F868DB92E8E (id_child_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recup_child (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, zip INT NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE full_child ADD CONSTRAINT FK_575C10A8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F868DB92E8E FOREIGN KEY (id_child_id) REFERENCES full_child (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE full_child DROP FOREIGN KEY FK_575C10A8A76ED395');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F868DB92E8E');
        $this->addSql('DROP TABLE add_creche');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE full_child');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE recup_child');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
