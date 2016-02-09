    <div class="col-xs-12">
        <h1><?=$title?></h1>
    </div>
</div>
<div class="row">
    <main class="b-main col-md-9">
        <button id="btn_do_search" class="btn btn-default b-btn__ajaxpage hidden" data-url="/search_<?=($bByTag?'tag_':'')?>ajax/<?=urlencode($sQuery)?>" data-page="0">Загрузить записи</button>
        <script type="text/javascript">
            $(function(){
                $('#btn_do_search').trigger('click');
            });
        </script>
    </main>