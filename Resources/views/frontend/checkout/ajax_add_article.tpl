{extends file="parent:frontend/checkout/ajax_add_article.tpl"}

{* Block for custom use *}
{block name='checkout_ajax_add_to_cart_event'}
    {include file="frontend/nlx_google_tag_manager/tags/addToCart.tpl"}
{/block}

{block name='checkout_ajax_add_information_image'}
    {include file="frontend/nlx_google_tag_manager/tags/addToCart.tpl"}

    {$smarty.block.parent}
{/block}
