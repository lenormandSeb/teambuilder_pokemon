<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520124212 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attack_dex (id INT AUTO_INCREMENT NOT NULL, type_attaque_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, categorie INT DEFAULT NULL, tm VARCHAR(255) DEFAULT NULL, power VARCHAR(255) DEFAULT NULL, accurate INT DEFAULT NULL, pp INT DEFAULT NULL, effet LONGTEXT DEFAULT NULL, prob INT DEFAULT NULL, INDEX IDX_8F5D6C96C8C3137 (type_attaque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, stat_aug VARCHAR(255) NOT NULL, stat_down VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokedex (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, type_one_id INT DEFAULT NULL, type_two_id INT DEFAULT NULL, talent_one_id INT DEFAULT NULL, talent_two_id INT DEFAULT NULL, talent_hide_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, num_dex INT NOT NULL, hp INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, spe_attack INT NOT NULL, spe_defense INT NOT NULL, speed INT NOT NULL, generation INT NOT NULL, INDEX IDX_62DC90F3D84DA52B (type_one_id), INDEX IDX_62DC90F3B31142E4 (type_two_id), INDEX IDX_62DC90F388B0888E (talent_one_id), INDEX IDX_62DC90F3E3EC6F41 (talent_two_id), INDEX IDX_62DC90F37D498C4F (talent_hide_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE talent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, effet_combat LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attack_dex ADD CONSTRAINT FK_8F5D6C96C8C3137 FOREIGN KEY (type_attaque_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3D84DA52B FOREIGN KEY (type_one_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3B31142E4 FOREIGN KEY (type_two_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F388B0888E FOREIGN KEY (talent_one_id) REFERENCES talent (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3E3EC6F41 FOREIGN KEY (talent_two_id) REFERENCES talent (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F37D498C4F FOREIGN KEY (talent_hide_id) REFERENCES talent (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F388B0888E');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3E3EC6F41');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F37D498C4F');
        $this->addSql('ALTER TABLE attack_dex DROP FOREIGN KEY FK_8F5D6C96C8C3137');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3D84DA52B');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3B31142E4');
        $this->addSql('DROP TABLE attack_dex');
        $this->addSql('DROP TABLE nature');
        $this->addSql('DROP TABLE pokedex');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE talent');
        $this->addSql('DROP TABLE type');
    }
}
