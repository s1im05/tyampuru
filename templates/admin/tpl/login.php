<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Авторизация</title>
    
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
        <script src="//loginza.ru/js/widget.js" type="text/javascript"></script>
        <div class="row">
            <div class="loginza_panel">
                <iframe src="//loginza.ru/api/widget?overlay=loginza&token_url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>&lang=ru" class="loginza_frame" scrolling="no" frameborder="no"></iframe>
            </div>
    </div>
</body>
</html>