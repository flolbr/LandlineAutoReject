<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180921162556 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_CC8E2F3EA5626C52');
        $this->addSql('CREATE TEMPORARY TABLE __temp__call AS SELECT id, caller_id, time FROM call');
        $this->addSql('DROP TABLE call');
        $this->addSql('CREATE TABLE call (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, caller_id INTEGER NOT NULL, time DATETIME NOT NULL, CONSTRAINT FK_CC8E2F3EA5626C52 FOREIGN KEY (caller_id) REFERENCES caller (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO call (id, caller_id, time) SELECT id, caller_id, time FROM __temp__call');
        $this->addSql('DROP TABLE __temp__call');
        $this->addSql('CREATE INDEX IDX_CC8E2F3EA5626C52 ON call (caller_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_CC8E2F3EA5626C52');
        $this->addSql('CREATE TEMPORARY TABLE __temp__call AS SELECT id, caller_id, time FROM call');
        $this->addSql('DROP TABLE call');
        $this->addSql('CREATE TABLE call (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, caller_id INTEGER NOT NULL, time DATETIME NOT NULL)');
        $this->addSql('INSERT INTO call (id, caller_id, time) SELECT id, caller_id, time FROM __temp__call');
        $this->addSql('DROP TABLE __temp__call');
        $this->addSql('CREATE INDEX IDX_CC8E2F3EA5626C52 ON call (caller_id)');
    }
}
