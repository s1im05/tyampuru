    <div class="col-xs-12">
        <h1><?=$title?></h1>
        <p>Найдено записей: <strong><?=sizeof($aPostList)?></strong></p>
    </div>
</div>
<div class="row">
    <main class="b-main col-md-9">
        <? $bPostFull   = false;?>
        <?foreach($aPostList as $aPost):?>
            <?include 'article.php';?>
        <?endforeach;?>
    </main>