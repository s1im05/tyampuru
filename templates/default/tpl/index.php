<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$title?></title>
    
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/common.css?016" />
    
    <link href="<?=$path?>/img/favicon.ico" type="image/x-icon" rel="icon" />
    <link href="<?=$path?>/img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    
    <script type="text/javascript" src="<?=$path?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/common.js?016"></script>
    
    <script type="text/javascript" src="//loginza.ru/js/widget.js"></script>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
</head>
<body>
    <header class="b-header clearfix" id="top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 hidden-xs">
                    <? if ($bIsLogged) :?>
                        <div class="media">
                            <div class="media-left">
                                <a href="/home"><img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?$_SESSION['user']['photo']:$path.'/img/user.jpg'?>"></a>
                            </div>
                            <div class="media-body hidden-xs">
                                <h4 class="media-heading"><a class="b-header__link-white" href="/home"><?=htmlspecialchars($_SESSION['user']['nickname'])?></a></h4>
                                <i class="fa fa-sign-out b-header__link"></i>&nbsp;<a class="b-header__link" href="/logout"><?=$this->lang(array('en' => 'logout'),'выйти')?></a>
                            </div>
                        </div>
                    <? else :?>
                        <div class="b-headerform">
                            <a id="sign_in_btn" href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>" class="btn btn-sm btn-primary loginza"><i class="fa fa-sign-in"></i>&nbsp; <?=$this->lang(array('en' => 'login / registration'),'вход / регистрация')?></a>
                        </div>
                    <? endif;?>
                    <p class="visible-xs"></p>
                </div>
                <div class="col-sm-8 col-xs-12 text-right">
                    <? if ($bIsLogged) :?>
                    <div class="pull-left dropdown visible-xs">
                        <a href="/home"><img class="media-object b-avatar" src="<?=$_SESSION['user']['photo']?$_SESSION['user']['photo']:$path.'/img/user.jpg'?>"></a>
                    </div>
                    <? endif;?>
                    <div class="pull-right dropdown visible-xs b-headerform">
                        &nbsp;
                        <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a>
                        <ul class="dropdown-menu">
                            <li role="presentation" <?=isset($sChapter) && ($sChapter==='all')?'class="active"':''?>><a href="/"><?=$this->lang(array('en' => 'All chapters'),'Все разделы')?></a></li>
                            <? foreach ($aChapters as $aVal) :?>
                                <li role="presentation" <?=isset($sChapter) && ($sChapter===$aVal['class'])?'class="active"':''?>><a href="/chapter/<?=$aVal['class']?>"><?=$aVal['title']?></a></li>
                            <? endforeach;?>
                            <li role="separator" class="divider"></li>
                            <li role="presentation"><a href="?lang=<?=$this->lang(array('en' => 'ru'),'en')?>"><?=$this->lang(array('en' => 'Русская версия'),'Switch to EN')?></a></li>
                            <li role="separator" class="divider"></li>
                            <? if ($bIsLogged) :?>
                                <li role="presentation"><a href="/home"><?=$this->lang(array('en' => 'Home Page'),'Личный кабинет')?></a>
                                </li>
                                <li role="presentation"><a href="/logout"><?=$this->lang(array('en' => 'Logout'),'Выйти')?></a>
                                </li>
                            <? else :?>
                                <li role="presentation"><a href="http://loginza.ru/api/widget?token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>" class="loginza"><?=$this->lang(array('en' => 'Login / regisrtation'),'Вход / регистрация')?></a></li>
                            <? endif;?>
                        </ul>
                    </div>
                    <form class="form-inline b-headerform" method="post" action="/search" id="search">
                        <span class="hidden-xs">
                            <?=$this->lang(array('en' => 'example'),'например')?>: <a href="/search/<?=urlencode($sRandomTag)?>" title="<?=$this->lang(array('en' => 'All posts by request'),'Все записи по запросу')?> &laquo;<?=$sRandomTag?>&raquo;" class="b-header__link"><?=$sRandomTag?></a> &nbsp; 
                        </span>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="search_query" placeholder="<?=$this->lang(array('en' => 'Search...'),'поиск')?>"> 
                            <span id="search_btn" class="input-group-addon btn b-search__btn"><?=$this->lang(array('en' => 'search'),'найти')?></span>
                        </div>
                        <a class="btn btn-sm btn-primary hidden-xs" href="?lang=<?=$this->lang(array('en' => 'ru'),'en')?>"><?=$this->lang(array('en' => 'RU'),'EN')?></a>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="b-poster h-shadow">
            <img src="<?=$path?>/img/bg/<?=mt_rand(1,46)?>.jpg" class="b-poster__image" alt="<?=$this->lang(array('en' => 'Tyampuru'), 'Тямпуру')?>" />
            <a class="b-title" title="<?=$this->lang(array('en' => 'Main Page'),'Главная страница')?>" href="/">
                <img class="b-title__img" src="<?=$path?>/img/tyampuru.png" />
            </a>
        </div>
        
        <nav class="b-menu hidden-xs">
            <ul class="nav nav-pills">
                <li role="presentation" <?=isset($sChapter) && ($sChapter==='all')?'class="active"':''?>><a href="/"><?=$this->lang(array('en' => 'All chapters'),'Все разделы')?></a></li>
                <? foreach ($aChapters as $aVal) :?>
                    <li role="presentation" <?=isset($sChapter) && ($sChapter===$aVal['class'])?'class="active"':''?>><a href="/chapter/<?=$aVal['class']?>"><?=$aVal['title']?></a></li>
                <? endforeach;?>
            </ul>
        </nav>
        
        <div class="row">
            <?include $template;?>
            <aside class="b-main col-md-3">
                <div class="b-llist list-group h-shadow">
                    <a href="/rss" class="list-group-item"><i class="fa fa-fw fa-rss-square"></i> <?=$this->lang(array('en' => 'RSS Feed'),'RSS-лента')?></a>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-12">
                        <!-- VK Widget -->
                        <div class="b-post h-shadow b-vk">
                            <div class="b-post__panel">
                                <p class="b-post__title b-post__title-small"><?=$this->lang(array('en' => 'Subscribe on VK.com'),'Подпишись на новости в группе')?></p>
                            </div>
                            <div class="b-post__data">
                                <div id="vk_groups" class="center-block b-vk__widget"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 0, width:"200px", height: "300", color1: 'F3EAD3', color2: '9C5E39', color3: '9C5E39'}, 34237015);
                        </script>
                    </div>
                    <? if ($aCommentsLast) :?>
                    <div class="col-sm-7 col-xs-12 col-md-12">
                        <div class="b-post h-shadow">
                            <div class="b-post__panel">
                                <p class="b-post__title b-post__title-small"><?=$this->lang(array('en' => 'Users last comments'),'Последние комментарии пользователей')?></p>
                            </div>
                            <div class="b-post__data">
                                <? foreach ($aCommentsLast as $aComment) :?>
                                    <p class="b-comment__last">
                                        <span class="text-muted"><?=SSCE\H\date2ru($aComment['cdate'], true)?></span><br />
                                        <strong><?=htmlspecialchars($aComment['nickname'])?></strong> &rarr;
                                        <a href="/post/<?=$aComment['post_id']?>#comment_<?=$aComment['id']?>"><?=$aComment['title']?></a><br />
                                        <?=htmlspecialchars(trim($aComment['text']))?><br />
                                    </p>
                                <? endforeach;?>
                            </div>
                        </div>
                    </div>
                    <? endif;?>
                </div>
            </aside>
        </div>

        <footer class="b-footer">
            <div class="row">
                <div class="col-md-9">
                    <h4><?=$this->lang(array('en' => 'Warning 18+'),'Предупреждение 18+')?></h4>
                    <?=$this->lang(array('en' => 'This site is intended for watch by persons 18 or older, and not by children'),
                    'На сайте могут присутствовать материалы с нецензурной лексикой и частичным обнажением. Если вам меньше 18 лет, просим воздержаться от просмотра сайта.')?>
                </div>
                <div class="col-md-3">
                    <h4><?=$this->lang(array('en' => 'Share with friends'),'Рассказать друзьям')?></h4>

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
                    <p><strong>2014–<?=date('Y')?> &copy;</strong> <?=$this->lang(array('en' => 'Funny comics and comicstrips, photos of beautiful girls, funny gifs, best Coubs, videos, jokes, games, art-pictures and other best stuff from the Internet'),
                    'Смешные комиксы, фотографии красивых девушек, веселые гифки, отборные коубы, приколы, игры и много чего еще самого интересного из сети')?></p>
                </div>
            </div>
        </footer>
    </div>
    <a href="#top" id="gotop" class="btn btn-primary b-gotop hidden">
        <i class="fa fa-arrow-up"></i>
    </a>
    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-26449998-1', 'auto');
        ga('send', 'pageview');
    </script>
</body>
</html>