{extends file="parent:frontend/checkout/change_shipping.tpl"}

{block name="frontend_checkout_dispatch_shipping_input_radio"}
    {if $submittedStepNumber == 2 and $sdGoogleTagManagerTrackingActive}
        {* Current selected Shipping method *}
        {if $sDispatch.id == $dispatch.id}
            <script>
                dataLayer.push({literal}{
                    'event': 'checkoutOption',
                    "ecommerce": {
                        'checkout_option': {
                            'actionField': {
                                'step': 2,
                                'option': '{/literal}{$dispatch.name}{literal}'
                            }
                        }
                    }
                }{/literal});
            </script>
        {/if}
    {/if}

    {$smarty.block.parent}
{/block}
