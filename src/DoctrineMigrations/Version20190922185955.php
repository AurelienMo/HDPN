<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190922185955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_category_article (id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_age (id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_article ADD amo_age_id VARCHAR(255) DEFAULT NULL, ADD amo_category_id VARCHAR(255) DEFAULT NULL, DROP age_min, DROP age_max');
        $this->addSql('ALTER TABLE amo_article ADD CONSTRAINT FK_4E4E09D3D1972633 FOREIGN KEY (amo_age_id) REFERENCES amo_age (id)');
        $this->addSql('ALTER TABLE amo_article ADD CONSTRAINT FK_4E4E09D399C8486 FOREIGN KEY (amo_category_id) REFERENCES amo_category_article (id)');
        $this->addSql('CREATE INDEX IDX_4E4E09D3D1972633 ON amo_article (amo_age_id)');
        $this->addSql('CREATE INDEX IDX_4E4E09D399C8486 ON amo_article (amo_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_article DROP FOREIGN KEY FK_4E4E09D399C8486');
        $this->addSql('ALTER TABLE amo_article DROP FOREIGN KEY FK_4E4E09D3D1972633');
        $this->addSql('DROP TABLE amo_category_article');
        $this->addSql('DROP TABLE amo_age');
        $this->addSql('DROP INDEX IDX_4E4E09D3D1972633 ON amo_article');
        $this->addSql('DROP INDEX IDX_4E4E09D399C8486 ON amo_article');
        $this->addSql('ALTER TABLE amo_article ADD age_min INT DEFAULT NULL, ADD age_max INT DEFAULT NULL, DROP amo_age_id, DROP amo_category_id');
    }
}
