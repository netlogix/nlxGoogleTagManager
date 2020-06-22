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
use sdGoogleTagManager\Subscriber\Listing;

class ListingSpec extends ObjectBehavior
{
    public function it_should_be_initializable(): void
    {
        $this->shouldHaveType(Listing::class);
    }

    public function it_should_implement_the_subscriber_interface(): void
    {
        $this->shouldImplement(SubscriberInterface::class);
    }

    public function it_should_return_the_correct_article_counter_start()
    {
        $this->getArticleCounterStart(-1,-1)
            ->shouldReturn(1);

        $this->getArticleCounterStart(1, 0)
            ->shouldReturn(1);

        $this->getArticleCounterStart(2, 0)
            ->shouldReturn(1);

        $this->getArticleCounterStart(1, 1)
            ->shouldReturn(1);

        $this->getArticleCounterStart(2, 1)
            ->shouldReturn(2);

        $this->getArticleCounterStart(124, 567)
            ->shouldReturn(69742);
    }
}

