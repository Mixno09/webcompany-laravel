@php
    /**
     * @var \Illuminate\Database\Eloquent\Collection<\App\Models\City> $cities
    */
@endphp
<x-base>
    <x-slot:title>
        Create User
    </x-slot>
    <div class="post">
        <div class="postheader"></div>
        <div class="postcontent">
            <h2>Список Пользователей</h2>
            <!--Сортирвка-->
            <form action="{{ route('store.user') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form">
                    <h3>Форма добавления пользователя</h3>
                    <input type="text" placeholder="Имя" name="name" value="{{ old('name') }}">
                    @error('name')
                    <span style="color: #d71414; margin: 0">{{ $message }}</span>
                    @enderror
                    <input type="text" placeholder="Фамилия" name="surName" value="{{ old('surName') }}">
                    @error('surName')
                    <span style="color: #d71414; margin: 0">{{ $message }}</span>
                    @enderror
                    <span>
                        <select size="1" name="cityId">
                            <option value="">Выберите город</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" @selected((int) old('cityId') == $city->id)>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('cityId')
                            <span style="color: #d71414; margin: 0">{{ $message }}</span>
                        @enderror
                    </span>
                    <p>Выберите файл изображения</p>
                    <input type="file" name="media">
                    @error('media')
                        <span style="color: #d71414; margin: 0">{{ $message }}</span>
                    @enderror
                    <input type="submit" value="Добавить">
                    <a href="{{ route('show.users') }}">Отмена</a>
                </div>
            </form>
        </div>
        <div class="postbottom"></div>
    </div>
</x-base>
