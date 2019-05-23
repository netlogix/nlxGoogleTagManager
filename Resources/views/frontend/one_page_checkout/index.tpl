{extends file="parent:frontend/one_page_checkout/index.tpl"}

{* Main content *}
{block name='frontend_index_content'}
    {if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
        {include file="frontend/sd_google_tag_manager/tags/steps.tpl" step=$currentStepNumber}
    {/if}

    {$smarty.block.parent}
{/block}
