<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Тямпуру &ndash; <?=$title?></title>
    
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/common.css?v=1" />
    
    <link href="<?=$path?>/img/favicon.ico" type="image/x-icon" rel="icon" />
    <link href="<?=$path?>/img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    
    <script type="text/javascript" src="<?=$path?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://loginza.ru/js/widget.js"></script>
</head>
<body>
    <header class="b-header clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-9">
                    <? if ($bIsLogged) :?>
                        <div class="media">
                            <div class="media-left">
                                <a href="/home">
                                    <img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?>">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a class="b-header__link-white" href="/home"><?=$_SESSION['user']['nickname']?></a></h4>
                                <i class="fa fa-sign-out b-header__link"></i>&nbsp;<a class="b-header__link" href="/logout">выйти</a>
                            </div>
                        </div>
                    <? else :?>
                        <a id="sign_in_btn" href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>&lang=ru" class="btn btn-sm btn-primary loginza"><i class="fa fa-sign-in"></i>&nbsp; вход / регистрация</a>
                    <? endif;?>
                    <p class="visible-xs"></p>
                </div>
                <div class="col-xs-3 visible-xs">
                    <div class="pull-right dropdown">
                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a>
                        <ul class="dropdown-menu">
                            <li role="presentation" <?=isset($sChapter) && ($sChapter==='all')?'class="active"':''?>><a href="/">Все разделы</a></li>
                            <? foreach ($aChapters as $aVal) :?>
                                <li role="presentation" <?=isset($sChapter) && ($sChapter===$aVal['class'])?'class="active"':''?>><a href="/chapter/<?=$aVal['class']?>"><?=$aVal['title']?></a></li>
                            <? endforeach;?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-12 text-right">
                    <form class="form-inline" method="post" action="/search" id="search">
                        <div class="form-group">
                            <span class="hidden-xs">
                                например: <a href="/search/<?=urlencode($sRandomTag)?>" title="Все записи по запросу &laquo;<?=$sRandomTag?>&raquo;" class="b-header__link"><?=$sRandomTag?></a> &nbsp; 
                            </span>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="search_query" placeholder="поиск"> 
                                <span id="search_btn" class="input-group-addon btn b-search__btn">найти</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="b-poster h-shadow">
            <img src="<?=$path?>/img/bg/<?=mt_rand(1,46)?>.jpg" class="b-poster__image" alt="Tyampuru" />
            <a class="b-title" title="Тямпуру - главная страница" href="/">
                <img class="b-title__img" src="<?=$path?>/img/tyampuru.png" />
            </a>
        </div>
        
        <nav class="b-menu hidden-xs">
            <ul class="nav nav-pills">
                <li role="presentation" <?=isset($sChapter) && ($sChapter==='all')?'class="active"':''?>><a href="/">Все разделы</a></li>
                <? foreach ($aChapters as $aVal) :?>
                    <li role="presentation" <?=isset($sChapter) && ($sChapter===$aVal['class'])?'class="active"':''?>><a href="/chapter/<?=$aVal['class']?>"><?=$aVal['title']?></a></li>
                <? endforeach;?>
            </ul>
        </nav>
        
        <div class="row">
            <?include $template;?>
            <aside class="b-main col-md-3">
                <div class="list-group h-shadow">
                    <a href="/rss" class="list-group-item"><i class="fa fa-fw fa-rss-square"></i> RSS-лента свежих постов</a>
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

                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dd2496750e0e873"></script>
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                        <a class="addthis_button_vk"></a>
                        <a class="addthis_button_odnoklassniki_ru"></a>
                        <a class="addthis_button_mymailru"></a>
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_compact"></a>
                        <a class="addthis_counter addthis_bubble_style"></a>
                    </div>
                    <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>

                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <p>&nbsp;</p>
                    <p><strong>2012–<?=date('Y')?> &copy;</strong> Смешные комиксы, фотографии красивых девушек, веселые гифки, отборные коубы, приколы, игры и много чего еще самого интересного из сети</p>
                </div>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="<?=$path?>/js/common.js?v=1"></script>
</body>
</html>