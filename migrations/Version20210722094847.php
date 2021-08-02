<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210722094847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table project and link to table client';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, name VARCHAR(50) DEFAULT NULL, contact_channel VARCHAR(50) DEFAULT NULL, INDEX IDX_2FB3D0EE19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE project');
    }
}
