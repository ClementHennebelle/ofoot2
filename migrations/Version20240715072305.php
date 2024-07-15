<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715072305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_tournament (user_id INT NOT NULL, tournament_id INT NOT NULL, INDEX IDX_1A387E35A76ED395 (user_id), INDEX IDX_1A387E3533D1A3E7 (tournament_id), PRIMARY KEY(user_id, tournament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_tournament ADD CONSTRAINT FK_1A387E35A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tournament ADD CONSTRAINT FK_1A387E3533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64933D1A3E7');
        $this->addSql('DROP INDEX IDX_8D93D64933D1A3E7 ON user');
        $this->addSql('ALTER TABLE user DROP tournament_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_tournament DROP FOREIGN KEY FK_1A387E35A76ED395');
        $this->addSql('ALTER TABLE user_tournament DROP FOREIGN KEY FK_1A387E3533D1A3E7');
        $this->addSql('DROP TABLE user_tournament');
        $this->addSql('ALTER TABLE user ADD tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64933D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64933D1A3E7 ON user (tournament_id)');
    }
}
