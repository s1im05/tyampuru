<? if ($iPage == 0 && sizeof($aPostList) == 0) :?>
    <p>Вы еще не поставили ни одного лайка</p>
<? else :?>
    <? foreach ($aPostList as $aPost) :?>
        <div class="media b-comment">
            <div class="media-left">
                <a href="/post/<?=$aPost['id']?>">
                    <img class="media-object b-postthumb__small" src="<?=$aPost['thumb']?>" alt="<?=$aPost['title']?>">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    <a href="/post/<?=$aPost['id']?>"><?=$aPost['title']?></a>,
                    <small class="text-muted"><?=date2ru($aPost['like_date'], true)?></small>
                </h4>
                <p><a data-id="<?=$aPost['id']?>" class="btn btn-default btn-sm b-likedel"><i class="fa fa-times b-like" title="Убрать из списка"></i> убрать лайк</a></p>
            </div>
        </div>
    <? endforeach;?>
    <? if (!$bAllLoaded) :?>
        <button class="btn btn-default b-btn__ajaxpage" data-url="/home/ajax/likelist" data-page="<?=($iPage+1)?>">Загрузить еще</button>
    <? endif;?>
<?endif;?>