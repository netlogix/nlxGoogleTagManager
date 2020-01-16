<?php
declare(strict_types=1);

/*
 * Created by netlogix GmbH & Co. KG
 *
 * @copyright netlogix GmbH & Co. KG
 */

namespace sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;

class Checkout implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Controllers_Frontend_Checkout::addArticleAction::after' => 'onAddArticleAfter',
        ];
    }

    public function onAddArticleAfter(\Enlight_Hook_HookArgs $args)
    {
        $controller = $args->getSubject();

        if ($controller->Request()->has('sAddSkip')) {
            Shopware()->Template()->assign('customEvent', 'addToCartSkip');
        }

        return $args->getReturn();
    }
}
