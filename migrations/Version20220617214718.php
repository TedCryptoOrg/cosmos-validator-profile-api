<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617214718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Associate tables and create indexes';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE validator_interest (validator_id INT NOT NULL, interest_id INT NOT NULL, INDEX IDX_A5CB29EB0644AEC (validator_id), INDEX IDX_A5CB29E5A95FF89 (interest_id), PRIMARY KEY(validator_id, interest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE validator_interest ADD CONSTRAINT FK_A5CB29EB0644AEC FOREIGN KEY (validator_id) REFERENCES validator (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE validator_interest ADD CONSTRAINT FK_A5CB29E5A95FF89 FOREIGN KEY (interest_id) REFERENCES interest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE validator_address ADD validator_id INT NOT NULL');
        $this->addSql('ALTER TABLE validator_address ADD CONSTRAINT FK_69DD5C5BB0644AEC FOREIGN KEY (validator_id) REFERENCES validator (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_69DD5C5BB0644AEC ON validator_address (validator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE validator_interest');
        $this->addSql('ALTER TABLE validator_address DROP FOREIGN KEY FK_69DD5C5BB0644AEC');
        $this->addSql('DROP INDEX IDX_69DD5C5BB0644AEC ON validator_address');
        $this->addSql('ALTER TABLE validator_address DROP validator_id');
    }
}
