<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007111527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_network DROP FOREIGN KEY FK_EFFF5221ECFA4BC9');
        $this->addSql('DROP INDEX UNIQ_EFFF5221ECFA4BC9 ON social_network');
        $this->addSql('ALTER TABLE social_network CHANGE relation_id_id relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF52213256915B FOREIGN KEY (relation_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFFF52213256915B ON social_network (relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_network DROP FOREIGN KEY FK_EFFF52213256915B');
        $this->addSql('DROP INDEX UNIQ_EFFF52213256915B ON social_network');
        $this->addSql('ALTER TABLE social_network CHANGE relation_id relation_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF5221ECFA4BC9 FOREIGN KEY (relation_id_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFFF5221ECFA4BC9 ON social_network (relation_id_id)');
    }
}
