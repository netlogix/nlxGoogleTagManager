{if $sArticles and $nlxGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            'ecommerce': {
                'currency': 'EUR',
                'item_list_name': '{/literal}{$sCategoryContent.name}{literal}',
                'view_item_list': [
                    {/literal}
                    {counter print=false start=$pageArticleCounterStart assign=articlePosition}
                    {foreach $sArticles as $sArticle}
                    {literal}
                    {
                        'item_name': "{/literal}{$sArticle.articleName}{literal}",
                        'item_id': "{/literal}{$sArticle.ordernumber}{literal}",
                        'price': "{/literal}{$sArticle.price}{literal}",
                        'item_brand': "{/literal}{$sArticle.supplierName}{literal}",
                        'position': {/literal}{$articlePosition}{literal}
                    },
                    {/literal}
                    {counter}
                    {/foreach}
                    {literal}
                ]
            },
            {/literal}{include file="frontend/nlx_google_tag_manager/tags/enhanced.tpl"}{literal}
        }{/literal});
    </script>
{/if}
