<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190324194728 extends AbstractMigration
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
        $this->addSql('CREATE TABLE tchat_message (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, name_user_name VARCHAR(255) NOT NULL, id_tchat_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE INDEX id_user_id_1 ON tchat (id_user_id_1)');
        $this->addSql('CREATE INDEX id_user_id_2 ON tchat (id_user_id_2)');    
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE tchat');
        $this->addSql('DROP TABLE tchat_message');
        $this->addSql('DROP INDEX id_user_id_1 ON tchat');
        $this->addSql('DROP INDEX id_user_id_2 ON tchat');       
    }
}
