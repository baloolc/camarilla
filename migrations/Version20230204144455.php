<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230204144455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_category DROP link');
        $this->addSql('ALTER TABLE offside_category DROP link');
        $this->addSql('ALTER TABLE praxis_category DROP link');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offside_category ADD link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE job_category ADD link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE praxis_category ADD link VARCHAR(255) DEFAULT NULL');
    }
}
