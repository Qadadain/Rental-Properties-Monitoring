<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210916052445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, color VARCHAR(7) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_accounting (id INT AUTO_INCREMENT NOT NULL, operation_type_id INT NOT NULL, label_id INT NOT NULL, property_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, date DATE DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_D86421D6668D0C5E (operation_type_id), INDEX IDX_D86421D633B92F39 (label_id), INDEX IDX_D86421D6549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_receipt (id INT AUTO_INCREMENT NOT NULL, tenant_id INT NOT NULL, rent DOUBLE PRECISION NOT NULL, advances_on_charges DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, start_rent DATE DEFAULT NULL, end_rent DATE DEFAULT NULL, rental_number VARCHAR(20) NOT NULL, date DATE DEFAULT NULL, INDEX IDX_B2B5CD359033212A (tenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_property (id INT AUTO_INCREMENT NOT NULL, rental_property_type_id INT NOT NULL, property_id INT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_BB9405ED1A091FA9 (rental_property_type_id), INDEX IDX_BB9405ED549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_property_accounting (id INT AUTO_INCREMENT NOT NULL, operation_type_id INT NOT NULL, label_id INT NOT NULL, rental_property_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, date DATE DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_18E30DBA668D0C5E (operation_type_id), INDEX IDX_18E30DBA33B92F39 (label_id), INDEX IDX_18E30DBA4D6E2560 (rental_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_property_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tenant (id INT AUTO_INCREMENT NOT NULL, rental_property_id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, entry DATE NOT NULL, leave_accommodation DATE DEFAULT NULL, INDEX IDX_4E59C4624D6E2560 (rental_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, lessor_information VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property_accounting ADD CONSTRAINT FK_D86421D6668D0C5E FOREIGN KEY (operation_type_id) REFERENCES operation_type (id)');
        $this->addSql('ALTER TABLE property_accounting ADD CONSTRAINT FK_D86421D633B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE property_accounting ADD CONSTRAINT FK_D86421D6549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE rent_receipt ADD CONSTRAINT FK_B2B5CD359033212A FOREIGN KEY (tenant_id) REFERENCES tenant (id)');
        $this->addSql('ALTER TABLE rental_property ADD CONSTRAINT FK_BB9405ED1A091FA9 FOREIGN KEY (rental_property_type_id) REFERENCES rental_property_type (id)');
        $this->addSql('ALTER TABLE rental_property ADD CONSTRAINT FK_BB9405ED549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE rental_property_accounting ADD CONSTRAINT FK_18E30DBA668D0C5E FOREIGN KEY (operation_type_id) REFERENCES operation_type (id)');
        $this->addSql('ALTER TABLE rental_property_accounting ADD CONSTRAINT FK_18E30DBA33B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE rental_property_accounting ADD CONSTRAINT FK_18E30DBA4D6E2560 FOREIGN KEY (rental_property_id) REFERENCES rental_property (id)');
        $this->addSql('ALTER TABLE tenant ADD CONSTRAINT FK_4E59C4624D6E2560 FOREIGN KEY (rental_property_id) REFERENCES rental_property (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property_accounting DROP FOREIGN KEY FK_D86421D633B92F39');
        $this->addSql('ALTER TABLE rental_property_accounting DROP FOREIGN KEY FK_18E30DBA33B92F39');
        $this->addSql('ALTER TABLE property_accounting DROP FOREIGN KEY FK_D86421D6668D0C5E');
        $this->addSql('ALTER TABLE rental_property_accounting DROP FOREIGN KEY FK_18E30DBA668D0C5E');
        $this->addSql('ALTER TABLE property_accounting DROP FOREIGN KEY FK_D86421D6549213EC');
        $this->addSql('ALTER TABLE rental_property DROP FOREIGN KEY FK_BB9405ED549213EC');
        $this->addSql('ALTER TABLE rental_property_accounting DROP FOREIGN KEY FK_18E30DBA4D6E2560');
        $this->addSql('ALTER TABLE tenant DROP FOREIGN KEY FK_4E59C4624D6E2560');
        $this->addSql('ALTER TABLE rental_property DROP FOREIGN KEY FK_BB9405ED1A091FA9');
        $this->addSql('ALTER TABLE rent_receipt DROP FOREIGN KEY FK_B2B5CD359033212A');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE operation_type');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_accounting');
        $this->addSql('DROP TABLE rent_receipt');
        $this->addSql('DROP TABLE rental_property');
        $this->addSql('DROP TABLE rental_property_accounting');
        $this->addSql('DROP TABLE rental_property_type');
        $this->addSql('DROP TABLE tenant');
        $this->addSql('DROP TABLE user');
    }
}
