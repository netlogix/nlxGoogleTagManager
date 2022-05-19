{extends file="parent:frontend/checkout/change_shipping.tpl"}

{block name="frontend_checkout_dispatch_shipping_input_radio"}
    {if $submittedStepNumber == 2 and $nlxGoogleTagManagerTrackingActive}
        {* Current selected Shipping method *}
        {if $sDispatch.id == $dispatch.id}
            <script>
                dataLayer.push({literal}{
                    'event': 'add_shipping_info',
                    "ecommerce": {
                        'shipping_tier': '{/literal}{$dispatch.name}{literal}'
                    }
                }{/literal});
            </script>
        {/if}
    {/if}

    {$smarty.block.parent}
{/block}
