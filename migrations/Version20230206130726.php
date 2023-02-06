<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206130726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE boss_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE versus_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE boss (id INT NOT NULL, character_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3EFE663A1136BE75 ON boss (character_id)');
        $this->addSql('CREATE TABLE versus (id INT NOT NULL, is_won BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE versus_boss (versus_id INT NOT NULL, boss_id INT NOT NULL, PRIMARY KEY(versus_id, boss_id))');
        $this->addSql('CREATE INDEX IDX_204BFA97DA42C2AC ON versus_boss (versus_id)');
        $this->addSql('CREATE INDEX IDX_204BFA97261FB672 ON versus_boss (boss_id)');
        $this->addSql('ALTER TABLE boss ADD CONSTRAINT FK_3EFE663A1136BE75 FOREIGN KEY (character_id) REFERENCES character (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE versus_boss ADD CONSTRAINT FK_204BFA97DA42C2AC FOREIGN KEY (versus_id) REFERENCES versus (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE versus_boss ADD CONSTRAINT FK_204BFA97261FB672 FOREIGN KEY (boss_id) REFERENCES boss (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD versus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649DA42C2AC FOREIGN KEY (versus_id) REFERENCES versus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D649DA42C2AC ON "user" (versus_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649DA42C2AC');
        $this->addSql('DROP SEQUENCE boss_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE versus_id_seq CASCADE');
        $this->addSql('ALTER TABLE boss DROP CONSTRAINT FK_3EFE663A1136BE75');
        $this->addSql('ALTER TABLE versus_boss DROP CONSTRAINT FK_204BFA97DA42C2AC');
        $this->addSql('ALTER TABLE versus_boss DROP CONSTRAINT FK_204BFA97261FB672');
        $this->addSql('DROP TABLE boss');
        $this->addSql('DROP TABLE versus');
        $this->addSql('DROP TABLE versus_boss');
        $this->addSql('DROP INDEX IDX_8D93D649DA42C2AC');
        $this->addSql('ALTER TABLE "user" DROP versus_id');
    }
}
