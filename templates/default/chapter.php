<article class="b-post h-shadow">
    <div class="b-post__panel">
        <h1 class="b-post__title">Page very very long forever and evar title big</h1>
        <div class="clearfix">
            <p class="pull-right">share buttons</p>
            <p class="pull-left text-muted"><a href="#">&laquo;Chapter&raquo;</a> / 15:02, 12 декабря 2015 г.</p>
        </div>
    </div>
    <div class="b-post__data">
        <div class="b-post__imgdiv">
            <div class="b-post__imgbtns">
                <span class="label label-default">1</span>
                <a class="btn btn-default btn-xs"><i class="fa fa-flag"></i> пожаловаться на изображение</a>
            </div>
            <a href="#" class="b-post__imglink"><img src="" class="b-post__img" /></a>
        </div>
        <div class="b-post__imgdiv">
            <div class="b-post__imgbtns">
                <span class="label label-default">2</span>
                <a class="btn btn-default btn-xs"><i class="fa fa-flag"></i> пожаловаться на изображение</a>
            </div>
            <a href="#" class="b-post__imglink"><img src="" class="b-post__img" /></a>
        </div>
    </div>
    <div class="b-post__tags">
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
        <a href="#" class="btn btn-default btn-sm"><i class="fa fa-tag"></i> tag_data1</a>
    </div>
</article>

<nav>
    <ul class="pagination">
        <? if ($iPageActive > 4) :?>
            <li><a href="<?=$sChapter!=='all'?'/chapter/'.$sChapter:''?>/page/1" aria-label="First">1</a></li>
        <?endif;?>
        <? if ($iPageActive > 5) :?>
            <li class="disabled"><a>...</a></li>
        <?endif;?>
        <?for ($i=-3;$i<=3;$i++):?>
            <?if ((($iPageActive+$i) > 0) && (($iPageActive+$i) <= $iPagesCount)):?>
                <?if ($i !== 0):?>
                    <li><a href="<?=$sChapter!=='all'?'/chapter/'.$sChapter:''?>/page/<?=$iPageActive+$i?>"><?=$iPageActive+$i?></a></li>
                <?else:?>
                    <li class="active"><a><?=$iPageActive+$i?></a></li>
                <?endif;?>
            <?endif;?>
        <?endfor;?>
        <? if ($iPageActive < ($iPagesCount-4)) :?>
            <li class="disabled"><a>...</a></li>
        <?endif;?>
        <? if ($iPageActive < ($iPagesCount-3)) :?>
            <li><a href="<?=$sChapter!=='all'?'/chapter/'.$sChapter:''?>/page/<?=$iPagesCount?>" aria-label="Last"><?=$iPagesCount?></a></li>
        <?endif;?>
    </ul>
</nav>