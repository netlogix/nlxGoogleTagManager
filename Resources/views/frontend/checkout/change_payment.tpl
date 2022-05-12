{extends file="parent:frontend/checkout/change_payment.tpl"}

{block name='frontend_checkout_payment_fieldset_input_radio'}
    {if $submittedStepNumber == 3 and $nlxGoogleTagManagerTrackingActive}
        {* Current selected payment *}
        {if $sUserData.additional.payment.id == $payment_mean.id}
            <script>
                dataLayer.push({literal}{
                    'event': 'add_payment_info',
                    "ecommerce": {
                        'payment_type': '{/literal}{$payment_mean.description}{literal}'
                    }
                }{/literal});
            </script>
        {/if}
    {/if}

    {$smarty.block.parent}
{/block}
