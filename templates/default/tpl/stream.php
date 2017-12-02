<article class="b-post h-shadow">
    <div class="b-post__panel">
        <h2 class="b-post__title">
            <a href="https://www.twitch.tv/amasingpaprikatv">Все на стрим!</a>
            <i title="<?=$this->lang(array('en' => 'I like it!'),'Мне нравится!')?>" class="fa fa-heart-o b-like-off"></i>
            <sup class="b-likes__count"><?=rand(100,200)?></sup>
        </h2>
        <div class="clearfix">
            <div class="pull-right hidden-xs">
                <div class="addthis_toolbox addthis_default_style addthis_16x16_style"
                    addthis:url="https://www.twitch.tv/amasingpaprikatv"
                    addthis:title="Все на стрим!">
                    <a class="addthis_button_vk"></a>
                    <a class="addthis_button_odnoklassniki_ru"></a>
                    <a class="addthis_button_mymailru"></a>
                    <a class="addthis_button_facebook"></a>
                    <a class="addthis_button_compact"></a>
                    <a class="addthis_counter addthis_bubble_style"></a>
                </div>
            </div>
            <p class="pull-left text-muted">
                <a href="https://www.twitch.tv/amasingpaprikatv">&laquo;Стримы&raquo;</a> /
                <?=$this->lang(array('en' => 'visited'),'смотрели')?>: <?=rand(1000,2000)?> /
                <?=$this->lang(array('en' => SSCE\H\date2en(date('Y-m-d H:i:s'), true)),SSCE\H\date2ru(date('Y-m-d H:i:s'), true))?>
            </p>
        </div>
    </div>
    <div class="b-post__data">
       <a href="https://www.twitch.tv/amasingpaprikatv" class="b-post-image_text"><img src="/templates/default/img/stream.jpg"></a>
    </div>
      <div class="b-post__tags b-post__footer">
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> стрим</a>
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> твич</a>
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> хартстоун</a>
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> twitch</a>
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> amasingpaprikatv</a>
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> hearthstone</a>
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> игры</a>
        <a href="https://www.twitch.tv/amasingpaprikatv" class="btn btn-default b-tag"><i class="fa fa-tag"></i> трансляции</a>
    </div>
</article>