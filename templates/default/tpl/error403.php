<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$this->lang(array('en' => 'Error 403'),'Ошибка 403')?></title>
    
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$path?>/css/common.css" />
    
    <script type="text/javascript" src="<?=$path?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$path?>/js/bootstrap.min.js"></script>
</head>
<body class="b-errorbody">
    <div class="container">
        <div class="col-sm-3 col-xs-1"></div>
        <div class="col-sm-6 col-xs-10 text-center">
            <div class="panel">
                <h1 class="text-danger"><i class="fa fa-exclamation-circle"></i> <?=$this->lang(array('en' => 'Error 403'),'Ошибка 403')?></h1>
                <p><?=$this->lang(array('en' => 'You do not have access to this page'),'У вас нет доступа к этой странице')?></p>
                <p><a href="/" class="btn btn-primary"><?=$this->lang(array('en' => 'Main page'),'на главную')?></a></p>
            </div>
        </div>
        <div class="col-sm-3 col-xs-1"></div>
    </div>
</body>
</html>