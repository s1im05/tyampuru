<? $bPostFull   = false;?>
<?foreach($aFound['data'] as $aPost):?>
    <?include 'article.php';?>
<?endforeach;?>

<? if (!$bAllLoaded) :?>
    <button id="btn_do_search" class="btn btn-default b-btn__ajaxpage form-control" data-url="/search_<?=($bByTag?'tag_':'')?>ajax/<?=urlencode($sQuery)?>" data-page="<?=$iPage+1?>"><i class="fa fa-refresh"></i>&nbsp; Загрузить еще</button>
<? endif;?>