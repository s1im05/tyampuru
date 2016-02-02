<main class="b-main col-md-9">
    <article class="b-post h-shadow">
        <div class="b-post__panel">
            <div class="media">
                <div class="media-left">
                    <a href="/home">
                        <img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?>" alt="<?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']?></h4>
                    <a class="btn btn-primary btn-xs" href="/logout"><i class="fa fa-sign-out"></i>&nbsp; выйти</a>
                </div>
            </div>
        </div>
        <div class="b-post__data">
            <ul class="nav nav-pills tabs_js" data-target="tabs_home">
                <li role="presentation" class="active"><a href="#settings"><i class="fa fa-cog"></i>&nbsp; Настройки</a></li>
                <li role="presentation"><a href="#likes"><i class="fa fa-heart"></i>&nbsp; Мои лайки</a></li>
                <li role="presentation"><a href="#comments"><i class="fa fa-cog"></i>&nbsp; Мои коментарии</a></li>
            </ul>
            <p>&nbsp;</p>
            <div id="tabs_home">
                <div id="settings">
                    
                </div>
                <div id="likes" class="hide">
                    <? if ($aPostList) :?>
                        <? foreach ($aPostList as $aPost) :?>
                            <div class="media">
                                <div class="media-left">
                                    <a href="/post/<?=$aPost['id']?>">
                                        <img class="media-object b-postthumb__small" src="<?=$aPost['thumb']?>" alt="<?=$aPost['title']?>">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="/post/<?=$aPost['id']?>"><?=$aPost['title']?></a></h4>
                                    <p><span class="text-muted"><?=date2ru($aPost['like_date'], true)?></span></p>
                                </div>
                            </div>
                        <? endforeach;?>
                    <? else :?>
                        <p>Вы еще не поставили ни одного "лайка"</p>
                    <? endif;?>
                </div>
                <div id="comments" class="hide">
                    <p>Вы еще не написали ни одного комментария</p>
                </div>
            </div>
        </div>
    </article>
</main>