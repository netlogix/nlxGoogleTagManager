<?php

namespace nlxGoogleTagManager\Migrations;

use Shopware\Components\Migrations\AbstractPluginMigration;

class Migration2 extends AbstractPluginMigration
{
    public function up($modus): void
    {
        $sql = <<<SQL
UPDATE s_core_config_forms
SET name = 'nlxGoogleTagManager'
WHERE name = 'sdGoogleTagManager';
SQL;
        $this->addSql($sql);
    }

    public function down(bool $keepUserData): void
    {
        $sql = <<<SQL
UPDATE s_core_config_forms
SET name = 'sdGoogleTagManager'
WHERE name = 'nlxGoogleTagManager';
SQL;
        $this->addSql($sql);
    }
}
