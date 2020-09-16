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
    const COOKIE_LABEL = 'Google Tag Manager';

    public function let(Config $config): void
    {
        $config->getConsentManagerName()
            ->willReturn(self::COOKIE_LABEL);

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

    public function it_should_add_the_googleTagManager_cookie_if_the_plugin_uses_the_cookie_consent_manager(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $this->addCookies()
            ->hasCookieWithName(TrackingConsentServiceInterface::COOKIE_NAME)
            ->shouldReturn(true);
    }

    public function it_should_not_add_the_googleTagManager_cookie_if_the_plugin_is_not_using_the_cookie_consent_manager(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(false);

        $this->addCookies()
            ->shouldBeLike(new CookieCollection());
    }

    public function it_should_use_the_default_label_if_not_specified_in_the_plugin_configuration(
        Config $config
    ): void {
        $config->useCookieConsentManager()
            ->willReturn(true);

        $result = $this->addCookies();

        $result->getCookieByName(TrackingConsentService::COOKIE_NAME)
            ->getLabel()
            ->shouldEqual(self::COOKIE_LABEL);
    }

    public function it_should_use_the_users_label_if_specified_in_the_plugin_configuration(
        Config $config
    ): void {
        $consentManagerName = 'Some Other Service';

        $config->useCookieConsentManager()
            ->willReturn(true);

        $config->getConsentManagerName()
            ->willReturn($consentManagerName);

        $result = $this->addCookies();

        $result->getCookieByName(TrackingConsentService::COOKIE_NAME)
            ->getLabel()
            ->shouldEqual($consentManagerName);
    }
}
