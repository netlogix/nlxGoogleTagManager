{extends file="parent:frontend/checkout/cart.tpl"}

{block name="frontend_index_header_javascript_tracking_gtm"}
    {if $sdCookieStrategy >= 1}
        {include file="frontend/sd_google_tag_manager/tags/steps.tpl" step=0}
    {/if}

    {$smarty.block.parent}
{/block}
