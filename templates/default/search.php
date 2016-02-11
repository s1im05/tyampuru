    <div class="col-xs-12">
        <h1><?=$title?></h1>
        <p>Всего записей: <strong><?=$aFound['total']?></strong></p>
    </div>
</div>
<div class="row">
    <main class="b-main col-md-9">
        <? if ($aFound['total'] > 0) :?>
            <? include 'search_list.php';?>
        <? endif;?>
    </main>