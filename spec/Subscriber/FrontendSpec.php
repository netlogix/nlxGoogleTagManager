<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace spec\nlxGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;
use nlxGoogleTagManager\Services\TrackingConsentServiceInterface;
use PhpSpec\ObjectBehavior;
use nlxGoogleTagManager\Services\Config;
use nlxGoogleTagManager\Subscriber\Frontend;
use Shopware\Bundle\CookieBundle\Services\CookieHandler;

class FrontendSpec extends ObjectBehavior
{
    public function let(
        Config $config,
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Action $controller,
        \Enlight_Controller_Request_Request $request,
        TrackingConsentServiceInterface $trackingConsentService
    ): void {
        $config->getGoogleTagManagerTrackingId()
            ->willReturn('GTM-123');

        $config->getGoogleAnalytics4MeasurementTrackingId()
            ->willReturn('G-1234');

        $config->isRemarketingEnabled()
            ->willReturn(true);

        $args->getSubject()
            ->willReturn($controller);

        $args->getRequest()
            ->willReturn($request);

        $request->getCookie(CookieHandler::PREFERENCES_COOKIE_NAME)
            ->willReturn('');

        $controller->View()
            ->willReturn($view);

        $this->beConstructedWith($config, $trackingConsentService);
    }

    public function it_should_be_initializable(): void
    {
        $this->shouldHaveType(Frontend::class);
    }

    public function it_should_implement_the_subscriber_interface(): void
    {
        $this->shouldImplement(SubscriberInterface::class);
    }

    public function it_should_assign_the_required_template_vars(
        Config $config,
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(false);

        $view->assign([
            'nlxGoogleTagManagerTrackingActive' => 1,
            'nlxGoogleTagManagerTrackingId' => 'GTM-123',
            'nlxGoogleAnalytics4MeasurementId' => 'G-1234',
            'nlxGoogleTagManagerRemarketingEnabled' => true,
            'nlxGoogleTagManagerAnalyticsCookieName' => TrackingConsentServiceInterface::ANALYTICS_COOKIE_NAME
        ])->shouldBeCalled();

        $this->onFrontendPostDispatch($args);
    }

    public function it_should_not_enable_tracking_if_the_tracking_consent_service_doesnt_allow_it(
        Config $config,
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request,
        TrackingConsentServiceInterface $trackingConsentService
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $config->getIsTagManagerTechnicallyRequired()
            ->willReturn(false);

        $request->getCookie(CookieHandler::PREFERENCES_COOKIE_NAME)
            ->willReturn('');

        $trackingConsentService->enableTracking('')
            ->willReturn(false);

        $view->assign([
            'nlxGoogleTagManagerTrackingActive' => 0,
            'nlxGoogleTagManagerTrackingId' => 'GTM-123',
            'nlxGoogleAnalytics4MeasurementId' => 'G-1234',
            'nlxGoogleTagManagerRemarketingEnabled' => true,
            'nlxGoogleTagManagerAnalyticsCookieName' => TrackingConsentServiceInterface::ANALYTICS_COOKIE_NAME
        ])->shouldBeCalled();

        $this->onFrontendPostDispatch($args);
    }

    public function it_should_not_call_the_tracking_consent_service_if_the_cookie_consent_manager_isnt_used(
        Config $config,
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request,
        TrackingConsentServiceInterface $trackingConsentService
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(false);

        $request->getCookie(CookieHandler::PREFERENCES_COOKIE_NAME)
            ->shouldNotBeCalled();

        $trackingConsentService->enableTracking('')
            ->shouldNotBeCalled();

        $view->assign([
            'nlxGoogleTagManagerTrackingActive' => 1,
            'nlxGoogleTagManagerTrackingId' => 'GTM-123',
            'nlxGoogleAnalytics4MeasurementId' => 'G-1234',
            'nlxGoogleTagManagerRemarketingEnabled' => true,
            'nlxGoogleTagManagerAnalyticsCookieName' => TrackingConsentServiceInterface::ANALYTICS_COOKIE_NAME
        ])->shouldBeCalled();

        $this->onFrontendPostDispatch($args);
    }

    public function it_should_not_call_the_tracking_consent_service_if_the_tag_manager_is_required(
        Config $config,
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request,
        TrackingConsentServiceInterface $trackingConsentService
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $config->getIsTagManagerTechnicallyRequired()
            ->willReturn(true);

        $request->getCookie(CookieHandler::PREFERENCES_COOKIE_NAME)
            ->shouldNotBeCalled();

        $trackingConsentService->enableTracking('')
            ->shouldNotBeCalled();

        $view->assign([
            'nlxGoogleTagManagerTrackingActive' => 1,
            'nlxGoogleTagManagerTrackingId' => 'GTM-123',
            'nlxGoogleAnalytics4MeasurementId' => 'G-1234',
            'nlxGoogleTagManagerRemarketingEnabled' => true,
            'nlxGoogleTagManagerAnalyticsCookieName' => TrackingConsentServiceInterface::ANALYTICS_COOKIE_NAME
        ])->shouldBeCalled();

        $this->onFrontendPostDispatch($args);
    }
}

