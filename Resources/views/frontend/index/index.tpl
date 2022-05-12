{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_header"}
    {if $sBasket.content and $nlxGoogleTagManagerTrackingActive}
        {strip}
            <script>
                if (typeof globalBasketProducts == 'undefined') {
                    var globalBasketProducts = [
                        {foreach $sBasket.content as $sBasketItem}
                        {literal}
                        {
                            'item_name': '{/literal}{$sBasketItem.articlename}{literal}',
                            'item_id': '{/literal}{$sBasketItem.ordernumber}{literal}',
                            'price': '{/literal}{$sBasketItem.price}{literal}',
                            'item_brand': '{/literal}{$sBasketItem.additional_details.supplierName}{literal}',
                            'item_category': '{/literal}{$zip}{literal}',
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
    {if $nlxGoogleTagManagerTrackingActive}
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={$nlxGoogleTagManagerTrackingId}" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    {/if}
{/block}
