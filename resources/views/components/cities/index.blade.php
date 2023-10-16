@php
/**
 * @var bool $showForm
 * @var string[] $data
 * @var \Illuminate\Database\Eloquent\Collection $cities
*/
@endphp

<x-base>
    <x-slot:title>
        Cities
    </x-slot>
    <div class="post">
        <div class="postheader"></div>
        <div class="postcontent">
            <h2>Список городов</h2>
            @if($showForm)
                <form method="get">
                    <div class="sortform">
                        <div class="pole">
                            <h3>Поле сортировки</h3>
                            <span>
                        <input type="radio" name="orderBy" value="id" @if($data['orderBy'] == 'id') checked @endif>
                        <b>id</b>
                    </span>
                            <span>
                            <input type="radio" name="orderBy" value="name" @if($data['orderBy'] == 'name') checked @endif>
                            <b>Название Города</b>
                        </span>
                            <span>
                            <input type="radio" name="orderBy" value="idx" @if($data['orderBy'] == 'idx') checked @endif>
                            <b>Индекс Сортировки</b>
                        </span>
                        </div>
                        <div class="napr">
                            <h3>Направление сортировки</h3>
                            <span>
                            <input type="radio" name="order" value="ASC" @if($data['order'] == 'ASC') checked @endif>
                            <b>Возрастание</b>
                        </span>
                            <span>
                            <input type="radio" name="order" value="DESC" @if($data['order'] == 'DESC') checked @endif>
                            <b>Убывание</b>
                        </span>
                        </div>
                        <input type="submit" value="Сортировать">
                        <input type="hidden" name="form" value="1">
                    </div>
                </form>
            @else
                <div class="form flrig">
                    <form action="{{ route('create.city') }}" method="get">
                        <input type="submit" value="Добавить">
                    </form>
                    <form action="" method="get">
                        <input type="submit" value="Сортировать">
                        <input type="hidden" name="form" value="1">
                    </form>
                </div>
            @endif
            @foreach($cities as $city)
                <div class='cpsity'>
                    <h3>{{ $city->name }}</h3>
                    <span>
                    <form action="{{ route('delete.city', ['id' => $city->id]) }}" method="POST">
                        @csrf
                        <input type="submit"
                               onclick="return confirm('Вы действительно хотите удалить город?')"
                               value="Удалить">
                    </form>
                    </span>
                    <span>
                        <form action="{{ route('edit.city', ['id' => $city->id]) }}" method="get">
                            <input type="submit" value="Редактировать">
                        </form>
                    </span>
                </div>
            @endforeach
        </div>
    <div class="postbottom"></div>
    </div>
</x-base>
