<article class="b-post h-shadow">
    <div class="b-post__panel">
        <? if ($bPostFull) :?>
            <h1 class="b-post__title"><?=$aPost['title']?></h1>
        <? else :?>
            <h2 class="b-post__title"><a href="/post/<?=$aPost['id']?>"><?=$aPost['title']?></a></h2>
        <? endif; ?>
        <div class="clearfix">
            <div class="pull-right">
                <div class="addthis_toolbox addthis_default_style addthis_16x16_style"
                    addthis:url="http://<?=$_SERVER['HTTP_HOST']?>/post/<?=$aPost['id']?>"
                    addthis:title="<?=$aPost['title']?>">
                    <a class="addthis_button_vk"></a>
                    <a class="addthis_button_odnoklassniki_ru"></a>
                    <a class="addthis_button_mymailru"></a>
                    <a class="addthis_button_facebook"></a>
                    <a class="addthis_button_compact"></a>
                    <a class="addthis_counter addthis_bubble_style"></a>
                </div>
            </div>
            <p class="pull-left text-muted">
                <a href="/chapter/<?=$aPost['chapter_name']?>">&laquo;<?=$aPost['chapter_title']?>&raquo;</a> / 
                <?=date2ru($aPost['cdate'], true)?>
            </p>
        </div>
    </div>
    <div class="b-post__data">
        <?=$bPostFull ? $aPost['text'] : $aPost['announce']?>
        <?/*
        <div class="b-post__imgdiv">
            <div class="b-post__imgbtns">
                <span class="label label-default">1</span>
                <a class="btn btn-default btn-xs"><i class="fa fa-flag"></i> пожаловаться на изображение</a>
            </div>
            <a href="#" class="b-post__imglink"><img src="" class="b-post__img" /></a>
        </div>
        */?>
    </div>
    <?if ($aPost['tags']):?>
    <div class="b-post__tags">
        <?$aTags    = explode("\n", $aPost['tags']);?>
        <?foreach($aTags as $sTag):?>
            <a href="/tag/<?=urlencode($sTag)?>" class="btn btn-default b-tag"><i class="fa fa-tag"></i> <?=$sTag?></a>
        <?endforeach;?>
    </div>
    <?endif;?>
</article>