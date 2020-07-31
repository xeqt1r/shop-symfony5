<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200729142430 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments CHANGE owner_id owner_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD message_sender_id INT DEFAULT NULL, ADD message_recipient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9C9DB5AB FOREIGN KEY (message_sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F2D2EBA9E FOREIGN KEY (message_recipient_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F9C9DB5AB ON message (message_sender_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F2D2EBA9E ON message (message_recipient_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments CHANGE owner_id owner_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F9C9DB5AB');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F2D2EBA9E');
        $this->addSql('DROP INDEX IDX_B6BD307F9C9DB5AB ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F2D2EBA9E ON message');
        $this->addSql('ALTER TABLE message DROP message_sender_id, DROP message_recipient_id');
    }
}
