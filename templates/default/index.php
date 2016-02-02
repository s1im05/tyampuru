<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Тямпуру &ndash; <?=$title?></title>
    
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/common.css" />
    
    <script type="text/javascript" src="<?=$path?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://loginza.ru/js/widget.js"></script>
</head>
<body>
    <header class="b-header clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <? if (isset($_SESSION['user'])) :?>
                        <div class="media">
                            <div class="media-left">
                                <a href="/user/<?=$_SESSION['user']['id']?>">
                                    <img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?>" alt="<?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']?>">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a class="b-header__link-white" href="/user/<?=$_SESSION['user']['id']?>"><?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']?></a></h4>
                                <i class="fa fa-sign-out b-header__link"></i>&nbsp;<a class="b-header__link" href="/logout">выйти</a>
                            </div>
                        </div>
                    <? else :?>
                        <a id="sign_in_btn" href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>&lang=ru" class="btn btn-sm btn-primary hidden-xs loginza"><i class="fa fa-sign-in"></i>&nbsp; вход / регистрация</a>
                    <? endif;?>
                </div>
                <div class="col-sm-8 text-right">
                    <form class="form-inline" method="post" action="/search" id="search">
                        <div class="form-group">
                            например: <a href="/search/<?=urlencode($sRandomTag)?>" title="Все записи по запросу &laquo;<?=$sRandomTag?>&raquo;" class="b-header__link"><?=$sRandomTag?></a>
                            &nbsp; 
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="search_query" placeholder="поиск"> 
                                <span id="search_btn" class="input-group-addon btn b-search__btn">найти</span>
                            </div>
                        </div>
                        <? if (!isset($_SESSION['user'])) :?>
                            <a href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>&lang=ru" class="btn btn-sm btn-primary pull-left visible-xs loginza"><i class="fa fa-sign-in"></i>&nbsp; вход / регистрация</a>
                        <? endif;?>
                        
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
        
        <nav>
            <ul class="b-menu nav nav-pills">
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
                    <p><strong>2012–2015 &copy;</strong> Смешные комиксы, фотографии красивых девушек, веселые гифки, отборные коубы, приколы, игры и много чего еще самого интересного из сети</p>
                </div>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="<?=$path?>/js/common.js"></script>
</body>
</html>