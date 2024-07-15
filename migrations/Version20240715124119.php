<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715124119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tournament (user_id INT NOT NULL, tournament_id INT NOT NULL, INDEX IDX_1A387E35A76ED395 (user_id), INDEX IDX_1A387E3533D1A3E7 (tournament_id), PRIMARY KEY(user_id, tournament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_tournament ADD CONSTRAINT FK_1A387E35A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tournament ADD CONSTRAINT FK_1A387E3533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE38726D14C32F');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387278DE47A9');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE38725DFCD4B8');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872E48FD905');
        $this->addSql('DROP INDEX IDX_B8EE38726D14C32F ON club');
        $this->addSql('DROP INDEX IDX_B8EE38725DFCD4B8 ON club');
        $this->addSql('DROP INDEX IDX_B8EE3872E48FD905 ON club');
        $this->addSql('DROP INDEX IDX_B8EE387278DE47A9 ON club');
        $this->addSql('ALTER TABLE club DROP game_id, DROP firstclub_id, DROP secondclub_id, DROP winner_id');
        $this->addSql('ALTER TABLE game ADD first_club_id INT DEFAULT NULL, ADD second_club_id INT DEFAULT NULL, ADD winner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C729566CE FOREIGN KEY (first_club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C765B8A5F FOREIGN KEY (second_club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C5DFCD4B8 FOREIGN KEY (winner_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_232B318C729566CE ON game (first_club_id)');
        $this->addSql('CREATE INDEX IDX_232B318C765B8A5F ON game (second_club_id)');
        $this->addSql('CREATE INDEX IDX_232B318C5DFCD4B8 ON game (winner_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64933D1A3E7');
        $this->addSql('DROP INDEX IDX_8D93D64933D1A3E7 ON user');
        $this->addSql('ALTER TABLE user DROP tournament_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE user_tournament DROP FOREIGN KEY FK_1A387E35A76ED395');
        $this->addSql('ALTER TABLE user_tournament DROP FOREIGN KEY FK_1A387E3533D1A3E7');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user_tournament');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C729566CE');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C765B8A5F');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C5DFCD4B8');
        $this->addSql('DROP INDEX IDX_232B318C729566CE ON game');
        $this->addSql('DROP INDEX IDX_232B318C765B8A5F ON game');
        $this->addSql('DROP INDEX IDX_232B318C5DFCD4B8 ON game');
        $this->addSql('ALTER TABLE game DROP first_club_id, DROP second_club_id, DROP winner_id');
        $this->addSql('ALTER TABLE user ADD tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64933D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64933D1A3E7 ON user (tournament_id)');
        $this->addSql('ALTER TABLE club ADD game_id INT DEFAULT NULL, ADD firstclub_id INT DEFAULT NULL, ADD secondclub_id INT DEFAULT NULL, ADD winner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE38726D14C32F FOREIGN KEY (secondclub_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387278DE47A9 FOREIGN KEY (firstclub_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE38725DFCD4B8 FOREIGN KEY (winner_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_B8EE38726D14C32F ON club (secondclub_id)');
        $this->addSql('CREATE INDEX IDX_B8EE38725DFCD4B8 ON club (winner_id)');
        $this->addSql('CREATE INDEX IDX_B8EE3872E48FD905 ON club (game_id)');
        $this->addSql('CREATE INDEX IDX_B8EE387278DE47A9 ON club (firstclub_id)');
    }
}
