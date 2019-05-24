{extends file="parent:frontend/listing/listing_ajax.tpl"}

{block name="frontend_listing_list_inline_ajax"}
    {if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
        {include file="frontend/sd_google_tag_manager/tags/listing.tpl"}
    {/if}

    {$smarty.block.parent}
{/block}
