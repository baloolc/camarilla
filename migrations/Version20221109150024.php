<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109150024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(200) NOT NULL, firstname VARCHAR(200) NOT NULL, is_activate TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(200) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, link LONGTEXT DEFAULT NULL, clan VARCHAR(50) NOT NULL, age_status VARCHAR(50) NOT NULL, is_activate TINYINT(1) DEFAULT NULL, recognized VARCHAR(255) DEFAULT NULL, is_harpie TINYINT(1) DEFAULT NULL, INDEX IDX_937AB034A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, title VARCHAR(100) DEFAULT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE TABLE offside (id INT AUTO_INCREMENT NOT NULL, offside_category VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offside_user (offside_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7255FE8AF1AA3823 (offside_id), INDEX IDX_7255FE8AA76ED395 (user_id), PRIMARY KEY(offside_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offside_user ADD CONSTRAINT FK_7255FE8AF1AA3823 FOREIGN KEY (offside_id) REFERENCES offside (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offside_user ADD CONSTRAINT FK_7255FE8AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE TABLE offside_topic (id INT AUTO_INCREMENT NOT NULL, offside_id INT DEFAULT NULL, topic_title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, topic_content LONGTEXT NOT NULL, parent_id INT DEFAULT NULL, INDEX IDX_9FD28B39F1AA3823 (offside_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offside_topic ADD CONSTRAINT FK_9FD28B39F1AA3823 FOREIGN KEY (offside_id) REFERENCES offside (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A76ED395');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('ALTER TABLE user DROP avatar');
        $this->addSql('ALTER TABLE offside_user DROP FOREIGN KEY FK_7255FE8AF1AA3823');
        $this->addSql('ALTER TABLE offside_user DROP FOREIGN KEY FK_7255FE8AA76ED395');
        $this->addSql('DROP TABLE offside');
        $this->addSql('DROP TABLE offside_user');
        $this->addSql('ALTER TABLE offside_topic DROP FOREIGN KEY FK_9FD28B39F1AA3823');
        $this->addSql('DROP TABLE offside_topic');
    }
}
