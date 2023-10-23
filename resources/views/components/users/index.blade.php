@php
    /**
     * @var \Illuminate\Database\Eloquent\Collection<\App\Models\City> $cities
     * @var \Illuminate\Database\Eloquent\Collection<\App\Models\UserModel> $users
    */
@endphp

<x-base>
    <x-slot:title>
        Users
    </x-slot:title>
    <div class="post">
        <div class="postheader"></div>
        <div class="postcontent">
            <h2>Список Пользователей</h2>
            <h3><a href="#down">Вниз</a></h3>
            <!--Сортирвка-->
            @if($showForm)
                <div class="sortform">
                    <div class="pole">
                        <h3>Поле сортировки</h3>
                        <span>
                                <input type="radio" name="orderBy" value="id" @checked($data['orderBy'] === 'id') form="formSort">
                                <b>id</b>
                            </span>
                        <span>
                                <input type="radio" name="orderBy" value="name" @checked($data['orderBy'] === 'name') form="formSort">
                                <b>Имя</b>
                            </span>
                        <span>
                                <input type="radio" name="orderBy" value="surName" @checked($data['orderBy'] === 'surName') form="formSort">
                                <b>Фамилия</b>
                            </span>
                    </div>
                    <div class="napr">
                        <h3>Направление сортировки</h3>
                        <span>
                                <input type="radio" name="order" value="ASC" @checked($data['order'] === 'ASC') form="formSort">
                                <b>Возрастание</b>
                            </span>
                        <span>
                                <input type="radio" name="order" value="DESC" @checked($data['order'] === 'DESC') form="formSort">
                                <b>Убывание</b>
                            </span>
                    </div>
                    <input type="submit" value="Сортировать" form="formSort">
                    <input type="hidden" name="form" value="1" form="formSort">
                    <a href="{{ route('show.users') }}">Отмена</a>
                </div>
            @else
                <div style="display:inline-block">
                    <form action="{{ route('create.user') }}" method="get">
                        <input type="submit" value="Добавить">
                    </form>
                    <button type="submit" name="form" value="1" form="formSort">Сортировать</button>
                </div>
            @endif
            <!--Создадим выпадающий список "Города"-->
            <div class="filter">
                <h3>Фильтр по Городам</h3>
                <form id="formSort" method="get">
                    <select size="1" name="cityId">
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @selected($data['cityId'] === $city->id)>{{ $city->name }}</option>
                        @endforeach
                        <input type="submit" onclick="hhh()" value="Показать">
                    </select>
                </form>
            </div>

            @foreach($users as $user)
                <div class="users">
                    @if($user->getFirstMedia('avatar') !== null)
                        <img width="100" src="{{ $user->getFirstMedia('avatar')->getUrl('preview') }}" class="image" alt="Фотография">
                    @else
                        <img width="100" src="{{ asset('/images/placeholder.png') }}" class="image" alt="Фотография">
                    @endif
                    <div class="userdan">
                        <h4>{{ $user->name }} {{ $user->surName }}</h4>
                        @if($user->city === null)
                            <p>Без города</p>
                        @else
                            <p>Город: {{ $user->city->name }}</p>
                        @endif
                        <form action="{{ route('delete.user', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <input type="submit" value="Удалить" onclick="return confirm('Вы действительно хотите удалить пользователя?')">
                        </form>

                    <form action="{{ route('edit.user', ['id' => $user->id]) }}" method="get">
                        <input type="submit" value="Редактировать">
                    </form>
                    </div>
                </div>
            @endforeach

        <h3><a href="#top">Наверх</a></h3>
    </div>
    <div class="postbottom"></div>
    <div id="down"></div>
</div>
</x-base>
