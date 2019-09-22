<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190922094011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_brand (id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_article_image (id VARCHAR(255) NOT NULL, amo_article_id VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D7706BF7A92899C9 (amo_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE amo_article (id VARCHAR(255) NOT NULL, amo_owner_id VARCHAR(255) DEFAULT NULL, amo_brand_id VARCHAR(255) DEFAULT NULL, state VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, gender VARCHAR(255) NOT NULL, age_min INT DEFAULT NULL, age_max INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_4E4E09D3C57B52FD (amo_owner_id), INDEX IDX_4E4E09D3FFB2E30C (amo_brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_article_image ADD CONSTRAINT FK_D7706BF7A92899C9 FOREIGN KEY (amo_article_id) REFERENCES amo_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE amo_article ADD CONSTRAINT FK_4E4E09D3C57B52FD FOREIGN KEY (amo_owner_id) REFERENCES amo_user (id)');
        $this->addSql('ALTER TABLE amo_article ADD CONSTRAINT FK_4E4E09D3FFB2E30C FOREIGN KEY (amo_brand_id) REFERENCES amo_brand (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amo_article DROP FOREIGN KEY FK_4E4E09D3FFB2E30C');
        $this->addSql('ALTER TABLE amo_article_image DROP FOREIGN KEY FK_D7706BF7A92899C9');
        $this->addSql('DROP TABLE amo_brand');
        $this->addSql('DROP TABLE amo_article_image');
        $this->addSql('DROP TABLE amo_article');
    }
}
