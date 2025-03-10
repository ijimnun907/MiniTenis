<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250310124442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partido (id INT AUTO_INCREMENT NOT NULL, jugador1_id INT DEFAULT NULL, jugador2_id INT DEFAULT NULL, juez_id INT DEFAULT NULL, fecha DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', puntuacion1 INT NOT NULL, puntuacion2 INT NOT NULL, num_juegos1 INT NOT NULL, num_juegos2 INT NOT NULL, servicio_actual INT NOT NULL, notas VARCHAR(255) DEFAULT NULL, INDEX IDX_4E79750B390198F4 (jugador1_id), INDEX IDX_4E79750B2BB4371A (jugador2_id), INDEX IDX_4E79750B2515F440 (juez_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE socio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, usuario VARCHAR(255) NOT NULL, clave VARCHAR(255) NOT NULL, administrador TINYINT(1) NOT NULL, inscriptor TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B390198F4 FOREIGN KEY (jugador1_id) REFERENCES socio (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B2BB4371A FOREIGN KEY (jugador2_id) REFERENCES socio (id)');
        $this->addSql('ALTER TABLE partido ADD CONSTRAINT FK_4E79750B2515F440 FOREIGN KEY (juez_id) REFERENCES socio (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B390198F4');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B2BB4371A');
        $this->addSql('ALTER TABLE partido DROP FOREIGN KEY FK_4E79750B2515F440');
        $this->addSql('DROP TABLE partido');
        $this->addSql('DROP TABLE socio');
    }
}
