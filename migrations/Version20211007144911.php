<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007144911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_network DROP FOREIGN KEY FK_EFFF5221793459C3');
        $this->addSql('DROP INDEX UNIQ_EFFF5221793459C3 ON social_network');
        $this->addSql('ALTER TABLE social_network DROP login_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_network ADD login_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF5221793459C3 FOREIGN KEY (login_id_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFFF5221793459C3 ON social_network (login_id_id)');
    }
}
