<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105163756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(200) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, link_character LONGTEXT DEFAULT NULL, age_status VARCHAR(50) NOT NULL, recognized TINYTEXT DEFAULT NULL, is_harpie TINYINT(1) NOT NULL, job VARCHAR(50) DEFAULT NULL, clan VARCHAR(50) NOT NULL, is_validate TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, label VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_937AB0345E237E06 (name), INDEX IDX_937AB034A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, alt_text VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, slug VARCHAR(100) NOT NULL, event_date DATETIME DEFAULT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE in_game_category (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_742F4A945E237E06 (name), INDEX IDX_742F4A94CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE in_game_response (id INT AUTO_INCREMENT NOT NULL, in_game_topic_id INT NOT NULL, character_play_id INT DEFAULT NULL, created_at DATETIME NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_4C1858AE6D367368 (in_game_topic_id), INDEX IDX_4C1858AE4CF2ED80 (character_play_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE in_game_topic (id INT AUTO_INCREMENT NOT NULL, in_game_category_id INT NOT NULL, title VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, upload_file VARCHAR(255) DEFAULT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_E0CECF223D1C4FBE (in_game_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, menu_order INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_menu (menu_source INT NOT NULL, menu_target INT NOT NULL, INDEX IDX_B54ACADD8CCD27AB (menu_source), INDEX IDX_B54ACADD95287724 (menu_target), PRIMARY KEY(menu_source, menu_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offside_category (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_E448D0345E237E06 (name), INDEX IDX_E448D034CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offside_response (id INT AUTO_INCREMENT NOT NULL, offside_topic_id INT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_DC7FC20EFD51E9C8 (offside_topic_id), INDEX IDX_DC7FC20EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offside_topic (id INT AUTO_INCREMENT NOT NULL, offside_category_id INT NOT NULL, title VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, content LONGTEXT NOT NULL, slug VARCHAR(100) NOT NULL, updated_at DATETIME DEFAULT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_9FD28B39BC1C8425 (offside_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, value VARCHAR(100) NOT NULL, label VARCHAR(100) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(200) NOT NULL, firstname VARCHAR(200) NOT NULL, user_avatar VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, is_activate TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE in_game_category ADD CONSTRAINT FK_742F4A94CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE in_game_response ADD CONSTRAINT FK_4C1858AE6D367368 FOREIGN KEY (in_game_topic_id) REFERENCES in_game_topic (id)');
        $this->addSql('ALTER TABLE in_game_response ADD CONSTRAINT FK_4C1858AE4CF2ED80 FOREIGN KEY (character_play_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE in_game_topic ADD CONSTRAINT FK_E0CECF223D1C4FBE FOREIGN KEY (in_game_category_id) REFERENCES in_game_category (id)');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT FK_B54ACADD8CCD27AB FOREIGN KEY (menu_source) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_menu ADD CONSTRAINT FK_B54ACADD95287724 FOREIGN KEY (menu_target) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offside_category ADD CONSTRAINT FK_E448D034CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE offside_response ADD CONSTRAINT FK_DC7FC20EFD51E9C8 FOREIGN KEY (offside_topic_id) REFERENCES offside_topic (id)');
        $this->addSql('ALTER TABLE offside_response ADD CONSTRAINT FK_DC7FC20EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offside_topic ADD CONSTRAINT FK_9FD28B39BC1C8425 FOREIGN KEY (offside_category_id) REFERENCES offside_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A76ED395');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE in_game_category DROP FOREIGN KEY FK_742F4A94CCD7E912');
        $this->addSql('ALTER TABLE in_game_response DROP FOREIGN KEY FK_4C1858AE6D367368');
        $this->addSql('ALTER TABLE in_game_response DROP FOREIGN KEY FK_4C1858AE4CF2ED80');
        $this->addSql('ALTER TABLE in_game_topic DROP FOREIGN KEY FK_E0CECF223D1C4FBE');
        $this->addSql('ALTER TABLE menu_menu DROP FOREIGN KEY FK_B54ACADD8CCD27AB');
        $this->addSql('ALTER TABLE menu_menu DROP FOREIGN KEY FK_B54ACADD95287724');
        $this->addSql('ALTER TABLE offside_category DROP FOREIGN KEY FK_E448D034CCD7E912');
        $this->addSql('ALTER TABLE offside_response DROP FOREIGN KEY FK_DC7FC20EFD51E9C8');
        $this->addSql('ALTER TABLE offside_response DROP FOREIGN KEY FK_DC7FC20EA76ED395');
        $this->addSql('ALTER TABLE offside_topic DROP FOREIGN KEY FK_9FD28B39BC1C8425');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE in_game_category');
        $this->addSql('DROP TABLE in_game_response');
        $this->addSql('DROP TABLE in_game_topic');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_menu');
        $this->addSql('DROP TABLE offside_category');
        $this->addSql('DROP TABLE offside_response');
        $this->addSql('DROP TABLE offside_topic');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
