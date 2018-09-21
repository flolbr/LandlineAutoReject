<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180921161113 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE call (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, caller_id INTEGER NOT NULL, time DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_CC8E2F3EA5626C52 ON call (caller_id)');
        $this->addSql('CREATE TABLE number (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(15) NOT NULL, note VARCHAR(255) DEFAULT NULL, added DATETIME NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE call');
        $this->addSql('DROP TABLE number');
    }
}
