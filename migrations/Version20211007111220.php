<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007111220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE social_network (id INT AUTO_INCREMENT NOT NULL, relation_id_id INT NOT NULL, link_fb VARCHAR(1000) DEFAULT NULL, link_instagram VARCHAR(1000) DEFAULT NULL, link_twitter VARCHAR(1000) DEFAULT NULL, link_tumblr VARCHAR(1000) DEFAULT NULL, link_git_hub VARCHAR(1000) DEFAULT NULL, link_deviant_art VARCHAR(1000) DEFAULT NULL, UNIQUE INDEX UNIQ_EFFF5221ECFA4BC9 (relation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF5221ECFA4BC9 FOREIGN KEY (relation_id_id) REFERENCES login (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE social_network');
    }
}
