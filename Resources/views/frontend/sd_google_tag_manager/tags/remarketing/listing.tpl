{if $sArticles and ($sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie)}
    {literal}
        {
            'ecomm_pagetype': 'category',
            'ecomm_pcat': [
                "{/literal}{$sCategoryInfo.name}{literal}"
            ],
            'ecomm_prodid': [
                {/literal}
                    {foreach $sArticles as $sArticle}
                {literal}
                    "{/literal}{$sArticle.ordernumber}{literal}",
                {/literal}
                    {/foreach}
                {literal}
            ],
            'ecomm_pname': '',
            'ecomm_pvalue': '',
            'ecomm_totalvalue': ''
        }
    {/literal}
{/if}
