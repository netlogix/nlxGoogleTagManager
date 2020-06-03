<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace spec\sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;
use sdGoogleTagManager\Services\TrackingConsentServiceInterface;
use PhpSpec\ObjectBehavior;
use sdGoogleTagManager\Services\Config;
use sdGoogleTagManager\Subscriber\Frontend;
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
            'sdGoogleTagManagerTrackingActive' => true,
            'sdGoogleTagManagerTrackingId' => 'GTM-123',
            'sdGoogleTagManagerRemarketingEnabled' => true,
        ])->shouldBeCalled();

        $this->onFrontendPostDispatch($args);
    }

    public function it_should_not_enable_tracking_if_the_traking_consent_service_doesnt_allow_it(
        Config $config,
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request,
        TrackingConsentServiceInterface $trackingConsentService
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $request->getCookie(CookieHandler::PREFERENCES_COOKIE_NAME)
            ->willReturn('');

        $trackingConsentService->enableTracking('')
            ->willReturn(false);

        $view->assign([
            'sdGoogleTagManagerTrackingActive' => false,
            'sdGoogleTagManagerTrackingId' => 'GTM-123',
            'sdGoogleTagManagerRemarketingEnabled' => true,
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
            'sdGoogleTagManagerTrackingActive' => true,
            'sdGoogleTagManagerTrackingId' => 'GTM-123',
            'sdGoogleTagManagerRemarketingEnabled' => true,
        ])->shouldBeCalled();

        $this->onFrontendPostDispatch($args);
    }
}
