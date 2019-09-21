<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190916223605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_other_contact (id VARCHAR(255) NOT NULL, amo_type_other_contact_id VARCHAR(255) DEFAULT NULL, amo_user_id VARCHAR(255) DEFAULT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_3AC565ED2180EEB1 (amo_type_other_contact_id), INDEX IDX_3AC565EDEB1AD420 (amo_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_type_other_contact (id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_other_contact ADD CONSTRAINT FK_3AC565ED2180EEB1 FOREIGN KEY (amo_type_other_contact_id) REFERENCES amo_type_other_contact (id)');
        $this->addSql('ALTER TABLE amo_other_contact ADD CONSTRAINT FK_3AC565EDEB1AD420 FOREIGN KEY (amo_user_id) REFERENCES amo_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_other_contact DROP FOREIGN KEY FK_3AC565ED2180EEB1');
        $this->addSql('DROP TABLE amo_other_contact');
        $this->addSql('DROP TABLE amo_type_other_contact');
    }
}
