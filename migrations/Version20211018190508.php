<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018190508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE like_login DROP FOREIGN KEY FK_1D6CE2F7859BFA32');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('DROP TABLE like_login');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, userliked INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE like_login (like_id INT NOT NULL, login_id INT NOT NULL, INDEX IDX_1D6CE2F7859BFA32 (like_id), INDEX IDX_1D6CE2F75CB2E05D (login_id), PRIMARY KEY(like_id, login_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE like_login ADD CONSTRAINT FK_1D6CE2F75CB2E05D FOREIGN KEY (login_id) REFERENCES login (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE like_login ADD CONSTRAINT FK_1D6CE2F7859BFA32 FOREIGN KEY (like_id) REFERENCES `like` (id) ON DELETE CASCADE');
    }
}
