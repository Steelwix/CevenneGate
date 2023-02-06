<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206163239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_boss (user_id INT NOT NULL, boss_id INT NOT NULL, PRIMARY KEY(user_id, boss_id))');
        $this->addSql('CREATE INDEX IDX_447F2AF3A76ED395 ON user_boss (user_id)');
        $this->addSql('CREATE INDEX IDX_447F2AF3261FB672 ON user_boss (boss_id)');
        $this->addSql('ALTER TABLE user_boss ADD CONSTRAINT FK_447F2AF3A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_boss ADD CONSTRAINT FK_447F2AF3261FB672 FOREIGN KEY (boss_id) REFERENCES boss (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_boss DROP CONSTRAINT FK_447F2AF3A76ED395');
        $this->addSql('ALTER TABLE user_boss DROP CONSTRAINT FK_447F2AF3261FB672');
        $this->addSql('DROP TABLE user_boss');
    }
}
