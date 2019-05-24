{if $sdCookieStrategy >= 1 or $sdGoogleTagManagerIgnoreTrackingCookie}
    {if {controllerName|lower} == 'detail'}
        {include file="frontend/sd_google_tag_manager/tags/enhanced/detail.tpl"}
    {elseif {controllerName|lower} == 'checkout'}
        {include file="frontend/sd_google_tag_manager/tags/enhanced/checkout.tpl"}
    {else}
        {include file="frontend/sd_google_tag_manager/tags/enhanced/default.tpl"}
    {/if}
{/if}
