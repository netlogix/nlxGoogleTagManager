{if $nlxGoogleTagManagerTrackingActive}
    {if {controllerName|lower} == 'detail'}
        {include file="frontend/nlx_google_tag_manager/tags/enhanced/detail.tpl"}
    {elseif {controllerName|lower} == 'checkout'}
        {include file="frontend/nlx_google_tag_manager/tags/enhanced/checkout.tpl"}
    {else}
        {include file="frontend/nlx_google_tag_manager/tags/enhanced/default.tpl"}
    {/if}
{/if}
