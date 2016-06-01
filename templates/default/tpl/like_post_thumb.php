<div class="b-post__data">
    <div class="media b-comment">
        <div class="media-left">
            <a href="/post/<?=$aPost['id']?>">
                <img class="media-object b-postthumb__small" src="<?=$aPost['thumb']?>" alt="<?=$aPost['title']?>">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="/post/<?=$aPost['id']?>"><?=$aPost['title']?></a>,
                <small class="text-muted"><?=$this->lang(array('en' => SSCE\H\date2en($aPost['like_date'], true)),SSCE\H\date2ru($aPost['like_date'], true))?></small>
            </h4>
            <p><a data-id="<?=$aPost['id']?>" class="btn btn-default btn-sm b-likedel"><i class="fa fa-times b-like" title="<?=$this->lang(array('en' => 'Remove from list'),'Убрать из списка')?>"></i> <?=$this->lang(array('en' => 'Remove like'),'убрать лайк')?></a></p>
        </div>
    </div>
</div>