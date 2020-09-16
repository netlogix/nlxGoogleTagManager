{if $nlxGoogleTagManagerRemarketingEnabled and $nlxGoogleTagManagerTrackingActive}
    <script>
        dataLayer.push({literal}{
            'event': 'remarketingTriggered',
            'google_tag_params': {/literal}
                {if {controllerName|lower} == 'detail'}
                    {include file="frontend/nlx_google_tag_manager/tags/remarketing/detail.tpl"}
                {elseif {controllerName|lower} == 'listing'}
                    {include file="frontend/nlx_google_tag_manager/tags/remarketing/listing.tpl"}
                {elseif {controllerName|lower} == 'checkout' && {controllerAction|lower} != 'finish'}
                    {include file="frontend/nlx_google_tag_manager/tags/remarketing/checkout.tpl"}
                {elseif {controllerName|lower} == 'checkout' && {controllerAction|lower} == 'finish'}
                    {include file="frontend/nlx_google_tag_manager/tags/remarketing/finish.tpl"}
                {else}
                    []
                {/if}
            {literal}
        }{/literal});
    </script>
{/if}
