<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211025234136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD relation_login_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D7BA9DAE5 FOREIGN KEY (relation_login_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D7BA9DAE5 ON post (relation_login_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D7BA9DAE5');
        $this->addSql('DROP INDEX IDX_5A8A6C8D7BA9DAE5 ON post');
        $this->addSql('ALTER TABLE post DROP relation_login_id');
    }
}
