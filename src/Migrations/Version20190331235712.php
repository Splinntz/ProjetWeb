<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190331235712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tchat (id INT AUTO_INCREMENT NOT NULL, user1_id INT NOT NULL, user2_id INT NOT NULL, INDEX IDX_8EA99CA456AE248B (user1_id), INDEX IDX_8EA99CA4441B8B65 (user2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tchat ADD CONSTRAINT FK_8EA99CA456AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B1B7AF664');
        $this->addSql('DROP INDEX IDX_54F1F40B1B7AF664 ON advert');
        $this->addSql('ALTER TABLE advert DROP id_discipline_id');
        $this->addSql('ALTER TABLE user ADD number_ratings INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tchat');
        $this->addSql('ALTER TABLE advert ADD id_discipline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B1B7AF664 FOREIGN KEY (id_discipline_id) REFERENCES discipline (id)');
        $this->addSql('CREATE INDEX IDX_54F1F40B1B7AF664 ON advert (id_discipline_id)');
        $this->addSql('ALTER TABLE user DROP number_ratings');
    }
}
