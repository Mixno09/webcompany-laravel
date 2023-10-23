@php
    /**
     * @var \App\Models\UserModel $user
    */
@endphp
<x-base>
    <x-slot:title>
        Edit User
    </x-slot>
    <div class="post">
        <div class="postheader"> </div>
        <div class="postcontent">
            <h2>Список Пользователей</h2>
            <!--Сортирвка-->
            <form action="{{ route('store.edit.user') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form">
                    <h3>Форма Редактирования Пользователя</h3>
                    @php
                        $name = old('name');
                        $name = old('name') ? $name : $user->name;
                    @endphp
                    <input type="text" name="name" value="{{ $name }}">
                    @error('name')
                        <span style="color: #d71414; margin: 0">{{ $message }}</span>
                    @enderror
                    @php
                        $surName = old('surName');
                        $surName = old('surName') ? $surName : $user->surName;
                    @endphp
                    <input type="text" name="surName" value="{{ $surName }}">
                    @error('surName')
                        <span style="color: #d71414; margin: 0">{{ $message }}</span>
                    @enderror
                    <span>
                        @php
                            $cityId = $user->city ? $user->city->id : '';
                            $cityName = $user->city ? $user->city->name : 'Выберите город';
                        @endphp
                        <select size="1" name="cityId">
                            <option value="{{ $cityId }}">{{ $cityName }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" @selected((int) old('cityId') == $city->id)>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('cityId')
                            <span style="color: #d71414; margin: 0">{{ $message }}</span>
                        @enderror
                    </span>
                    <p>Выберите файл изображения</p>
                    @if($user->getFirstMedia('avatar') !== null)
                        <img width="100" src="{{ $user->getFirstMedia('avatar')->getUrl('preview') }}" class="image" alt="Фотография">
                    @else
                        <img width="100" src="{{ asset('/images/placeholder.png') }}" class="image" alt="Фотография">
                    @endif
                    <input type="file" name="media">
                    @error('media')
                        <span style="color: #d71414; margin: 0">{{ $message }}</span>
                    @enderror
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="submit" value="Редактировать">
                    <a href="{{ route('show.users') }}">Отмена</a>
                </div>
            </form>
        </div>
        <div class="postbottom"></div>
    </div>
</x-base>
