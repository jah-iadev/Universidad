<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017083628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumno (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, telefono VARCHAR(9) DEFAULT NULL, correo VARCHAR(255) DEFAULT NULL, fecha_nacimiento DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asignatura (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, creditos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aula (id INT AUTO_INCREMENT NOT NULL, asignatura_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, ubicacion VARCHAR(255) NOT NULL, capacidad INT DEFAULT NULL, INDEX IDX_31990A4C5C70C5B (asignatura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matricula (id INT AUTO_INCREMENT NOT NULL, alumno_id INT NOT NULL, asignatura_id INT NOT NULL, INDEX IDX_15DF1885FC28E5EE (alumno_id), INDEX IDX_15DF1885C5C70C5B (asignatura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aula ADD CONSTRAINT FK_31990A4C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
        $this->addSql('ALTER TABLE matricula ADD CONSTRAINT FK_15DF1885FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id)');
        $this->addSql('ALTER TABLE matricula ADD CONSTRAINT FK_15DF1885C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aula DROP FOREIGN KEY FK_31990A4C5C70C5B');
        $this->addSql('ALTER TABLE matricula DROP FOREIGN KEY FK_15DF1885FC28E5EE');
        $this->addSql('ALTER TABLE matricula DROP FOREIGN KEY FK_15DF1885C5C70C5B');
        $this->addSql('DROP TABLE alumno');
        $this->addSql('DROP TABLE asignatura');
        $this->addSql('DROP TABLE aula');
        $this->addSql('DROP TABLE matricula');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
