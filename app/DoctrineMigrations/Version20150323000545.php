<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150323000545 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE post ADD post_excerpt VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE post ADD post_status INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD post_modified TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE post ADD postAuthor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post RENAME COLUMN body TO content');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_FAB8C3B3E5A9BD79 FOREIGN KEY (postAuthor_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FAB8C3B3E5A9BD79 ON post (postAuthor_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE Post DROP CONSTRAINT FK_FAB8C3B3E5A9BD79');
        $this->addSql('DROP INDEX IDX_FAB8C3B3E5A9BD79');
        $this->addSql('ALTER TABLE Post DROP post_excerpt');
        $this->addSql('ALTER TABLE Post DROP post_status');
        $this->addSql('ALTER TABLE Post DROP post_modified');
        $this->addSql('ALTER TABLE Post DROP postAuthor_id');
        $this->addSql('ALTER TABLE Post RENAME COLUMN content TO body');
    }
}
