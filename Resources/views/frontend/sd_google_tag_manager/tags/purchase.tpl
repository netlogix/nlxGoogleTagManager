{if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
    <script>
        dataLayer.push({literal}{
            'ecommerce': {
                'purchase': {
                    'actionField': {
                        'id': "{/literal}{$sOrderNumber}{literal}",
                        'affiliation': "{/literal}{$sShopname}{literal}",
                        'revenue': "{/literal}{$sBasket.sAmount}{literal}",
                        'tax': "{/literal}{$sBasket.sAmountTax}{literal}",
                        'shipping': "{/literal}{$sBasket.sShippingcosts}{literal}"
                    },
                    {/literal}
                    {if $sBasket.content}
                        {literal}
                        'products': [
                            {/literal}
                            {foreach $sBasket.content as $sBasketItem}
                            {literal}
                                {
                                    'name': "{/literal}{$sBasketItem.articlename}{literal}",
                                    'id': "{/literal}{$sBasketItem.ordernumber}{literal}",
                                    'price': "{/literal}{$sBasketItem.price}{literal}",
                                    'brand': "{/literal}{$sBasketItem.additional_details.supplierName}{literal}",
                                    'category': "{/literal}{$zip}{literal}",
                                    'quantity': {/literal}{$sBasketItem.quantity}{literal}
                                },
                            {/literal}
                            {/foreach}
                            {literal}
                        ]
                        {/literal}
                    {/if}
                    {literal}
                }
            }
        }{/literal});
    </script>
{/if}
