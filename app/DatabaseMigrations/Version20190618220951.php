<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190618220951 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE province_recipe DROP FOREIGN KEY FK_9FFF83D659D8A214');
        $this->addSql('ALTER TABLE province_recipe DROP FOREIGN KEY FK_9FFF83D6E946114A');
        $this->addSql('ALTER TABLE province_recipe ADD CONSTRAINT FK_9FFF83D659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE province_recipe ADD CONSTRAINT FK_9FFF83D6E946114A FOREIGN KEY (province_id) REFERENCES province (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE province_recipe DROP FOREIGN KEY FK_9FFF83D6E946114A');
        $this->addSql('ALTER TABLE province_recipe DROP FOREIGN KEY FK_9FFF83D659D8A214');
        $this->addSql('ALTER TABLE province_recipe ADD CONSTRAINT FK_9FFF83D6E946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE province_recipe ADD CONSTRAINT FK_9FFF83D659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
    }
}
