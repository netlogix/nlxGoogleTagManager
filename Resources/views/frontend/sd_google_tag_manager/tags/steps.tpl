{if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
    <script>
        dataLayer.push({literal}{
            'event': 'checkout',
            'ecommerce': {
                'checkout': {
                    'actionField': {
                        'step': "{/literal}{$step}{literal}"
                    },
                    'currencyCode': 'EUR',
                    'products': window.globalBasketProducts
                }
            },
            {/literal}{include file="frontend/sd_google_tag_manager/tags/enhanced.tpl"}{literal}
        }{/literal});
    </script>
{/if}
