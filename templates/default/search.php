    <div class="col-xs-12">
        <h1><?=$title?></h1>
        <p>Всего записей: <strong><?=$aFound['total']?></strong></p>
    </div>
</div>
<div class="row">
    <? if ($aFound['total'] > 0) :?>
        <main class="b-main col-md-9">
            <? include 'search_list.php';?>
        </main>
    <? endif;?>