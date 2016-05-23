<? if ($iPage == 0 && sizeof($aPostList) == 0) :?>
    <p class="panel panel-body h-shadow"><?=$this->lang(array('en' => 'You haven\'t like any post yet'),'Вы еще не поставили ни одного лайка')?></p>
<? else :?>
    <? foreach ($aPostList as $aPost) :?>
        <? include ($sViewType == 'thumb' ? 'like_post_thumb.php' : 'article.php')?>
    <? endforeach;?>
    <? if (!$bAllLoaded) :?>
        <button class="btn btn-default b-btn__ajaxpage form-control" data-url="/home/ajax/likelist" data-page="<?=($iPage+1)?>"><i class="fa fa-refresh"></i>&nbsp; <?=$this->lang(array('en' => 'Load More'),'Загрузить еще')?></button>
    <? endif;?>
<?endif;?>