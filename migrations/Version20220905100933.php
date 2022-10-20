<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905100933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    /**
     * Выполнение миграции
     *
     * @param Schema $schema
     *
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `country_sanction` (
            `id` SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT "Идентификатор записи", 
            `name` VARCHAR(150) NOT NULL COMMENT "Название страны, союза, организации", 
            `hash` VARCHAR(32) NOT NULL COMMENT "Хэш для уникальность", 
        	`files_load_id` INT(11) NULL DEFAULT NULL COMMENT "sanctions_list.files_load - id",
            `dt` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "Дата создания записи", 
            `date_update` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT "Дата обновления записи",
            UNIQUE INDEX `hash` (`hash`),
            INDEX `files_load_id` (`files_load_id`),
            INDEX `dt` (`dt`),
            INDEX `date_update` (`date_update`)) 
        COMMENT ="Таблица для хранения данных по директивам"
        DEFAULT CHARACTER SET cp1251 COLLATE `cp1251_general_ci` 
        ENGINE = InnoDB');

        $this->addSql("CREATE TABLE IF NOT EXISTS `sanctions_list`.`directives` (
            `id` SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'Идентификатор записи',
            `name` VARCHAR(255) NOT NULL COMMENT 'Название директивы',
            `description` TEXT NOT NULL COMMENT 'Описание директивы',
            `date_create` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания записи', 
            `date_update` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                COMMENT 'Дата обновления записи',
            UNIQUE INDEX `name` (`name`),
            INDEX `date_create` (`date_create`),
            INDEX `date_update` (`date_update`))
        COMMENT = 'Таблица для хранения данных по директивам'
        DEFAULT CHARACTER SET cp1251
        COLLATE `cp1251_general_ci`
        ENGINE = InnoDB");

        $this->addSql("CREATE TABLE IF NOT EXISTS `sanctions_list`.`orgs` (
            `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
            `name` VARCHAR(500) NULL DEFAULT NULL COMMENT 'Наименование',
            `requisite` CHAR(30) NULL DEFAULT NULL COMMENT 'Реквизиты',
            `status_org` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Статус организации',
            `country_sanction_id` SMALLINT UNSIGNED NULL COMMENT 'sanctions_list.country_sanction.id - идентификатор стран',
            `date_inclusion` DATE NULL DEFAULT NULL COMMENT 'Дата включения',
            `date_exclusion` DATE NULL DEFAULT NULL COMMENT 'Дата исключения',
            `unknown_exdate` SMALLINT NOT NULL DEFAULT 0 COMMENT 'До распоряжения об отмене санкций',
            `directive_id` SMALLINT UNSIGNED NULL COMMENT 'sanctions_list.directive.id - идентификатор директивы',
        	`kartoteka_id` INT(10) NULL DEFAULT NULL COMMENT 'kartoteka_v3_1.organizations - id карточки',
            `files_load_id` INT(11) NULL DEFAULT NULL COMMENT 'sanctions_list.files_load - id',
            `dt` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания записи',
            `date_update` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления записи',
            PRIMARY KEY (`id`),
            UNIQUE INDEX `unique` (`requisite`, `country_sanction_id`, `kartoteka_id`),
        	INDEX `kartoteka_id` (`kartoteka_id`),
            INDEX `date_inclusion` (`date_inclusion`),
            INDEX `date_exclusion` (`date_exclusion`),
            INDEX `requisite` (`requisite`),
        	INDEX `country_sanction_id` (`country_sanction_id`),
        	INDEX `files_load_id` (`files_load_id`),
            INDEX `dt` (`dt`),
            INDEX `date_update` (`date_update`),
            CONSTRAINT fk_orgs_country_id FOREIGN KEY (`country_sanction_id`) REFERENCES `sanctions_list`.`country_sanction` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
            CONSTRAINT fk_orgs_directive_id FOREIGN KEY (`directive_id`) REFERENCES `sanctions_list`.`directives` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
        )
        COMMENT = 'Список ЮЛ и ФЛ, которые находится в санкционных списках'
        DEFAULT CHARACTER SET cp1251
        COLLATE `cp1251_general_ci`
        ENGINE = InnoDB");
    }

    /**
     * Откат миграции
     *
     * @param Schema $schema
     *
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `sanctions_list`.`orgs` DROP FOREIGN KEY fk_orgs_country_id');
        $this->addSql('ALTER TABLE `sanctions_list`.`orgs` DROP FOREIGN KEY fk_orgs_directive_id');
        $this->addSql('DROP TABLE IF EXISTS `sanctions_list`.`country_sanction`');
        $this->addSql('DROP TABLE IF EXISTS `sanctions_list`.`directives`');
        $this->addSql('DROP TABLE IF EXISTS `sanctions_list`.`orgs`');
    }
}
