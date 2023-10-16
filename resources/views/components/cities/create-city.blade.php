<x-base>
    <x-slot:title>
        Create
    </x-slot>
    <div class="post">
        <div class="postheader"></div>
        <div class="postcontent">
            <h2>Список городов</h2>
            <!--вывод таблицы Города-->
            <form action="{{ route('store.city') }}" class="dopsity" method="post">
                @csrf
                <h3>Форма добовления города</h3>
                @php
                    $name = old('name');
                    $name = is_string($name) ? $name : '';
                @endphp
                <input type="text" name="name" placeholder="Название города" value="{{ $name }}">
                @error('name')
                    <span style="color: #d71414;">{{ $message }}</span><br>
                @enderror
                @php
                    $idx = old('idx');
                    $idx = is_string($idx) ? $idx : '';
                @endphp
                <input type="number" name="idx" placeholder="Индекс Сортировки" value="{{ $idx }}">
                @error('idx')
                    <span style="color: #d71414;">{{ $message }}</span><br>
                @enderror
            <br>
            <input type="submit" value="Добавить">
            <a href="{{ route('show.cities') }}">Отмена</a>
            </form>
        </div>
        <div class="postbottom"></div>
    </div>
</x-base>
