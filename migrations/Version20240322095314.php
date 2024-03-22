<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322095314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE add_creche ADD pro_id INT NOT NULL');
        $this->addSql('ALTER TABLE add_creche ADD CONSTRAINT FK_86FB28E4C3B7E4BA FOREIGN KEY (pro_id) REFERENCES contact_creche (id)');
        $this->addSql('CREATE INDEX IDX_86FB28E4C3B7E4BA ON add_creche (pro_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE add_creche DROP FOREIGN KEY FK_86FB28E4C3B7E4BA');
        $this->addSql('DROP INDEX IDX_86FB28E4C3B7E4BA ON add_creche');
        $this->addSql('ALTER TABLE add_creche DROP pro_id');
    }
}
