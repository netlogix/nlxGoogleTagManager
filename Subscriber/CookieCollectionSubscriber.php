<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace nlxGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;
use nlxGoogleTagManager\Services\Config;
use nlxGoogleTagManager\Services\TrackingConsentService;
use nlxGoogleTagManager\Services\TrackingConsentServiceInterface;
use Shopware\Bundle\CookieBundle\CookieCollection;
use Shopware\Bundle\CookieBundle\Structs\CookieGroupStruct;
use Shopware\Bundle\CookieBundle\Structs\CookieStruct;

class CookieCollectionSubscriber implements SubscriberInterface
{
    /** @var Config */
    private $config;

    /** @var \Enlight_Components_Snippet_Namespace */
    private $snippets;

    public function __construct(Config $config, \Enlight_Components_Snippet_Manager $snippetService)
    {
        $this->config = $config;
        $this->snippets = $snippetService->getNamespace('frontend/plugins/nlxGoogleTagManager');
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
            $isTagManagerRequired = $this->config->getIsTagManagerTechnicallyRequired();

            $cookies->add(new CookieStruct(
                TrackingConsentServiceInterface::TAG_MANAGER_COOKIE_NAME,
                '/' . TrackingConsentService::TAG_MANAGER_COOKIE_NAME . '/',
                $this->snippets->get('GoogleTagManager'),
                $isTagManagerRequired ? CookieGroupStruct::TECHNICAL : CookieGroupStruct::STATISTICS
            ));

            if ($isTagManagerRequired) {
                $cookies->add(new CookieStruct(
                    TrackingConsentServiceInterface::ANALYTICS_COOKIE_NAME,
                    '/' . TrackingConsentServiceInterface::ANALYTICS_COOKIE_NAME . '/',
                    $this->snippets->get('GoogleAnalytics'),
                    CookieGroupStruct::STATISTICS
                ));
            }
        }

        return $cookies;
    }
}
