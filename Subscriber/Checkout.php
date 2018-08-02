<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace sdGoogleTagManager\Subscriber;

use Enlight\Event\SubscriberInterface;

class Checkout implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Checkout' => 'onFrontendPostDispatchSecure',
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

    public function onFrontendPostDispatchSecure(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_View_Default $view */
        $view = $args->get('subject')->View();

        $basket = $view->getAssign('sBasket');

        if ($basket) {
            $view->assign('sdGoogleTagManagerCustomProductValues', $this->getCustomProductValues($basket));
        }
    }

    public function getCustomProductValues($basket)
    {
        $basketContents = $basket['content'];

        $personalizationCake = 0;
        $personalizationCard = 0;
        $personalization = 0;

        foreach ($basketContents as $content) {
            if (empty($content['custom_product_adds'])) {
                // No customized product
                continue;
            }

            foreach ($content['custom_product_adds'] as $option) {
                // Assign 1 if something activated
                if (0 == $personalizationCake) {
                    $personalizationCake = (int) (
                        'HAND_WRITTEN_TEXT' == $option['ordernumber']  ||
                        'HAND_WRITTEN_TEXT_1' == $option['ordernumber']
                    );
                }

                if (0 == $personalizationCard) {
                    $personalizationCard = (int) ('GREETING_CARD' == $option['ordernumber']);
                }
            }

            $personalization = (int) ($personalizationCake || $personalizationCard);
        }

        return [
            'transactionPersonalization' => $personalization,
            'transactionPersonalizationCake' => $personalizationCake,
            'transactionPersonalizationCard' => $personalizationCard,
        ];
    }
}
