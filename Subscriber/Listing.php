<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;

class Listing implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Frontend_Listing' => 'onPostDispatchFrontendListing',
            'Enlight_Controller_Action_PostDispatch_Widgets_Listing' => 'onPostDispatchWidgetListing',
        ];
    }

    /**
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function onPostDispatchFrontendListing(\Enlight_Controller_ActionEventArgs $args)
    {
        $controller = $args->getSubject();

        $view = $controller->View();

        $pageIndex = $view->getAssign('sPage');
        $articlesCount = $view->getAssign('sPerPage');

        $view->assign([
            'pageArticleCounterStart' => $this->getArticleCounterStart($pageIndex, $articlesCount),
        ]);
    }

    /**
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function onPostDispatchWidgetListing(\Enlight_Controller_ActionEventArgs $args)
    {
        $controller = $args->getSubject();
        $request = $controller->Request();

        if ('ajaxListing' !== $request->getActionName()) {
            return;
        }

        $view = $controller->View();

        $articles = $view->getAssign('sArticles');

        $pageIndex = (int) $view->getAssign('pageIndex');
        $articlesCount = count($articles);

        $view->assign([
            'pageArticleCounterStart' => $this->getArticleCounterStart($pageIndex, $articlesCount),
        ]);
    }

    /**
     * @param $index
     * @param $count
     *
     * @return int
     */
    public function getArticleCounterStart($index, $count)
    {
        if ($index <= 1) {
            return 1;
        }

        return (($index - 1) * $count) + 1;
    }
}
