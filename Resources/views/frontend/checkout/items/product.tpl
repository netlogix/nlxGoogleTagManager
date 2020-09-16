{extends file="parent:frontend/checkout/items/product.tpl"}

{block name='frontend_checkout_cart_item_delete_article_form'}
    {if $nlxGoogleTagManagerTrackingActive}
        <form method="post" action="{url action='deleteArticle' sDelete=$sBasketItem.id sTargetAction=$sTargetAction}"
              data-gtm-removeFromCartClick="true"
              data-gtm-name="{$sBasketItem.articlename|escape}"
              data-gtm-id="{$sBasketItem.id}"
              data-gtm-price="{$sBasketItem.price}"
              data-gtm-brand="{$sBasketItem.supplierName}"
              data-gtm-quantity="{$sBasketItem.quantity}"
        >
            <button type="submit" class="btn is--small column--actions-link"
                    title="{"{s name='CartItemLinkDelete'}{/s}"|escape}">
                <i class="icon--cross"></i>
            </button>
        </form>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
