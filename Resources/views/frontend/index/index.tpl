{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_header"}
    {if $sBasket.content and $sdCookieStrategy >= 1}
        {strip}
            <script>
                if (typeof globalBasketProducts == 'undefined') {
                    var globalBasketProducts = [
                        {foreach $sBasket.content as $sBasketItem}
                        {literal}
                        {
                            'name': '{/literal}{$sBasketItem.articlename}{literal}',
                            'id': '{/literal}{$sBasketItem.ordernumber}{literal}',
                            'price': '{/literal}{$sBasketItem.price}{literal}',
                            'brand': '{/literal}{$sBasketItem.additional_details.supplierName}{literal}',
                            'category': '{/literal}{$zip}{literal}',
                            'quantity': {/literal}{$sBasketItem.quantity}{literal}
                        },
                        {/literal}
                        {/foreach}
                    ];
                }
            </script>
        {/strip}
    {/if}

    {$smarty.block.parent}
{/block}

{block name='frontend_index_after_body'}
    {if $sdCookieStrategy >= 1}
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={$sdGoogleTagManagerTrackingId}" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    {/if}
{/block}
