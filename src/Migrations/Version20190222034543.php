<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190222034543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_advert_id INT NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_9474526CC6EE5C49 (id_utilisateur_id), INDEX IDX_9474526C504B7091 (id_advert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advert (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, text LONGTEXT NOT NULL, price DOUBLE PRECISION DEFAULT NULL, place VARCHAR(100) DEFAULT NULL, INDEX IDX_54F1F40B79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, note INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C504B7091 FOREIGN KEY (id_advert_id) REFERENCES advert (id)');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C504B7091');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CC6EE5C49');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B79F37AE5');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE advert');
        $this->addSql('DROP TABLE user');
    }
}
