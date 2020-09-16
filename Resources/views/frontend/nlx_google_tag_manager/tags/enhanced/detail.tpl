{if $nlxGoogleTagManagerTrackingActive}
    {include file="frontend/nlx_google_tag_manager/tags/enhanced/default.tpl"}
    {literal}
        'productID': "{/literal}{$sArticle.articleID}{literal}",
        'productEAN': "{/literal}{$sArticle.ean}{literal}",
        'productSku': "{/literal}{$sArticle.ordernumber}{literal}",
        'productName': "{/literal}{$sArticle.articleName}{literal}",
        'productPrice': "{/literal}{$sArticle.price}{literal}",
        'productCategory': "{/literal}{$sCategoryInfo.name}{literal}",
        'productCurrency': 'EUR',
        //'productColor': '',
        //'productRealColor': '',
        'productWeight': "{/literal}{$sArticle.weight}{literal}",
    {/literal}
{/if}
