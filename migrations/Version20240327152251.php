<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327152251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro_time CHANGE heure_debut heure_debut DATETIME DEFAULT NULL, CHANGE heure_fin heure_fin DATETIME DEFAULT NULL, CHANGE jour jour VARCHAR(255) DEFAULT NULL, CHANGE id_pro pro_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pro_time ADD CONSTRAINT FK_BFB42D37C3B7E4BA FOREIGN KEY (pro_id) REFERENCES add_creche (id)');
        $this->addSql('CREATE INDEX IDX_BFB42D37C3B7E4BA ON pro_time (pro_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro_time DROP FOREIGN KEY FK_BFB42D37C3B7E4BA');
        $this->addSql('DROP INDEX IDX_BFB42D37C3B7E4BA ON pro_time');
        $this->addSql('ALTER TABLE pro_time CHANGE jour jour JSON DEFAULT NULL, CHANGE heure_debut heure_debut TIME DEFAULT NULL, CHANGE heure_fin heure_fin TIME DEFAULT NULL, CHANGE pro_id id_pro INT DEFAULT NULL');
    }
}
