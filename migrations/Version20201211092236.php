<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201211092236 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fablab (id INT AUTO_INCREMENT NOT NULL, siret INT NOT NULL, category VARCHAR(255) NOT NULL, adress LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fablab_user (fablab_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_667B26401A53A31F (fablab_id), INDEX IDX_667B2640A76ED395 (user_id), PRIMARY KEY(fablab_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fablab_user ADD CONSTRAINT FK_667B26401A53A31F FOREIGN KEY (fablab_id) REFERENCES fablab (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fablab_user ADD CONSTRAINT FK_667B2640A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fablab_user DROP FOREIGN KEY FK_667B26401A53A31F');
        $this->addSql('DROP TABLE fablab');
        $this->addSql('DROP TABLE fablab_user');
    }
}
