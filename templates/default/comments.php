<section class="b-post h-shadow">
    <div class="b-post__panel">
        <h4 class="b-post__title">Комментарии</h4>
    </div>
    <div class="b-post__data">
        <p>Комментариев пока нет, будьте первым!</p>
    </div>
    <?if ($aPost['tags']):?>
    <div class="b-post__tags">
        <? if ($bIsLogged) :?>
            <div class="media b-commentform">
                <div class="media-left">
                    <a href="/home">
                        <img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?>" alt="<?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']?>">
                    </a>
                </div>
                <div class="media-body">
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                        <div class="form-group b-commentform__group">
                            <textarea class="form-control b-commentform__div" name="comment" rows="5" placeholder="Текст коментария"></textarea>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                            &nbsp;
                            <p id="comment_error" class="help-block h-inline"></p>
                        </div>
                    </form>
                </div>
            </div>
        <? else :?>
            <p>Необходимо <a href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>&lang=ru" class="loginza">авторизоваться</a>, чтобы оставить свой комментарий</p>
        <? endif;?>
    </div>
    <?endif;?>
</section>