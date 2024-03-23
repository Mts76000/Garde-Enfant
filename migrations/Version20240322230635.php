<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322230635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE add_creche ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE add_creche ADD CONSTRAINT FK_86FB28E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_86FB28E4A76ED395 ON add_creche (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64967B3B43D');
        $this->addSql('DROP INDEX UNIQ_8D93D64967B3B43D ON user');
        $this->addSql('ALTER TABLE user DROP users_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE add_creche DROP FOREIGN KEY FK_86FB28E4A76ED395');
        $this->addSql('DROP INDEX IDX_86FB28E4A76ED395 ON add_creche');
        $this->addSql('ALTER TABLE add_creche DROP user_id');
        $this->addSql('ALTER TABLE user ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64967B3B43D FOREIGN KEY (users_id) REFERENCES add_creche (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64967B3B43D ON user (users_id)');
    }
}
