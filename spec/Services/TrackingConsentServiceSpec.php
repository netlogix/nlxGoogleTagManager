<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace spec\nlxGoogleTagManager\Services;

use Prophecy\Argument;
use nlxGoogleTagManager\Services\TrackingConsentService;
use nlxGoogleTagManager\Services\TrackingConsentServiceInterface;
use PhpSpec\ObjectBehavior;
use Shopware\Bundle\CookieBundle\Services\CookieHandlerInterface;

class TrackingConsentServiceSpec extends ObjectBehavior
{
    public function let(CookieHandlerInterface $cookieHandler): void
    {
        $this->beConstructedWith($cookieHandler);
    }

    public function it_should_be_initializable(): void
    {
        $this->shouldHaveType(TrackingConsentService::class);
    }

    public function it_implements_the_correct_interface(): void
    {
        $this->shouldImplement(TrackingConsentServiceInterface::class);
    }

    public function it_should_return_false_if_there_are_no_cookie_preferences(CookieHandlerInterface $cookieHandler): void
    {
        $cookieHandler->isCookieAllowedByPreferences(Argument::any(), Argument::any())
            ->shouldNotBeCalled();

        $this->enableTracking(null)
            ->shouldReturn(false);
    }

    public function it_should_return_false_if_the_json_string_cant_be_parsed(CookieHandlerInterface $cookieHandler): void
    {
        $cookieHandler->isCookieAllowedByPreferences(Argument::any(), Argument::any())
            ->shouldNotBeCalled();

        $this->enableTracking('')
            ->shouldReturn(false);
    }

    public function it_should__use_shopwares_cookie_handler_to_check_for_consent_if_there_are_cookie_preferences(
        CookieHandlerInterface $cookieHandler
    ): void {
        $cookieHandler->isCookieAllowedByPreferences(TrackingConsentServiceInterface::TAG_MANAGER_COOKIE_NAME, [])
            ->willReturn(true);

        $this->enableTracking('{}')
            ->shouldReturn(true);
    }
}
