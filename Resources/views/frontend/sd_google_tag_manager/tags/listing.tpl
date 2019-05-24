{if $sArticles and ($sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie)}
    <script>
        dataLayer.push({literal}{
            'ecommerce': {
                'currencyCode': 'EUR',
                'impressions': [
                    {/literal}
                    {counter print=false start=$pageArticleCounterStart assign=articlePosition}
                    {foreach $sArticles as $sArticle}
                    {literal}
                    {
                        'name': '{/literal}{$sArticle.articleName}{literal}',
                        'id': '{/literal}{$sArticle.ordernumber}{literal}',
                        'price': '{/literal}{$sArticle.price}{literal}',
                        'brand': '{/literal}{$sArticle.supplierName}{literal}',
                        'list': 'Category',
                        'category': '{/literal}{$sCategoryContent.name}{literal}',
                        'position': {/literal}{$articlePosition}{literal}
                    },
                    {/literal}
                    {counter}
                    {/foreach}
                    {literal}
                ]
            },
            {/literal}{include file="frontend/sd_google_tag_manager/tags/enhanced.tpl"}{literal}
        }{/literal});
    </script>
{/if}
