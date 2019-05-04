<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401145759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exchange (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exchange_user (exchange_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BB2DF6DB68AFD1A0 (exchange_id), INDEX IDX_BB2DF6DBA76ED395 (user_id), PRIMARY KEY(exchange_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, description VARCHAR(190) NOT NULL, created DATETIME NOT NULL, url VARCHAR(190) NOT NULL, status VARCHAR(190) NOT NULL, INDEX IDX_BF5476CAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, exchange_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, value NUMERIC(10, 2) NOT NULL, image LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', category LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_D34A04ADA76ED395 (user_id), INDEX IDX_D34A04AD68AFD1A0 (exchange_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nick VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, exchange_count INT NOT NULL, exchange_ok INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exchange_user ADD CONSTRAINT FK_BB2DF6DB68AFD1A0 FOREIGN KEY (exchange_id) REFERENCES exchange (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exchange_user ADD CONSTRAINT FK_BB2DF6DBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD68AFD1A0 FOREIGN KEY (exchange_id) REFERENCES exchange (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exchange_user DROP FOREIGN KEY FK_BB2DF6DB68AFD1A0');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD68AFD1A0');
        $this->addSql('ALTER TABLE exchange_user DROP FOREIGN KEY FK_BB2DF6DBA76ED395');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAA76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA76ED395');
        $this->addSql('DROP TABLE exchange');
        $this->addSql('DROP TABLE exchange_user');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
