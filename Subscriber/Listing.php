<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;

class Listing implements SubscriberInterface
{
    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Frontend_Listing' => 'onPostDispatchFrontendListing',
            'Enlight_Controller_Action_PostDispatch_Widgets_Listing' => 'onPostDispatchWidgetListing',
        ];
    }

    public function onPostDispatchFrontendListing(\Enlight_Controller_ActionEventArgs $args): void
    {
        $controller = $args->getSubject();

        $view = $controller->View();

        $pageIndex = $view->getAssign('sPage');
        $articlesCount = $view->getAssign('sPerPage');

        $view->assign([
            'pageArticleCounterStart' => $this->getArticleCounterStart($pageIndex, $articlesCount),
        ]);
    }

    public function onPostDispatchWidgetListing(\Enlight_Controller_ActionEventArgs $args): void
    {
        $controller = $args->getSubject();
        $request = $controller->Request();

        if ('ajaxListing' !== $request->getActionName()) {
            return;
        }

        $view = $controller->View();

        $articles = $view->getAssign('sArticles');

        $pageIndex = (int) $view->getAssign('pageIndex');
        $articlesCount = \count($articles);

        $view->assign([
            'pageArticleCounterStart' => $this->getArticleCounterStart($pageIndex, $articlesCount),
        ]);
    }

    public function getArticleCounterStart(int $index, int $count): int
    {
        if ($index <= 1) {
            return 1;
        }

        return (($index - 1) * $count) + 1;
    }
}
