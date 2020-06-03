<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace spec\sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;
use PhpSpec\ObjectBehavior;
use sdGoogleTagManager\Services\Config;
use sdGoogleTagManager\Services\TrackingConsentServiceInterface;
use sdGoogleTagManager\Subscriber\CookieCollectionSubscriber;
use Shopware\Bundle\CookieBundle\CookieCollection;

class CookieCollectionSubscriberSpec extends ObjectBehavior
{
    public function let(Config $config): void
    {
        $this->beConstructedWith($config);
    }

    public function it_should_be_initializable(): void
    {
        $this->shouldHaveType(CookieCollectionSubscriber::class);
    }

    public function it_implements_the_subscriber_interface(): void
    {
        $this->shouldImplement(SubscriberInterface::class);
    }

    public function it_should_add_the_facebookTrackingPixel_cookie_if_the_plugin_uses_the_cookie_consent_manager(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $this->addCookies()
            ->hasCookieWithName(TrackingConsentServiceInterface::COOKIE_NAME)
            ->shouldReturn(true);
    }

    public function it_should_not_add_the_facebookTrackingPixel_cookie_if_the_plugin_is_not_using_the_cookie_consent_manager(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(false);

        $this->addCookies()
            ->shouldBeLike(new CookieCollection());
    }
}
