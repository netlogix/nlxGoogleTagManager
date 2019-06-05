<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright solutionDrive GmbH
 */

namespace sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;
use sdGoogleTagManager\Services\Config;

class Frontend implements SubscriberInterface
{
    /** @var Config */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch',
        ];
    }

    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        $controller = $args->get('subject');
        $view = $controller->View();

        $cookieStrategy = (int) Shopware()->Front()->Request()->getCookie('cookieStrategy', 0);
        $ignoreCookieStrategy = $this->config->ignoreTrackingCookie();

        $viewParameters = [];
        $viewParameters['sdCookieStrategy'] = $cookieStrategy;
        $viewParameters['sdGoogleTagManagerIgnoreTrackingCookie'] = $ignoreCookieStrategy;
        if (true === $ignoreCookieStrategy || $cookieStrategy >= 1) {
            $viewParameters['sdGoogleTagManagerTrackingId'] = $this->config->getGoogleTagManagerTrackingId();
            $viewParameters['sdGoogleTagManagerRemarketingEnabled'] = $this->config->isRemarketingEnabled();
        }

        $view->assign($viewParameters);
    }
}
