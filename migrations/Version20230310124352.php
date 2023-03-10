<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310124352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_relic (character_id INT NOT NULL, relic_id INT NOT NULL, PRIMARY KEY(character_id, relic_id))');
        $this->addSql('CREATE INDEX IDX_964276A91136BE75 ON character_relic (character_id)');
        $this->addSql('CREATE INDEX IDX_964276A995EB414 ON character_relic (relic_id)');
        $this->addSql('ALTER TABLE character_relic ADD CONSTRAINT FK_964276A91136BE75 FOREIGN KEY (character_id) REFERENCES character (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE character_relic ADD CONSTRAINT FK_964276A995EB414 FOREIGN KEY (relic_id) REFERENCES relic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE character_relic DROP CONSTRAINT FK_964276A91136BE75');
        $this->addSql('ALTER TABLE character_relic DROP CONSTRAINT FK_964276A995EB414');
        $this->addSql('DROP TABLE character_relic');
    }
}
