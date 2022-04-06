<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406095531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_area (id INT AUTO_INCREMENT NOT NULL, area_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_84679740C69CE56E (area_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_area_doctor (medical_area_id INT NOT NULL, doctor_id INT NOT NULL, INDEX IDX_EBB2CD5AFB0DA052 (medical_area_id), INDEX IDX_EBB2CD5A87F4FB17 (doctor_id), PRIMARY KEY(medical_area_id, doctor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medical_area ADD CONSTRAINT FK_84679740C69CE56E FOREIGN KEY (area_type_id) REFERENCES area_type (id)');
        $this->addSql('ALTER TABLE medical_area_doctor ADD CONSTRAINT FK_EBB2CD5AFB0DA052 FOREIGN KEY (medical_area_id) REFERENCES medical_area (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medical_area_doctor ADD CONSTRAINT FK_EBB2CD5A87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medical_area DROP FOREIGN KEY FK_84679740C69CE56E');
        $this->addSql('ALTER TABLE medical_area_doctor DROP FOREIGN KEY FK_EBB2CD5AFB0DA052');
        $this->addSql('DROP TABLE area_type');
        $this->addSql('DROP TABLE medical_area');
        $this->addSql('DROP TABLE medical_area_doctor');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
