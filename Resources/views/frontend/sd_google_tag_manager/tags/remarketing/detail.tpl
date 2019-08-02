{if $sArticle and ($sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie)}
    {literal}
        {
            'ecomm_pagetype': 'product',
            'ecomm_pcat': "{/literal}{$sCategoryInfo.name}{literal}",
            'ecomm_prodid': "{/literal}{$sArticle.ordernumber}{literal}",
            'ecomm_pname': "{/literal}{$sArticle.articleName}{literal}",
            'ecomm_pvalue': "{/literal}{$sArticle.price}{literal}",
            'ecomm_totalvalue': "{/literal}{$sArticle.price}{literal}"
        }
    {/literal}
{/if}
