<article class="b-post h-shadow" id="post_<?=$aPost['id']?>">
    <div class="b-post__panel">
        <? if ($bPostFull) :?>
            <h1 class="b-post__title">
                <?=$this->lang(array('en' => $aPost['title_en']),$aPost['title'])?>
                <i title="<?=$this->lang(array('en' => 'I like it!'),'Мне нравится!')?>" data-id="<?=$aPost['id']?>" class="fa <?=$aPost['like_state']?'fa-heart':'fa-heart-o'?> b-like b-like-<?=$bIsLogged?'on':'off'?>"></i>
                <? if ($aPost['likes'] > 0) :?>
                    <sup class="b-likes__count"><?=$aPost['likes']?></sup>
                <? endif; ?>
            </h1>
        <? else :?>
            <h2 class="b-post__title">
                <a href="/post/<?=$aPost['id']?>"><?=$this->lang(array('en' => $aPost['title_en']),$aPost['title'])?></a>
                <i title="<?=$this->lang(array('en' => 'I like it!'),'Мне нравится!')?>" data-id="<?=$aPost['id']?>" class="fa <?=$aPost['like_state']?'fa-heart':'fa-heart-o'?> b-like b-like-<?=$bIsLogged?'on':'off'?>"></i>
                <? if ($aPost['likes'] > 0) :?>
                    <sup class="b-likes__count"><?=$aPost['likes']?></sup>
                <? endif; ?>
            </h2>
        <? endif; ?>
        <div class="clearfix">
            <div class="pull-right hidden-xs">
                <div class="addthis_toolbox addthis_default_style addthis_16x16_style"
                    addthis:url="http://<?=$_SERVER['HTTP_HOST']?>/post/<?=$aPost['id']?>"
                    addthis:title="<?=$this->lang(array('en' => $aPost['title_en']),$aPost['title'])?>">
                    <a class="addthis_button_vk"></a>
                    <a class="addthis_button_odnoklassniki_ru"></a>
                    <a class="addthis_button_mymailru"></a>
                    <a class="addthis_button_facebook"></a>
                    <a class="addthis_button_compact"></a>
                    <a class="addthis_counter addthis_bubble_style"></a>
                </div>
            </div>
            <p class="pull-left text-muted">
                <a href="/chapter/<?=$aPost['chapter_name']?>">&laquo;<?=$this->lang(array('en' => $aPost['chapter_title_en']),$aPost['chapter_title'])?>&raquo;</a> /
                <?=$this->lang(array('en' => 'visited'),'смотрели')?>: <?=$aPost['views']?> /
                <?=$this->lang(array('en' => SSCE\H\date2en($aPost['cdate'], true)),SSCE\H\date2ru($aPost['cdate'], true))?>
            </p>
        </div>
    </div>
    <div class="b-post__data">
        <?=$bPostFull ? $aPost['text'] : $aPost['announce']?>
    </div>
    
    <?if ($aPost['last_comment_text']):?>
        <div class="b-post__data b-post__lastcomment">
            <div class="media b-comment" id="comment_<?=$aPost['last_comment_id']?>">
                <div class="media-left">
                    <img class="media-object b-avatar" src="<?=$aPost['last_comment_photo']?$aPost['last_comment_photo']:$path.'/img/user.jpg'?>">
                </div>
                <div class="media-body">
                    <p class="media-heading"><strong><?=htmlspecialchars($aPost['last_comment_nickname'])?></strong>, 
                        <span class="text-muted"><?=$this->lang(array('en' => SSCE\H\date2en($aPost['last_comment_cdate'], true)),SSCE\H\date2ru($aPost['last_comment_cdate'], true))?>
                        <?=$this->lang(array('en' => 'posted'),'написал'.(($aPost['last_comment_gender']=='U')?'(а)':($aPost['last_comment_gender']=='F'?'а':'')))?>:</span>
                    </p>
                    <div class="b-comment__text">
                        <?=nl2br(htmlspecialchars($aPost['last_comment_text']));?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>
    
    <? if (!$bPostFull) :?>
        <div class="b-post__data b-post__lastcomment">
            <? $iImgCnt = \SSCE\H\getImageCount($aPost['title'])?>
            <?if ($iImgCnt) :?>
                <a href="/post/<?=$aPost['id']?>" class="btn btn-primary"><?=$this->lang(array('en' => 'Images in post'),'Изображений в записи')?>: <?=$iImgCnt?></a>
            <?endif;?>
        
            <?if ($bIsLogged) :?>
                <button class="btn btn-default b-comment__login"><i class="fa fa-comment-o"></i>&nbsp; <?=$aPost['last_comment_text']?$this->lang(array('en' => 'Answer'),'Ответить'):$this->lang(array('en' => 'Post comment'),'Комментировать')?></button>
                <div class="media b-commentform hidden">
                    <div class="media-left">
                        <a href="/home">
                            <img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?$_SESSION['user']['photo']:$path.'/img/user.jpg'?>">
                        </a>
                    </div>
                    <div class="media-body">
                        <form action="/post/<?=$aPost['id']?>" method="post">
                            <div class="form-group b-commentform__group">
                                <textarea class="form-control b-commentform__div" name="comment" rows="5" placeholder="<?=$this->lang(array('en' => 'Comment text'),'Текст комментария')?>"></textarea>
                                <button type="submit" class="btn btn-primary"><?=$this->lang(array('en' => 'Send'),'Отправить')?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?else:?>
                <button class="btn btn-default b-comment__logout"><i class="fa fa-comment-o"></i>&nbsp; <?=$aPost['last_comment_text']?$this->lang(array('en' => 'Answer'),'Ответить'):$this->lang(array('en' => 'Post comment'),'Комментировать')?></button>
                <? if ($this->isLang('en')) :?>
                    <p class="hidden">You have to <a href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'#post_'.$aPost['id'])?>" class="loginza">login</a> first to post your comment</p>
                <? else :?>
                    <p class="hidden">Необходимо <a href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'#post_'.$aPost['id'])?>" class="loginza">авторизоваться</a>, чтобы оставить свой комментарий</p>
                <? endif;?>
            <?endif;?>
        </div>
    <?endif;?>
    
    
    <?if ($aPost['tags']):?>
        <div class="b-post__tags b-post__footer">
            <?$aTags    = explode("\n", $this->lang(array('en' => $aPost['tags_en']),$aPost['tags']));?>
            <?foreach($aTags as $sTag):?>
                <a href="/tag/<?=urlencode(trim($sTag))?>" class="btn btn-default b-tag"><i class="fa fa-tag"></i> <?=$sTag?></a>
            <?endforeach;?>
        </div>
    <?endif;?>
</article>