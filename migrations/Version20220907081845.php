<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907081845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documenti_new (id INT AUTO_INCREMENT NOT NULL, titolo_2 VARCHAR(100) NOT NULL, yes VARCHAR(255) NOT NULL, descrizione LONGTEXT NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documenti_new_user (documenti_new_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_206BFD2AA3F8A816 (documenti_new_id), INDEX IDX_206BFD2AA76ED395 (user_id), PRIMARY KEY(documenti_new_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documenti_new_user ADD CONSTRAINT FK_206BFD2AA3F8A816 FOREIGN KEY (documenti_new_id) REFERENCES documenti_new (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documenti_new_user ADD CONSTRAINT FK_206BFD2AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documenti ADD data_create DATETIME NOT NULL, ADD date_update DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documenti_new_user DROP FOREIGN KEY FK_206BFD2AA3F8A816');
        $this->addSql('DROP TABLE documenti_new');
        $this->addSql('DROP TABLE documenti_new_user');
        $this->addSql('ALTER TABLE documenti DROP data_create, DROP date_update');
    }
}
