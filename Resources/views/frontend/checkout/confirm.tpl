{extends file="parent:frontend/checkout/confirm.tpl"}

{block name='frontend_index_content'}
    {if $sdCookieStrategy >= 1}
        {include file="frontend/sd_google_tag_manager/tags/steps.tpl" step=4}
    {/if}

    {$smarty.block.parent}
{/block}
