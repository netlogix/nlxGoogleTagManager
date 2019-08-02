{if $sArticle and ($sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie)}
    <script>
        dataLayer.push({literal}{
            'ecommerce': {
                'detail': {
                    'actionField': {
                        'list': "{/literal}{$sCategoryInfo.name}{literal}"
                    },
                    'products': [{
                        'id': "{/literal}{$sArticle.ordernumber}{literal}",
                        'name': "{/literal}{$sArticle.articleName}{literal}",
                        'price': "{/literal}{$sArticle.price}{literal}",
                        'brand': "{/literal}{$sArticle.supplierName}{literal}",
                        'category': "{/literal}{$sCategoryInfo.name}{literal}"
                    }]
                }
            },
            {/literal}{include file="frontend/sd_google_tag_manager/tags/enhanced.tpl"}{literal}
        }{/literal});
    </script>
{/if}
