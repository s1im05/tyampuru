<main class="b-main col-md-9">
    <article class="b-post h-shadow">
        <div class="b-post__panel">
            <div class="media">
                <div class="media-left">
                    <a href="/home">
                        <img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']?> (<?=$_SESSION['user']['nickname']?>)</h4>
                    <a class="btn btn-primary btn-xs" href="/logout"><i class="fa fa-sign-out"></i>&nbsp; выйти</a>
                </div>
            </div>
        </div>
        <div class="b-post__data">
            <ul class="nav nav-pills tabs_js" data-target="tabs_home">
                <li role="presentation" class="active"><a href="#likes"><i class="fa fa-heart"></i>&nbsp; Мои лайки</a></li>
                <li role="presentation"><a href="#comments"><i class="fa fa-comment"></i>&nbsp; Мои коментарии</a></li>
                <li role="presentation"><a href="#settings"><i class="fa fa-cog"></i>&nbsp; Настройки</a></li>
            </ul>
            <p>&nbsp;</p>
            <div id="tabs_home">
                <div id="likes">
                    <? if ($aPostList) :?>
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
                    <? else :?>
                        <p>Вы еще не поставили ни одного "лайка"</p>
                    <? endif;?>
                </div>
                <div id="comments" class="hide">
                    <? if ($aCommentList) :?>
                        <? foreach ($aCommentList as $aComment) :?>
                            <div class="media b-comment">
                                <div class="media-left">
                                    <a href="/post/<?=$aComment['post_id']?>#comment_<?=$aComment['id']?>"><img class="media-object b-postthumb__small" src="<?=$aComment['thumb']?>" alt="<?=$aComment['title']?>"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/post/<?=$aComment['post_id']?>#comment_<?=$aComment['id']?>"><?=$aComment['title']?></a>,
                                        <small class="text-muted"><?=date2ru($aComment['cdate'], true)?></small>
                                    </h4>
                                    <div class="b-comment__text">
                                        <?=nl2br(htmlspecialchars($aComment['text']));?>
                                    </div>
                                </div>
                            </div>
                        <? endforeach;?>
                    <? else :?>
                        <p>Вы еще не написали ни одного комментария</p>
                    <? endif;?>
                </div>
                <div id="settings" class="hide">
                    <form method="post" action="/home">
                    </form>
                </div>
            </div>
            <p>&nbsp;</p>
        </div>
    </article>
</main>
<script type="text/javascript">
    $(function(){
       $('.tabs_js').find('a[href='+sessionStorage.getItem('lastTab')+']').click();
    });
</script>