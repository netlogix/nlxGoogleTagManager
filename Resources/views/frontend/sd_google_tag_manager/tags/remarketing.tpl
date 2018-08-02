{if $sdGoogleTagManagerRemarketingEnabled and $sdCookieStrategy >= 1}
    <script>
        dataLayer.push({literal}{
            'event': 'remarketingTriggered',
            'google_tag_params': {/literal}
                {if {controllerName|lower} == 'detail'}
                    {include file="frontend/sd_google_tag_manager/tags/remarketing/detail.tpl"}
                {elseif {controllerName|lower} == 'listing'}
                    {include file="frontend/sd_google_tag_manager/tags/remarketing/listing.tpl"}
                {elseif {controllerName|lower} == 'checkout' && {controllerAction|lower} != 'finish'}
                    {include file="frontend/sd_google_tag_manager/tags/remarketing/checkout.tpl"}
                {elseif {controllerName|lower} == 'checkout' && {controllerAction|lower} == 'finish'}
                    {include file="frontend/sd_google_tag_manager/tags/remarketing/finish.tpl"}
                {/if}
            {literal}
        }{/literal});
    </script>
{/if}
