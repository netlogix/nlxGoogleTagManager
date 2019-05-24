{extends file="parent:frontend/checkout/change_payment.tpl"}

{block name='frontend_checkout_payment_fieldset_input_radio'}
    {if $submittedStepNumber == 3 and ($sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie)}
        {* Current selected payment *}
        {if $sUserData.additional.payment.id == $payment_mean.id}
            <script>
                dataLayer.push({literal}{
                    'event': 'checkoutOption',
                    "ecommerce": {
                        'checkout_option': {
                            'actionField': {
                                'step': 3,
                                'option': '{/literal}{$payment_mean.description}{literal}'
                            }
                        }
                    }
                }{/literal});
            </script>
        {/if}
    {/if}

    {$smarty.block.parent}
{/block}
