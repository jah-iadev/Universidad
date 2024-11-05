<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241018110627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asignatura ADD aula_id INT NOT NULL');
        $this->addSql('ALTER TABLE asignatura ADD CONSTRAINT FK_9243D6CEAD1A1255 FOREIGN KEY (aula_id) REFERENCES aula (id)');
        $this->addSql('CREATE INDEX IDX_9243D6CEAD1A1255 ON asignatura (aula_id)');
        $this->addSql('ALTER TABLE aula DROP FOREIGN KEY FK_31990A4C5C70C5B');
        $this->addSql('DROP INDEX IDX_31990A4C5C70C5B ON aula');
        $this->addSql('ALTER TABLE aula DROP asignatura_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asignatura DROP FOREIGN KEY FK_9243D6CEAD1A1255');
        $this->addSql('DROP INDEX IDX_9243D6CEAD1A1255 ON asignatura');
        $this->addSql('ALTER TABLE asignatura DROP aula_id');
        $this->addSql('ALTER TABLE aula ADD asignatura_id INT NOT NULL');
        $this->addSql('ALTER TABLE aula ADD CONSTRAINT FK_31990A4C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
        $this->addSql('CREATE INDEX IDX_31990A4C5C70C5B ON aula (asignatura_id)');
    }
}
