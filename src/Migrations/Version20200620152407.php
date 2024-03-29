<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200620152407 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD id_cli_id INT DEFAULT NULL, ADD id_service_id INT DEFAULT NULL, DROP id_cli, DROP id_service');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559A79575D FOREIGN KEY (id_cli_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495548D62931 FOREIGN KEY (id_service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_42C849559A79575D ON reservation (id_cli_id)');
        $this->addSql('CREATE INDEX IDX_42C8495548D62931 ON reservation (id_service_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559A79575D');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495548D62931');
        $this->addSql('DROP INDEX IDX_42C849559A79575D ON reservation');
        $this->addSql('DROP INDEX IDX_42C8495548D62931 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD id_cli INT NOT NULL, ADD id_service INT NOT NULL, DROP id_cli_id, DROP id_service_id');
    }
}
