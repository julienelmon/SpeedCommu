<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019101111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_AA08CB109A8664A6');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP INDEX IDX_AA08CB109A8664A6 ON login');
        $this->addSql('ALTER TABLE login DROP post_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE login ADD post_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_AA08CB109A8664A6 FOREIGN KEY (post_user_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_AA08CB109A8664A6 ON login (post_user_id)');
    }
}
