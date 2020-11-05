<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace nlxGoogleTagManager\Services;

interface TrackingConsentServiceInterface
{
    public const TAG_MANAGER_COOKIE_NAME = 'nlxGoogleTagManager';
    public const ANALYTICS_COOKIE_NAME = 'nlxGoogleAnalytics';

    public function enableTracking(?string $cookiePreferences): bool;
}
