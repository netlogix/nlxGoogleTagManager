{if $nlxGoogleTagManagerTrackingActive}
    <script>
        {if $step === 0}
            {assign 'eventName' 'view_cart'}
            dataLayer.push({literal}{
                'event': 'view_cart',
                'ecommerce': {
                    'currency': 'EUR',
                    'items': window.globalBasketProducts
                },
                {/literal}{include file="frontend/nlx_google_tag_manager/tags/enhanced.tpl"}{literal}
            }{/literal});
        {elseif $step === 1}
            {assign 'eventName' 'begin_checkout'}
            dataLayer.push({literal}{
                'event': 'begin_checkout',
                'ecommerce': {
                    'currency': 'EUR',
                    'items': window.globalBasketProducts
                },
                {/literal}{include file="frontend/nlx_google_tag_manager/tags/enhanced.tpl"}{literal}
            }{/literal});
        {/if}
    </script>
{/if}
