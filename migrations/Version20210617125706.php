<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210617125706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table client';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, address VARCHAR(100) NOT NULL, contact VARCHAR(100) DEFAULT NULL, tva VARCHAR(50) DEFAULT NULL, ape VARCHAR(5) DEFAULT NULL, siret VARCHAR(9) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE client');
    }
}
