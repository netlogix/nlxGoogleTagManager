{extends file="parent:frontend/checkout/confirm.tpl"}

{block name='frontend_index_content'}
    {include file="frontend/nlx_google_tag_manager/tags/steps.tpl" step=1}

    {$smarty.block.parent}
{/block}
