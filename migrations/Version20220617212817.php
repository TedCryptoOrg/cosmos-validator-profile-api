<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617212817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'The initial structure - simple and easy';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blockchain (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, chain_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interest (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE validator (id INT AUTO_INCREMENT NOT NULL, keybase VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, bio LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE validator_address (id INT AUTO_INCREMENT NOT NULL, blockchain_id INT NOT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_69DD5C5B98073AE1 (blockchain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE validator_address ADD CONSTRAINT FK_69DD5C5B98073AE1 FOREIGN KEY (blockchain_id) REFERENCES blockchain (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE validator_address DROP FOREIGN KEY FK_69DD5C5B98073AE1');
        $this->addSql('DROP TABLE blockchain');
        $this->addSql('DROP TABLE interest');
        $this->addSql('DROP TABLE validator');
        $this->addSql('DROP TABLE validator_address');
    }
}
