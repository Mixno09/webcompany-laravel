@php
    /**
     * @var \Illuminate\Database\Eloquent\Collection<\App\Models\UserModel> $users
    */
@endphp

<x-base>
    <x-slot:title>
        Search
    </x-slot>
    <form action="{{ route('search.user') }}" method="get">
        <div class="form">
            <h3>Поиск по имени и/или фамилии пользователя</h3>
            <span>
                    <input type="search" name="q" required="" placeholder="Введите запрос">
            </span>
            <input type="submit" value="Поиск">
        </div>
    </form>
    @if(isset($users) && $users->count() > 0)
        @foreach($users as $user)
            <div class="users">
                @if($user->getFirstMedia('avatar') !== null)
                    <img width="100" src="{{ $user->getFirstMedia('avatar')->getUrl() }}" class="image" alt="Фотография">
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
                </div>
            </div>
        @endforeach
    @endif
</x-base>
