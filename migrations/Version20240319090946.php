<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319090946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE full_child ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE full_child ADD CONSTRAINT FK_575C10A8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_575C10A8A76ED395 ON full_child (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE full_child DROP FOREIGN KEY FK_575C10A8A76ED395');
        $this->addSql('DROP INDEX IDX_575C10A8A76ED395 ON full_child');
        $this->addSql('ALTER TABLE full_child DROP user_id');
    }
}
