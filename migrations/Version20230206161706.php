<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206161706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d649da42c2ac');
        $this->addSql('DROP SEQUENCE versus_id_seq CASCADE');
        $this->addSql('ALTER TABLE versus_boss DROP CONSTRAINT fk_204bfa97da42c2ac');
        $this->addSql('ALTER TABLE versus_boss DROP CONSTRAINT fk_204bfa97261fb672');
        $this->addSql('DROP TABLE versus');
        $this->addSql('DROP TABLE versus_boss');
        $this->addSql('DROP INDEX idx_8d93d649da42c2ac');
        $this->addSql('ALTER TABLE "user" DROP versus_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE versus_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE versus (id INT NOT NULL, is_won BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE versus_boss (versus_id INT NOT NULL, boss_id INT NOT NULL, PRIMARY KEY(versus_id, boss_id))');
        $this->addSql('CREATE INDEX idx_204bfa97261fb672 ON versus_boss (boss_id)');
        $this->addSql('CREATE INDEX idx_204bfa97da42c2ac ON versus_boss (versus_id)');
        $this->addSql('ALTER TABLE versus_boss ADD CONSTRAINT fk_204bfa97da42c2ac FOREIGN KEY (versus_id) REFERENCES versus (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE versus_boss ADD CONSTRAINT fk_204bfa97261fb672 FOREIGN KEY (boss_id) REFERENCES boss (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD versus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d649da42c2ac FOREIGN KEY (versus_id) REFERENCES versus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8d93d649da42c2ac ON "user" (versus_id)');
    }
}
