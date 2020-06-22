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
use Prophecy\Argument;
use sdGoogleTagManager\Subscriber\Listing;

class ListingSpec extends ObjectBehavior
{
    public function let(
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_Controller_Action $controller,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request
    ): void {
        $args->getSubject()
            ->willReturn($controller);

        $controller->View()
            ->willReturn($view);

        $controller->Request()
            ->willReturn($request);
    }

    public function it_should_be_initializable(): void
    {
        $this->shouldHaveType(Listing::class);
    }

    public function it_should_implement_the_subscriber_interface(): void
    {
        $this->shouldImplement(SubscriberInterface::class);
    }

    public function it_should_return_the_correct_article_counter_start(): void
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

    public function it_assigns_correct_value_on_post_dispatch_frontend_listing(
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view
    ): void {
        $view->getAssign('sPage')
            ->willReturn(3);
        $view->getAssign('sPerPage')
            ->willReturn(2);

        $view->assign([
            'pageArticleCounterStart' => 5,
        ])
            ->shouldBeCalled();

        $this->onPostDispatchFrontendListing($args);
    }

    public function it_assigns_correct_value_on_post_dispatch_frontend_listing_without_correct_page_data(
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view
    ): void {
        $view->getAssign('sPage')
            ->willReturn(null);
        $view->getAssign('sPerPage')
            ->willReturn(null);

        $view->assign([
            'pageArticleCounterStart' => 1,
        ])
            ->shouldBeCalled();

        $this->onPostDispatchFrontendListing($args);
    }

    public function it_assigns_correct_value_on_post_dispatch_widget_listing(
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request
    ): void {
        $request->getActionName()
            ->willReturn('ajaxListing');

        $view->getAssign('pageIndex')
            ->willReturn(5);
        $view->getAssign('sArticles')
            ->willReturn([
                'article1',
                'article2',
                'article3',
                'article4'
            ]);

        $view->assign([
            'pageArticleCounterStart' => 17,
        ])
            ->shouldBeCalled();

        $this->onPostDispatchWidgetListing($args);
    }

    public function it_assigns_correct_value_on_post_dispatch_widget_listing_without_correct_page_data(
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request
    ): void {
        $request->getActionName()
            ->willReturn('ajaxListing');

        $view->getAssign('pageIndex')
            ->willReturn(null);
        $view->getAssign('sArticles')
            ->willReturn(null);

        $view->assign([
            'pageArticleCounterStart' => 1,
        ])
            ->shouldBeCalled();

        $this->onPostDispatchWidgetListing($args);
    }

    public function it_returns_nothing_on_post_dispatch_widget_listing_if_it_is_not_ajax_listing(
        \Enlight_Controller_ActionEventArgs $args,
        \Enlight_View_Default $view,
        \Enlight_Controller_Request_Request $request
    ): void {
        $request->getActionName()
            ->willReturn('notAjaxListing');

        $view->getAssign('pageIndex')
            ->shouldNotBeCalled();
        $view->getAssign('sArticles')
            ->shouldNotBeCalled();

        $view->assign(Argument::any())
            ->shouldNotBeCalled();

        $this->onPostDispatchWidgetListing($args)
            ->shouldReturn(null);
    }
}

