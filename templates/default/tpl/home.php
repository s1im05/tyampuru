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
                    <h4 class="media-heading"><?=htmlspecialchars($_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'])?> <strong>(<?=htmlspecialchars($_SESSION['user']['nickname'])?>)</strong></h4>
                    <a class="btn btn-primary btn-xs" href="/logout"><i class="fa fa-sign-out"></i>&nbsp; <?=$this->lang(array('en' => 'logout'),'выйти')?></a>
                </div>
            </div>
        </div>
        <div class="b-post__data">
            <ul class="nav nav-pills tabs_js" data-target="tabs_home">
                <li role="presentation" class="active"><a href="#likes"><i class="fa fa-heart"></i>&nbsp; <?=$this->lang(array('en' => 'My Likes'),'Мои лайки')?></a></li>
                <li role="presentation"><a href="#comments"><i class="fa fa-comment"></i>&nbsp; <?=$this->lang(array('en' => 'My Comments'),'Мои комментарии')?></a></li>
                <li role="presentation"><a href="#settings"><i class="fa fa-cog"></i>&nbsp; <?=$this->lang(array('en' => 'Settings'),'Настройки')?></a></li>
            </ul>
        </div>
    </article>

    <div id="tabs_home"> 
        <div id="likes">
            <form method="post" action="/home#likes">
                <div class="btn-group" role="group">
                    <button type="submit" name="view_type" value="thumb" class="btn btn-<?=$sViewType=='thumb'?'primary':'default'?>"><i class="fa fa-th-list"></i>&nbsp; <?=$this->lang(array('en' => 'Thumbs'),'предпросмотр')?></button>
                    <button type="submit" name="view_type" value="list" class="btn btn-<?=$sViewType=='list'?'primary':'default'?>"><i class="fa fa-picture-o"></i>&nbsp; <?=$this->lang(array('en' => 'Full'),'целиком')?></button>
                </div>
            </form>
            <p>&nbsp;</p>
            <button id="btn_like_list" class="btn btn-default b-btn__ajaxpage hidden" data-url="/home/ajax/likelist" data-page="0"><?=$this->lang(array('en' => 'Load posts'),'Загрузить записи')?></button>
        </div>
        
        <div class="hide" id="comments">
            <button id="btn_comment_list" class="btn btn-default b-btn__ajaxpage hidden" data-url="/home/ajax/commentlist" data-page="0"><?=$this->lang(array('en' => 'Load posts'),'Загрузить записи')?></button>
        </div>
        
        <div class="b-post h-shadow hide" id="settings">
            <div class="b-post__panel">
                <p class="b-post__title"><?=$this->lang(array('en' => 'Edit general settings'),'Редактирование основных настроек')?></p>
            </div>
            <div class="b-post__data">
                <form method="post" action="/home" class="form-horizontal">
                    <div class="form-group">
                        <label for="home_form_name" class="col-sm-3 control-label"><?=$this->lang(array('en' => 'Nickname'),'Никнейм')?>:</label>
                        <div class="col-sm-5 col-md-4">
                            <input type="text" name="nickname" maxlength="30" value="<?=htmlspecialchars($_SESSION['user']['nickname'])?>" class="form-control" id="home_form_name" placeholder="<?=$this->lang(array('en' => 'Nickname'),'Никнейм')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="home_form_gender" class="col-sm-3 control-label"><?=$this->lang(array('en' => 'Sex'),'Пол')?>:</label>
                        <div class="col-sm-5 col-md-4">
                            <div class="btn-group btn-radio" role="group" data-target="#inp_gender">
                                <button type="button" title="<?=$this->lang(array('en' => 'Male'),'мужской')?>" data-value="M" class="btn btn-<?=$_SESSION['user']['gender'] == 'M'?'primary':'default'?>"><i class="fa fa-fw fa-male"></i></button>
                                <button type="button" title="<?=$this->lang(array('en' => 'Female'),'женский')?>" data-value="F" class="btn btn-<?=$_SESSION['user']['gender'] == 'F'?'primary':'default'?>"><i class="fa fa-fw fa-female"></i></button>
                                <button type="button" title="<?=$this->lang(array('en' => 'Not set'),'не выбрано')?>" data-value="U" class="btn btn-<?=$_SESSION['user']['gender'] == 'U'?'primary':'default'?>"><i class="fa fa-fw fa-question"></i></button>
                            </div>
                            <input id="inp_gender" type="hidden" name="gender" value="<?=$_SESSION['user']['gender']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5 col-md-4">
                            <button type="submit" name="save" class="btn btn-primary"><?=$this->lang(array('en' => 'Save'),'Сохранить')?></button>
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
    </div>
</main>
<script type="text/javascript">
    (function(w,$,u){
        $(function(){
           $('.tabs_js').find('a[href='+sessionStorage.getItem('lastTab')+']').click();
           $('#btn_like_list, #btn_comment_list').trigger('click');
        });
    })(window, jQuery);
</script>