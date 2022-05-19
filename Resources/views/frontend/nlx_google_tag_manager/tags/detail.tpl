{if $sArticle and $nlxGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            'ecommerce': {
                'View_item': {
                    'items': [{
                        'item_id': "{/literal}{$sArticle.ordernumber}{literal}",
                        'item_name': "{/literal}{$sArticle.articleName}{literal}",
                        'price': "{/literal}{$sArticle.price}{literal}",
                        'item_brand': "{/literal}{$sArticle.supplierName}{literal}",
                        'item_category': "{/literal}{$sCategoryInfo.name}{literal}"
                    }]
                }
            },
            {/literal}{include file="frontend/nlx_google_tag_manager/tags/enhanced.tpl"}{literal}
        }{/literal});
    </script>
{/if}
