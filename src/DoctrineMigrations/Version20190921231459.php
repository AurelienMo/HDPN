<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190921231459 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_wallet_virtual (id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_user ADD amo_wallet_virtual_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE amo_user ADD CONSTRAINT FK_7C34BEA92952CC84 FOREIGN KEY (amo_wallet_virtual_id) REFERENCES amo_wallet_virtual (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C34BEA92952CC84 ON amo_user (amo_wallet_virtual_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_user DROP FOREIGN KEY FK_7C34BEA92952CC84');
        $this->addSql('DROP TABLE amo_wallet_virtual');
        $this->addSql('DROP INDEX UNIQ_7C34BEA92952CC84 ON amo_user');
        $this->addSql('ALTER TABLE amo_user DROP amo_wallet_virtual_id');
    }
}
