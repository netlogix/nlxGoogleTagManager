{if $sdCookieStrategy >= 1}
    {block name="sd_googletagmanager_tags_enhanced_checkout"}
        {include file="frontend/sd_google_tag_manager/tags/enhanced/default.tpl"}
        {literal}
            'conversionDate': '{/literal}{$smarty.now|date_format:"%d.%m.%Y"}{literal}',
            'conversionValue': {/literal}{if $sAmount}{$sAmount}{else}0{/if}{literal},
            'conversionType': 'Transaction',
            'conversionId': '{/literal}{$sOrderNumber}{literal}',
            'conversionAttributes': '',
            'transactionId': '{/literal}{$sOrderNumber}{literal}',
            'transactionDate': '{/literal}{$smarty.now|date_format:"%d.%m.%Y"}{literal}',
            'transactionType': '{/literal}{$sUserData.additional.payment.description}{literal}',
            'transactionAffiliation': '{/literal}{$sShopname}{literal}',
            'transactionTotal': {/literal}{if $sAmount}{$sAmount}{else}0{/if}{literal},
            'transactionTax': {/literal}{$sAmountTax}{literal},
            'transactionShipping': {/literal}{$sShippingcosts}{literal},
            'transactionPaymentType': '{/literal}{$sUserData.additional.payment.description}{literal}',
            'transactionCurrency': 'EUR',
            'transactionShippingMethod': '{/literal}{$sDispatch.name}{literal}',
            'transactionProducts': [
                {/literal}
                {foreach $sBasket.content as $basketItem}
                {literal}
                    {
                        'id': '{/literal}{$basketItem.id}{literal}',
                        'name': '{/literal}{$basketItem.articlename}{literal}',
                        'sku': '{/literal}{$basketItem.ordernumber}{literal}',
                        'price': '{/literal}{$basketItem.price}{literal}',
                        'quantity': '{/literal}{$basketItem.quantity}{literal}',
                    },
                {/literal}
                {/foreach}
                {literal}
            ],
            'transactionPaymentOption': '{/literal}{$sPayment.description}{literal}',
        {/literal}
    {/block}
{/if}
