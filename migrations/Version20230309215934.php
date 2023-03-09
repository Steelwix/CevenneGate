<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309215934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE rarity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE relic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rarity (id INT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE relic (id INT NOT NULL, drop_on_id INT DEFAULT NULL, rarity_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, component VARCHAR(255) DEFAULT NULL, description VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_688191CBA43383BF ON relic (drop_on_id)');
        $this->addSql('CREATE INDEX IDX_688191CBF3747573 ON relic (rarity_id)');
        $this->addSql('ALTER TABLE relic ADD CONSTRAINT FK_688191CBA43383BF FOREIGN KEY (drop_on_id) REFERENCES boss (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE relic ADD CONSTRAINT FK_688191CBF3747573 FOREIGN KEY (rarity_id) REFERENCES rarity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE character ALTER speed SET NOT NULL');
        $this->addSql('ALTER TABLE character ALTER maxhp SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE rarity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE relic_id_seq CASCADE');
        $this->addSql('ALTER TABLE relic DROP CONSTRAINT FK_688191CBA43383BF');
        $this->addSql('ALTER TABLE relic DROP CONSTRAINT FK_688191CBF3747573');
        $this->addSql('DROP TABLE rarity');
        $this->addSql('DROP TABLE relic');
        $this->addSql('ALTER TABLE character ALTER speed DROP NOT NULL');
        $this->addSql('ALTER TABLE character ALTER maxhp DROP NOT NULL');
    }
}
