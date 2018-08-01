{extends file="parent:frontend/checkout/ajax_add_article.tpl"}

{block name='checkout_ajax_add_information_image'}
    {if $sdCookieStrategy >= 1}
        {include file="frontend/sd_google_tag_manager/tags/addToCart.tpl"}
    {/if}

    {$smarty.block.parent}
{/block}
