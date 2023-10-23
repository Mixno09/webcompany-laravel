@php
    /** @var array<? string> $values */
    $currentRouteName = request()->route()->getName();
    $total = array_key_exists('total', $values) ? $values['total'] : 1;
    $count = array_key_exists($currentRouteName, $values) ? $values[$currentRouteName] : 1;
@endphp

<div class="post">
    <div class="postheader"></div>
    <div class="postcontent">
        <h2>Общее количество загрузок страницы {{ $total }} <b></b></h2>
    </div>
    <div class="postbottom">
        <h3 style=" margin-left: 25px; ">Вы посещали эту страницу<b>{{ $count }}</b> раз</h3>
    </div>
</div>
