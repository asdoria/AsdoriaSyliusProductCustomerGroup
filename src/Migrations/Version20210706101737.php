<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706101737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asdoria_products_customer_groups (product_id INT NOT NULL, customer_group_id INT NOT NULL, INDEX IDX_50F2E1164584665A (product_id), INDEX IDX_50F2E116D2919A68 (customer_group_id), PRIMARY KEY(product_id, customer_group_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asdoria_products_customer_groups ADD CONSTRAINT FK_50F2E1164584665A FOREIGN KEY (product_id) REFERENCES sylius_product (id)');
        $this->addSql('ALTER TABLE asdoria_products_customer_groups ADD CONSTRAINT FK_50F2E116D2919A68 FOREIGN KEY (customer_group_id) REFERENCES sylius_customer_group (id)');
        $this->addSql('DROP TABLE adoria_marketing_cart_image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adoria_marketing_cart_image (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, type VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, path VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_5EB6F5FD7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adoria_marketing_cart_image ADD CONSTRAINT FK_5EB6F5FD7E3C61F9 FOREIGN KEY (owner_id) REFERENCES asdoria_marketing_cart (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE asdoria_products_customer_groups');
    }
}
