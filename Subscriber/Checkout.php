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
    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'Shopware_Controllers_Frontend_Checkout::addArticleAction::after' => 'onAddArticleAfter',
        ];
    }

    /**
     * @return mixed
     */
    public function onAddArticleAfter(\Enlight_Hook_HookArgs $args)
    {
        $controller = $args->getSubject();

        if ($controller->Request()->has('sAddSkip')) {
            Shopware()->Template()->assign('customEvent', 'addToCartSkip');
        }

        return $args->getReturn();
    }
}
