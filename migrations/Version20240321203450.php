<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321203450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE full_child (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, consigne_alimentaire LONGTEXT NOT NULL, traitement LONGTEXT NOT NULL, vaccin INT NOT NULL, alergie LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_575C10A8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pro_time (id INT AUTO_INCREMENT NOT NULL, id_pro INT DEFAULT NULL, jour VARCHAR(255) DEFAULT NULL, heure_debut DATETIME DEFAULT NULL, heure_fin DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, child_id INT NOT NULL, pro_id INT NOT NULL, date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_10C31F86DD62C21B (child_id), INDEX IDX_10C31F86C3B7E4BA (pro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE full_child ADD CONSTRAINT FK_575C10A8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86DD62C21B FOREIGN KEY (child_id) REFERENCES full_child (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86C3B7E4BA FOREIGN KEY (pro_id) REFERENCES add_creche (id)');
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429A76ED395');
        $this->addSql('DROP TABLE child');
        $this->addSql('ALTER TABLE add_creche DROP description, CHANGE siret siret VARCHAR(14) NOT NULL, CHANGE tarif tarif VARCHAR(6) NOT NULL, CHANGE max_enfant max_enfant VARCHAR(4) NOT NULL, CHANGE agrement agrement VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE recup_child ADD user_id INT NOT NULL, ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE recup_child ADD CONSTRAINT FK_8E787E42A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8E787E42A76ED395 ON recup_child (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, age VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, genre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, consigne_alimentaire LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, traitement LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, vaccin INT NOT NULL, alergie LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_22B35429A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE full_child DROP FOREIGN KEY FK_575C10A8A76ED395');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86DD62C21B');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86C3B7E4BA');
        $this->addSql('DROP TABLE full_child');
        $this->addSql('DROP TABLE pro_time');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('ALTER TABLE add_creche ADD description LONGTEXT DEFAULT NULL, CHANGE siret siret VARCHAR(255) NOT NULL, CHANGE tarif tarif VARCHAR(255) NOT NULL, CHANGE max_enfant max_enfant INT NOT NULL, CHANGE agrement agrement VARCHAR(255) DEFAULT NULL, CHANGE status status VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE recup_child DROP FOREIGN KEY FK_8E787E42A76ED395');
        $this->addSql('DROP INDEX IDX_8E787E42A76ED395 ON recup_child');
        $this->addSql('ALTER TABLE recup_child DROP user_id, DROP status');
    }
}
