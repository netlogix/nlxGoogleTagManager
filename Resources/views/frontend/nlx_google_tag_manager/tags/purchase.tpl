{if $nlxGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            'event': 'purchase',
            'ecommerce': {
                'transaction_id': "{/literal}{$sOrderNumber}{literal}",
                'affiliation': "{/literal}{$sShopname}{literal}",
                'value': "{/literal}{$sBasket.sAmount}{literal}",
                'tax': "{/literal}{$sBasket.sAmountTax}{literal}",
                'shipping': "{/literal}{$sBasket.sShippingcosts}{literal}"
                {/literal}
                {if $sBasket.content}
                    {literal}
                    'items': [
                        {/literal}
                        {foreach $sBasket.content as $sBasketItem}
                        {literal}
                            {
                                'item_name': "{/literal}{$sBasketItem.articlename}{literal}",
                                'item_id': "{/literal}{$sBasketItem.ordernumber}{literal}",
                                'price': "{/literal}{$sBasketItem.price}{literal}",
                                'item_brand': "{/literal}{$sBasketItem.additional_details.supplierName}{literal}",
                                'item_category': "{/literal}{$zip}{literal}",
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
        }{/literal});
    </script>
{/if}
