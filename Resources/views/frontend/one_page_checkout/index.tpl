{extends file="parent:frontend/one_page_checkout/index.tpl"}

{* Main content *}
{block name='frontend_index_content'}
    {include file="frontend/sd_google_tag_manager/tags/steps.tpl" step=$currentStepNumber}

    {$smarty.block.parent}
{/block}
