<main class="b-main col-md-9">
    <article class="b-post h-shadow">
        <div class="b-post__panel">
            <div class="media">
                <div class="media-left">
                    <a href="/home">
                        <img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?$_SESSION['user']['photo']:$path.'/img/user.jpg'?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?=htmlspecialchars($_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'])?> (<?=htmlspecialchars($_SESSION['user']['nickname'])?>)</h4>
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
                    <button id="btn_like_list" class="btn btn-default b-btn__ajaxpage hidden" data-url="/home/ajax/likelist" data-page="0">Загрузить записи</button>
                </div>
                <div id="comments" class="hide">
                    <button id="btn_comment_list" class="btn btn-default b-btn__ajaxpage hidden" data-url="/home/ajax/commentlist" data-page="0">Загрузить записи</button>
                </div>
                <div id="settings" class="hide">
                    <form method="post" action="/home" class="form-horizontal">
                        <div class="form-group">
                            <label for="home_form_name" class="col-sm-3 control-label">Никнейм:</label>
                            <div class="col-sm-9">
                                <input type="text" name="nickname" value="<?=htmlspecialchars($_SESSION['user']['nickname'])?>" class="form-control" id="home_form_name" placeholder="Никнейм">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="home_form_gender" class="col-sm-3 control-label">Пол:</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="M" <?=$_SESSION['user']['gender'] == 'M'?'checked="checked"':''?>> мужской
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="F" <?=$_SESSION['user']['gender'] == 'F'?'checked="checked"':''?>> женский
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="U" <?=$_SESSION['user']['gender'] == 'U'?'checked="checked"':''?>> не определился
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                                &nbsp;
                                <? if ($sSuccess) :?>
                                    <span class="text-success"><?=$sSuccess?></span>
                                <? endif;?>
                                <? if ($sError) :?>
                                    <span class="text-danger"><?=$sError?></span>
                                <? endif;?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <p>&nbsp;</p>
        </div>
    </article>
</main>
<script type="text/javascript">
    (function(w,$,u){
        $(function(){
           $('.tabs_js').find('a[href='+sessionStorage.getItem('lastTab')+']').click();
           $('#btn_like_list, #btn_comment_list').trigger('click');
        });
    })(window, jQuery);

</script>