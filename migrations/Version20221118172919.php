<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118172919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offside (id INT AUTO_INCREMENT NOT NULL, offside_category VARCHAR(200) DEFAULT NULL, is_response TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offside_user (offside_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7255FE8AF1AA3823 (offside_id), INDEX IDX_7255FE8AA76ED395 (user_id), PRIMARY KEY(offside_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offside_user ADD CONSTRAINT FK_7255FE8AF1AA3823 FOREIGN KEY (offside_id) REFERENCES offside (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offside_user ADD CONSTRAINT FK_7255FE8AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offside_user DROP FOREIGN KEY FK_7255FE8AF1AA3823');
        $this->addSql('ALTER TABLE offside_user DROP FOREIGN KEY FK_7255FE8AA76ED395');
        $this->addSql('DROP TABLE offside');
        $this->addSql('DROP TABLE offside_user');
    }
}
