<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;
use sdGoogleTagManager\Services\Config;
use sdGoogleTagManager\Services\TrackingConsentService;
use sdGoogleTagManager\Services\TrackingConsentServiceInterface;
use Shopware\Bundle\CookieBundle\CookieCollection;
use Shopware\Bundle\CookieBundle\Structs\CookieGroupStruct;
use Shopware\Bundle\CookieBundle\Structs\CookieStruct;

class CookieCollectionSubscriber implements SubscriberInterface
{
    /** @var Config */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'CookieCollector_Collect_Cookies' => 'addCookies',
        ];
    }

    public function addCookies(): CookieCollection
    {
        $cookies = new CookieCollection();

        if ($this->config->useCookieConsentManager()) {
            $cookies->add(new CookieStruct(
                TrackingConsentServiceInterface::COOKIE_NAME,
                '/' . TrackingConsentService::COOKIE_NAME . '/',
                'Google Tag Manager',
                CookieGroupStruct::STATISTICS
            ));
        }

        return $cookies;
    }
}
