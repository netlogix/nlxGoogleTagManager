<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace sdGoogleTagManager\Services;

use Shopware\Bundle\CookieBundle\Services\CookieHandlerInterface;

class TrackingConsentService implements TrackingConsentServiceInterface
{
    /** @var CookieHandlerInterface */
    protected $cookieHandler;

    public function __construct(CookieHandlerInterface $cookieHandler)
    {
        $this->cookieHandler = $cookieHandler;
    }

    public function enableTracking(?string $cookiePreferences): bool
    {
        if (null === $cookiePreferences) {
            return false;
        }

        $parsedCookiePreferences = \json_decode($cookiePreferences, true);
        if (null === $parsedCookiePreferences) {
            return false;
        }

        return $this->cookieHandler->isCookieAllowedByPreferences(self::COOKIE_NAME, $parsedCookiePreferences);
    }
}
