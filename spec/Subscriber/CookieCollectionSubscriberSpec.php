<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace spec\nlxGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;
use PhpSpec\ObjectBehavior;
use nlxGoogleTagManager\Services\Config;
use nlxGoogleTagManager\Services\TrackingConsentService;
use nlxGoogleTagManager\Services\TrackingConsentServiceInterface;
use nlxGoogleTagManager\Subscriber\CookieCollectionSubscriber;
use Shopware\Bundle\CookieBundle\CookieCollection;

class CookieCollectionSubscriberSpec extends ObjectBehavior
{
    public function let(
        Config $config,
        \Enlight_Components_Snippet_Manager $snippetService,
        \Enlight_Components_Snippet_Namespace $snippets
    ): void {
        $snippetService->getNamespace('frontend/plugins/nlxGoogleTagManager')
            ->willReturn($snippets);

        $snippets->get('GoogleTagManager')
            ->willReturn('GoogleTagManager');

        $snippets->get('GoogleAnalytics')
            ->willReturn('GoogleAnalytics');

        $this->beConstructedWith($config, $snippetService);
    }

    public function it_should_be_initializable(): void
    {
        $this->shouldHaveType(CookieCollectionSubscriber::class);
    }

    public function it_implements_the_subscriber_interface(): void
    {
        $this->shouldImplement(SubscriberInterface::class);
    }

    public function it_should_add_the_googleTagManager_cookie_if_the_plugin_uses_the_cookie_consent_manager(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $config->getIsTagManagerTechnicallyRequired()
            ->willReturn(false);

        $cookies = $this->addCookies();

        $cookies->getCookieByName('nlxGoogleTagManager')
            ->getLabel()
            ->shouldReturn('GoogleTagManager');

        $cookies->hasCookieWithName('nlxGoogleAnalytics')
            ->shouldReturn(false);
    }

    public function it_should_add_the_google_analytics_cookie_if_the_plugin_uses_the_cookie_consent_manager_and_the_tag_manager_is_required(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $config->getIsTagManagerTechnicallyRequired()
            ->willReturn(true);

        $cookies = $this->addCookies();

        $cookies->getCookieByName('nlxGoogleTagManager')
            ->getLabel()
            ->shouldReturn('GoogleTagManager');

        $cookies->getCookieByName('nlxGoogleAnalytics')
            ->getLabel()
            ->shouldReturn('GoogleAnalytics');
    }

    public function it_should_not_add_cookies_if_the_plugin_is_not_using_the_cookie_consent_manager(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(false);

        $this->addCookies()
            ->shouldBeLike(new CookieCollection());
    }
}
