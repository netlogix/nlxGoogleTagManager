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
use sdGoogleTagManager\Services\TrackingConsentServiceInterface;
use Shopware\Bundle\CookieBundle\Services\CookieHandler;

class Frontend implements SubscriberInterface
{
    /** @var Config */
    private $config;

    /** @var TrackingConsentServiceInterface */
    private $trackingConsentService;

    public function __construct(Config $config, TrackingConsentServiceInterface $trackingConsentService)
    {
        $this->config = $config;
        $this->trackingConsentService = $trackingConsentService;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch',
        ];
    }

    public function onFrontendPostDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        $view = $args->getSubject()->View();

        $enableTracking = true;
        if ($this->config->useCookieConsentManager()) {
            $cookiePreferences = $args->getRequest()->getCookie(CookieHandler::PREFERENCES_COOKIE_NAME);
            $enableTracking = $this->trackingConsentService->enableTracking($cookiePreferences);
        }

        $view->assign([
            'sdGoogleTagManagerTrackingActive' => $enableTracking,
            'sdGoogleTagManagerTrackingId' => $this->config->getGoogleTagManagerTrackingId(),
            'sdGoogleTagManagerRemarketingEnabled' => $this->config->isRemarketingEnabled(),
        ]);
    }
}
