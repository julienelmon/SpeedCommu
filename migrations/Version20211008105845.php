<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211008105845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_network DROP FOREIGN KEY FK_EFFF52215CB2E05D');
        $this->addSql('DROP INDEX UNIQ_EFFF52215CB2E05D ON social_network');
        $this->addSql('ALTER TABLE social_network ADD login INT NOT NULL, DROP login_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_network ADD login_id INT DEFAULT NULL, DROP login');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF52215CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFFF52215CB2E05D ON social_network (login_id)');
    }
}
