{if $sArticle and $nlxGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            'event': "add_to_cart",
            'ecommerce': {
                'currency': "EUR",
                'value': '{/literal}{$sArticle.price}{literal}'
                'items': [{
                    'item_name': "{/literal}{$sArticle.articlename}{literal}",
                    'item_id': "{/literal}{$sArticle.ordernumber}{literal}",
                    'price': "{/literal}{$sArticle.price}{literal}",
                    'item_brand': "{/literal}{$sArticle.additional_details.supplierName}{literal}",
                    'quantity': "{/literal}{$sArticle.quantity}{literal}"
                }]
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
