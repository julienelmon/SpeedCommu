<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019143203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, date_created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE login ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_AA08CB104B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_AA08CB104B89032C ON login (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_AA08CB104B89032C');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP INDEX IDX_AA08CB104B89032C ON login');
        $this->addSql('ALTER TABLE login DROP post_id');
    }
}
