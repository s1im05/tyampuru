<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$title?></title>
    
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/common.css" />
    
    <script type="text/javascript" src="<?=$path?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="b-header clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <a href="#" class="btn btn-sm btn-default hidden-xs"><i class="fa fa-power-off"></i> вход / регистрация</a>
                </div>
                <div class="col-sm-9 text-right">
                    <form class="form-inline" method="post" action="/search" id="search">
                        <div class="form-group">
                            например: <a href="/search/sample search">sample search</a>
                            &nbsp; <input type="text" class="form-control input-sm" id="search_query" placeholder="поиск"> 
                        </div>
                        <a href="#" class="btn btn-sm btn-default pull-left visible-xs"><i class="fa fa-power-off"></i> вход / регистрация</a>
                        <button type="submit" class="btn btn-default btn-sm">найти</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="b-poster h-shadow">
            <a class="b-title" href="/">Tyampuru</a>
        </div>
        
        <nav>
            <ul class="b-menu nav nav-pills">
                <li role="presentation" <?=$sChapterActive=='all'?'class="active"':''?>><a href="/">Все разделы</a></li>
                <? foreach ($aChapters as $aVal) :?>
                    <li role="presentation" <?=$sChapterActive==$aVal['class']?'class="active"':''?>><a href="/chapter/<?=$aVal['class']?>"><?=$aVal['title']?></a></li>
                <? endforeach;?>
            </ul>
        </nav>
        
        <nav>
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="row">
            <main class="b-main col-md-9">
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
                
                <?include $template;?>
                
                <nav>
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </main>
            <aside class="b-main col-md-3">
                <div class="list-group h-shadow">
                    <a class="list-group-item"><i class="fa fa-rss-square"></i> &nbsp;Cras justo odio</a>
                    <a class="list-group-item">Dapibus ac facilisis in</a>
                    <a class="list-group-item">Morbi leo risus</a>
                    <a class="list-group-item">Porta ac consectetur ac</a>
                    <a class="list-group-item">Vestibulum at eros</a>
                </div>
            </aside>
        </div>
        


        <footer class="b-footer">
            <div class="row">
                <div class="col-md-9">
                    <h4>Предупреждение 18+</h4>
                    На сайте могут присутствовать материалы с нецензурной лексикой и частичным обнажением. Если вам меньше 18 лет, просим воздержаться от просмотра сайта.
                </div>
                <div class="col-md-3">
                    <h4>Рассказать друзьям</h4>
                    вава
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <p>&nbsp;</p>
                    <p><strong>2012–2015 &copy;</strong> Смешные комиксы, фотографии красивых девушек, веселые гифки, отборные коубы, приколы, игры и много чего еще самого интересного из сети</p>
                </div>
            </div>
        </footer>
    </div>
    
    <script type="text/javascript">
        $(function(){
            $('#search').on('submit', function(e){
                if ($('#search_query').val() === '') {
                    e.preventDefault();
                } else if ($('#search_query').val().length < 3) {
                    e.preventDefault();
                } else {
                    $(this).attr('action', '/search/'+$('#search_query').val());
                }
            });
            
        });
    </script>
</body>
</html>