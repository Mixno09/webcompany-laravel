@php

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
{{--                    {{ form_widget(form.name, {--}}
{{--                        'attr': {'placeholder': 'Имя'},--}}
{{--                        'translation_domain': false,--}}
{{--                    }) }}--}}
                    @error('name')
                    <span style="color: #d71414; margin: unset">{{ $message }}</span>
                    @enderror
                    <input type="text" placeholder="Фамилия" value="{{ old('surName') }}">
                    @error('surName')
                    <span style="color: #d71414; margin: unset">{{ $message }}</span>
                    @enderror
                    <span>
                    {{ form_widget(form.city, {
                        'attr': {'size': '1'},
                        'translation_domain': false,
                    }) }}
                    {% for error in form.city.vars.errors %}
                        <span style="color: #d71414; margin: unset">{{ error.message }}</span>
                    {% endfor %}
                </span>
                    <p>Выберите файл изображения</p>
                    {{ form_widget(form.media, {'translation_domain': false}) }}
                    {% for error in form.media.vars.errors %}
                    <span style="color: #d71414; margin: unset">{{ error.message }}</span>
                    {% endfor %}
                    <input type="submit" value="Добавить">
                    <a href="{{ path('users') }}">Отмена</a>
                </div>
            </form>
        </div>
        <div class="postbottom"></div>
    </div>
</x-base>
