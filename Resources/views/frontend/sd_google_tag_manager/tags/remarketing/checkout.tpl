{if $sBasket.content and ($sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie)}
    {literal}
        {
            'ecomm_pagetype': 'cart',
            'ecomm_prodid': [
                {/literal}
                    {foreach $sBasket.content as $basketItem}
                {literal}
                    '{/literal}{$basketItem.ordernumber}{literal}',
                {/literal}
                    {/foreach}
                {literal}
            ],
            'ecomm_pname': [
                {/literal}
                    {foreach $sBasket.content as $basketItem}
                {literal}
                    '{/literal}{$basketItem.articlename}{literal}',
                {/literal}
                    {/foreach}
                {literal}
            ],
            'ecomm_pvalue': [
                {/literal}
                    {foreach $sBasket.content as $basketItem}
                {literal}
                    '{/literal}{$basketItem.price}{literal}',
                {/literal}
                    {/foreach}
                {literal}
            ],
            'ecomm_totalvalue': '{/literal}{$sBasket.AmountNumeric}{literal}'
        }
    {/literal}
{/if}
