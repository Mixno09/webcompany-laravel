<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        {{ $title ?? 'Webcompany' }}
    </title>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/lavalamp.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrap">
    <div id="topbg"></div>
    <div id="wrap2">
        <div id="topbar">
            <img style="float:left;margin:0 150px 0 20px;height:65px;" src="{{ asset('/images/logo.svg') }}" alt="logo">
            <h1 id="sitename"><a href="#">Тестовое задание</a> <span class="description"></span></h1>
        </div>
        <div id="header">
            <div id="headercontent"></div>
            <div id="topnav">
                <ul class="lavaLampWithImage" id="1">
                    <li class='current'><a href="{{ route('show.cities') }}">Города</a></li>
                    <li><a href="{{ route('show.users') }}">Пользователи</a></li>
                    <li><a href="{{ route('search.user') }}">Поиск</a></li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div id="left">
                <x-counter/>
                {{ $slot }}
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="footer">
        <div class="credit">Webcompany 2023г</div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{ asset('/js/jquery-3.7.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
</html>
