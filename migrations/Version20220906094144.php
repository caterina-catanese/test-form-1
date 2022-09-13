<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906094144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documenti (id INT AUTO_INCREMENT NOT NULL, titolo VARCHAR(100) NOT NULL, descrizione LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documenti_user (documenti_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6B34349060AB90A9 (documenti_id), INDEX IDX_6B343490A76ED395 (user_id), PRIMARY KEY(documenti_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documenti_user ADD CONSTRAINT FK_6B34349060AB90A9 FOREIGN KEY (documenti_id) REFERENCES documenti (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documenti_user ADD CONSTRAINT FK_6B343490A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documenti_user DROP FOREIGN KEY FK_6B34349060AB90A9');
        $this->addSql('ALTER TABLE documenti_user DROP FOREIGN KEY FK_6B343490A76ED395');
        $this->addSql('DROP TABLE documenti');
        $this->addSql('DROP TABLE documenti_user');
        $this->addSql('DROP TABLE user');
    }
}
