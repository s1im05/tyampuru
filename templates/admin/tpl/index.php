<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Панель управления <?=$title?></title>
    
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/common.css?016" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic">
    
    <link href="<?=$path?>/img/favicon.ico" type="image/x-icon" rel="icon" />
    <link href="<?=$path?>/img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    
    <script type="text/javascript" src="<?=$path?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/common.js?016"></script>
</head>
<body class="b-adminbody">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <a href="/adm_pnl_x" class="navbar-brand">Панель управления</a>
            </div>
            <div class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                <ul class="nav navbar-nav">
                    <?/*
                    <li <?=$sMenuActive == 'beer' ? 'class="active"':''?>><a href="/adm_pnl_x/beer">Пиво</a></li>
                    <li <?=$sMenuActive == 'address' ? 'class="active"':''?>><a href="/adm_pnl_x/address">Адреса</a></li>
                    */?>
                    <li class="visible-xs"><a href="/logout">Выйти</a></li>
                </ul>
                <a class="btn btn-md b-btnpadded btn-default pull-right hidden-xs" href="/logout"><i class="fa fa-fw fa-sign-out"></i></a>
            </div>
        </nav>
        
        <? if ($sSuccess) :?>
            <div class="alert alert-success" role="alert"><?=$sSuccess?></div>
        <? endif;?>
        <? if ($sError) :?>
            <div class="alert alert-danger" role="alert"><?=$sError?></div>
        <? endif;?>
        
        <div class="panel">
            <div class="panel-body">
                <? include $template;?>
            </div>
        </div>
    </div>
</body>
</html>