<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026001328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_AA08CB104B89032C');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP INDEX IDX_AA08CB104B89032C ON login');
        $this->addSql('ALTER TABLE login DROP post_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, relation_login_id INT DEFAULT NULL, author VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, text LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_created DATETIME DEFAULT NULL, INDEX IDX_5A8A6C8D7BA9DAE5 (relation_login_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D7BA9DAE5 FOREIGN KEY (relation_login_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE login ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_AA08CB104B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_AA08CB104B89032C ON login (post_id)');
    }
}
