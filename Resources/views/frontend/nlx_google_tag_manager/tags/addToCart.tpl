{if $sArticle and $nlxGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            'event': "addToCart",
            'ecommerce': {
                'currencyCode': "EUR",
                'add': {
                    'products': [{
                        'name': "{/literal}{$sArticle.articlename}{literal}",
                        'id': "{/literal}{$sArticle.ordernumber}{literal}",
                        'price': "{/literal}{$sArticle.price}{literal}",
                        'brand': "{/literal}{$sArticle.additional_details.supplierName}{literal}",
                        'quantity': "{/literal}{$sArticle.quantity}{literal}"
                    }]
                }
            }
        }{/literal});

        {if !$customEvent}
            {$customEvent = 'addToCartDetail'}
        {/if}

        // Custom additional event for listing and detail page
        dataLayer.push({literal}{
            'event': "{/literal}{$customEvent}{literal}"
        }{/literal})
    </script>
{/if}
