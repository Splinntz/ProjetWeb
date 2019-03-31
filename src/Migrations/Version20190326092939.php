<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326092939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tchat (id INT AUTO_INCREMENT NOT NULL, id_user_id_1 INT NOT NULL, id_user_id_2 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE message');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B1B7AF664');
        $this->addSql('DROP INDEX IDX_54F1F40B1B7AF664 ON advert');
        $this->addSql('ALTER TABLE advert DROP id_discipline_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, date DATETIME NOT NULL, name_user_name VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci, id_tchat_id INT NOT NULL, INDEX is_tchat_id (id_tchat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE tchat');
        $this->addSql('ALTER TABLE advert ADD id_discipline_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B1B7AF664 FOREIGN KEY (id_discipline_id) REFERENCES discipline (id)');
        $this->addSql('CREATE INDEX IDX_54F1F40B1B7AF664 ON advert (id_discipline_id)');
    }
}
