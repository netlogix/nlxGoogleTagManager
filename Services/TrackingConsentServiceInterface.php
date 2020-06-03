<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace sdGoogleTagManager\Services;

interface TrackingConsentServiceInterface
{
    public const COOKIE_NAME = 'sdGoogleTagManager';

    public function enableTracking(?string $cookiePreferences): bool;
}
