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
use nlxGoogleTagManager\Services\TrackingConsentServiceInterface;
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

    /**
     *  @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch',
        ];
    }

    public function onFrontendPostDispatch(\Enlight_Controller_ActionEventArgs $args): void
    {
        $view = $args->getSubject()->View();

        $enableTracking = 1;
        if ($this->config->useCookieConsentManager() && false === $this->config->getIsTagManagerTechnicallyRequired()) {
            $cookiePreferences = $args->getRequest()->getCookie(CookieHandler::PREFERENCES_COOKIE_NAME);
            $enableTracking = (int) $this->trackingConsentService->enableTracking($cookiePreferences);
        }

        $view->assign([
            'nlxGoogleTagManagerTrackingActive' => $enableTracking,
            'nlxGoogleTagManagerTrackingId' => $this->config->getGoogleTagManagerTrackingId(),
            'nlxGoogleTagManagerUsercentricsIntegrationEnabled' => $this->config->isUsercentricsIntegrationEnabled(),
            'nlxGoogleAnalyticsMeasurementId' => $this->config->getGoogleAnalyticsMeasurementTrackingId(),
            'nlxGoogleAnalytics4MeasurementId' => $this->config->getGoogleAnalytics4MeasurementTrackingId(),
            'nlxGoogleTagManagerRemarketingEnabled' => $this->config->isRemarketingEnabled(),
            'nlxGoogleTagManagerCookieName' => TrackingConsentServiceInterface::TAG_MANAGER_COOKIE_NAME,
            'nlxGoogleTagManagerAnalyticsCookieName' => TrackingConsentServiceInterface::ANALYTICS_COOKIE_NAME,
        ]);
    }
}
