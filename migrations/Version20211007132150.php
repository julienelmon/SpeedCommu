<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007132150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE social_network (id INT AUTO_INCREMENT NOT NULL, login_id_id INT NOT NULL, link_fb VARCHAR(1000) NOT NULL, link_instagram VARCHAR(1000) NOT NULL, link_twitter VARCHAR(1000) NOT NULL, link_tumblr VARCHAR(1000) NOT NULL, link_deviant_art VARCHAR(1000) NOT NULL, link_github VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EFFF5221793459C3 (login_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF5221793459C3 FOREIGN KEY (login_id_id) REFERENCES login (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE social_network');
    }
}
