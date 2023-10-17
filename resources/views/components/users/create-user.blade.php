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
            <form action="{{ route('store.user') }}" method="post">
                <div class="form">
                    <h3>Форма Добовления Пользователя</h3>
                    <input type="text" placeholder="Имя" value="{{ old('name') }}">
                    @error('name')
                    <span style="color: #d71414; margin: unset">{{ $message }}</span>
                    @enderror
                    <input type="text" placeholder="Фамилия" value="{{ old('surName') }}">
                    @error('surName')
                    <span style="color: #d71414; margin: unset">{{ $message }}</span>
                    @enderror
                    <span>
                    <select size="1" name="cityId">
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @if(old('cityId') === $city->id) selected @endif>{{ $city->name }}</option>
                        @endforeach
                        <input type="submit" onclick="hhh()" value="Показать">
                    </select>
                    @error('cityId')
                        <span style="color: #d71414; margin: unset">{{ $message }}</span>
                    @enderror
                </span>
                    <p>Выберите файл изображения</p>
{{--                    {{ form_widget(form.media, {'translation_domain': false}) }}--}}
{{--                    {% for error in form.media.vars.errors %}--}}
{{--                    <span style="color: #d71414; margin: unset">{{ error.message }}</span>--}}
{{--                    {% endfor %}--}}
                    <input type="submit" value="Добавить">
                    <a href="{{ route('show.users') }}">Отмена</a>
                </div>
            </form>
        </div>
        <div class="postbottom"></div>
    </div>
</x-base>
