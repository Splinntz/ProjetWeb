<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330181334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD number_ratings INT NOT NULL');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B1B7AF664');
        $this->addSql('DROP INDEX IDX_54F1F40B1B7AF664 ON advert');
        $this->addSql('ALTER TABLE advert DROP id_discipline_id');
        $this->addSql('DROP INDEX id_user_id_2 ON tchat');
        $this->addSql('DROP INDEX id_user_id_1 ON tchat');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advert ADD id_discipline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B1B7AF664 FOREIGN KEY (id_discipline_id) REFERENCES discipline (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_54F1F40B1B7AF664 ON advert (id_discipline_id)');
        $this->addSql('CREATE INDEX id_user_id_2 ON tchat (id_user_id_2)');
        $this->addSql('CREATE INDEX id_user_id_1 ON tchat (id_user_id_1)');
        $this->addSql('ALTER TABLE user DROP number_ratings');
    }
}
