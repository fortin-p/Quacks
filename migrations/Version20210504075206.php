<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504075206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ducks ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE duckname duckname VARCHAR(25) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3E591AD90361416 ON ducks (duckname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3E591ADE7927C74 ON ducks (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F3E591AD90361416 ON ducks');
        $this->addSql('DROP INDEX UNIQ_F3E591ADE7927C74 ON ducks');
        $this->addSql('ALTER TABLE ducks DROP roles, CHANGE duckname duckname VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
