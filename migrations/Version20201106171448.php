<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201106171448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information ADD person_information_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE information ADD CONSTRAINT FK_29791883CB2D013F FOREIGN KEY (person_information_id) REFERENCES person (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29791883CB2D013F ON information (person_information_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information DROP FOREIGN KEY FK_29791883CB2D013F');
        $this->addSql('DROP INDEX UNIQ_29791883CB2D013F ON information');
        $this->addSql('ALTER TABLE information DROP person_information_id');
    }
}
