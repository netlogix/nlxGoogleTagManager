{extends file="parent:frontend/checkout/confirm.tpl"}

{block name='frontend_index_content'}
    {include file="frontend/sd_google_tag_manager/tags/steps.tpl" step=4}

    {$smarty.block.parent}
{/block}
