<? if ($iPage == 0 && sizeof($aCommentList) == 0) :?>
    <p class="panel panel-body h-shadow"><?=$this->lang(array('en' => 'You haven\'t post any comments yet'),'Вы еще не написали ни одного комментария')?></p>
<? else :?>
    <? foreach ($aCommentList as $aComment) :?>
        <div class="b-post__data">
            <div class="media b-comment">
                <div class="media-left">
                    <a href="/post/<?=$aComment['post_id']?>#comment_<?=$aComment['id']?>"><img class="media-object b-postthumb__small" src="<?=$aComment['thumb']?>" alt="<?=$aComment['title']?>"></a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="/post/<?=$aComment['post_id']?>#comment_<?=$aComment['id']?>"><?=$aComment['title']?></a>,
                        <small class="text-muted"><?=SSCE\H\date2ru($aComment['cdate'], true)?></small>
                    </h4>
                    <div class="b-comment__text">
                        <?=nl2br(htmlspecialchars($aComment['text']));?>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach;?>
    <? if (!$bAllLoaded) :?>
        <button class="btn btn-default b-btn__ajaxpage form-control" data-url="/home/ajax/commentlist" data-page="<?=($iPage+1)?>"><i class="fa fa-refresh"></i>&nbsp; <?=$this->lang(array('en' => 'Load More'),'Загрузить еще')?></button>
    <? endif;?>
<?endif;?>