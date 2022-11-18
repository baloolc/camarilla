<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118174126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offside_topic (id INT AUTO_INCREMENT NOT NULL, offside_id INT DEFAULT NULL, topic_title VARCHAR(255) NOT NULL, topic_date DATETIME NOT NULL, topic_text LONGTEXT NOT NULL, INDEX IDX_9FD28B39F1AA3823 (offside_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offside_topic ADD CONSTRAINT FK_9FD28B39F1AA3823 FOREIGN KEY (offside_id) REFERENCES offside (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offside_topic DROP FOREIGN KEY FK_9FD28B39F1AA3823');
        $this->addSql('DROP TABLE offside_topic');
    }
}
