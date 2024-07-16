<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240715132746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, club_name VARCHAR(255) NOT NULL, licence_number SMALLINT NOT NULL, adress VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club_tournament (club_id INT NOT NULL, tournament_id INT NOT NULL, INDEX IDX_F499F63461190A32 (club_id), INDEX IDX_F499F63433D1A3E7 (tournament_id), PRIMARY KEY(club_id, tournament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, first_club_id INT DEFAULT NULL, second_club_id INT DEFAULT NULL, winner_id INT DEFAULT NULL, date DATE NOT NULL, time DATETIME NOT NULL, location VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, score VARCHAR(255) NOT NULL, INDEX IDX_232B318C729566CE (first_club_id), INDEX IDX_232B318C765B8A5F (second_club_id), INDEX IDX_232B318C5DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (id INT AUTO_INCREMENT NOT NULL, tournament_name VARCHAR(255) NOT NULL, date DATE NOT NULL, price SMALLINT NOT NULL, rewards VARCHAR(255) NOT NULL, team_count SMALLINT NOT NULL, player_team_count SMALLINT NOT NULL, location VARCHAR(255) NOT NULL, poster VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_game (tournament_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_14A683B233D1A3E7 (tournament_id), INDEX IDX_14A683B2E48FD905 (game_id), PRIMARY KEY(tournament_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, club_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, INDEX IDX_8D93D64961190A32 (club_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tournament (user_id INT NOT NULL, tournament_id INT NOT NULL, INDEX IDX_1A387E35A76ED395 (user_id), INDEX IDX_1A387E3533D1A3E7 (tournament_id), PRIMARY KEY(user_id, tournament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club_tournament ADD CONSTRAINT FK_F499F63461190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club_tournament ADD CONSTRAINT FK_F499F63433D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C729566CE FOREIGN KEY (first_club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C765B8A5F FOREIGN KEY (second_club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C5DFCD4B8 FOREIGN KEY (winner_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tournament_game ADD CONSTRAINT FK_14A683B233D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournament_game ADD CONSTRAINT FK_14A683B2E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64961190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE user_tournament ADD CONSTRAINT FK_1A387E35A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tournament ADD CONSTRAINT FK_1A387E3533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club_tournament DROP FOREIGN KEY FK_F499F63461190A32');
        $this->addSql('ALTER TABLE club_tournament DROP FOREIGN KEY FK_F499F63433D1A3E7');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C729566CE');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C765B8A5F');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C5DFCD4B8');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE tournament_game DROP FOREIGN KEY FK_14A683B233D1A3E7');
        $this->addSql('ALTER TABLE tournament_game DROP FOREIGN KEY FK_14A683B2E48FD905');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64961190A32');
        $this->addSql('ALTER TABLE user_tournament DROP FOREIGN KEY FK_1A387E35A76ED395');
        $this->addSql('ALTER TABLE user_tournament DROP FOREIGN KEY FK_1A387E3533D1A3E7');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE club_tournament');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE tournament_game');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_tournament');
    }
}
