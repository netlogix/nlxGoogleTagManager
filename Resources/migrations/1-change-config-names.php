<?php

namespace nlxGoogleTagManager\Migrations;

use Shopware\Components\Migrations\AbstractPluginMigration;

class Migration1 extends AbstractPluginMigration
{
    public function up($modus): void
    {
        $sql = <<<SQL
UPDATE s_core_config_elements
SET name = 'nlxGoogleTagManagerTrackingId'
WHERE name = 'sdGoogleTagManagerTrackingId';
UPDATE s_core_config_elements
SET name = 'nlxGoogleTagManagerRemarketingEnabled'
WHERE name = 'sdGoogleTagManagerRemarketingEnabled';
UPDATE s_core_config_elements
SET name = 'nlxGoogleTagManagerUseCookieConsentManager'
WHERE name = 'sdGoogleTagManagerUseCookieConsentManager';
UPDATE s_core_config_elements
SET name = 'nlxGoogleTagManagerConsentManagerName'
WHERE name = 'sdGoogleTagManagerConsentManagerName';
SQL;
        $this->addSql($sql);
    }

    public function down(bool $keepUserData): void
    {
        $sql = <<<SQL
UPDATE s_core_config_elements
SET name = 'sdGoogleTagManagerTrackingId'
WHERE name = 'nlxGoogleTagManagerTrackingId';
UPDATE s_core_config_elements
SET name = 'sdGoogleTagManagerRemarketingEnabled'
WHERE name = 'nlxGoogleTagManagerRemarketingEnabled';
UPDATE s_core_config_elements
SET name = 'sdGoogleTagManagerUseCookieConsentManager'
WHERE name = 'nlxGoogleTagManagerUseCookieConsentManager';
UPDATE s_core_config_elements
SET name = 'sdGoogleTagManagerConsentManagerName'
WHERE name = 'nlxGoogleTagManagerConsentManagerName';
SQL;
        $this->addSql($sql);
    }
}
