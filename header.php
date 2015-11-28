<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $site_name; ?></title>

    <!-- CSS  -->
    <link href="//cdn.moefont.com/fonts/icon?family=Material+Icons" rel="stylesheet">
    <link href="./asset/materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="./asset/materialize/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="./style-kotori.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="/" class="brand-logo"><?php echo $site_name; ?></a>
        <ul class="right hide-on-med-and-down">
            <li><a class="waves-effect" href="index.php">首页</a></li>
            <li><a class="waves-effect" href="download/index.html">客户端下载</a></li>
            <li><a class="waves-effect" href="code.php">邀请码</a></li>
            <li><a class="waves-effect" href="user">用户中心</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="#">Navbar Link</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>

