@php
    /**
     * @var \App\Models\City $city
    */
@endphp

<x-base>
    <x-slot:title>
        Edit
    </x-slot>
    <div class="post">
        <div class="postheader"></div>
        <div class="postcontent">
            <h2>Список городов</h2>
            <!--вывод таблицы Города-->
            <form action="{{ route('store.edit.city') }}" class="dopsity" method="post">
                @csrf
                <h3>Форма редактирования города</h3>
                <input type="text" name="name" placeholder="Название города" value="{{ $city->name }}">
                @error('name')
                <span style="color: #d71414;">{{ $message }}</span><br>
                @enderror
                <input type="number" name="idx" placeholder="Индекс Сортировки" value="{{ $city->idx }}">
                @error('idx')
                <span style="color: #d71414;">{{ $message }}</span><br>
                @enderror
                <br>
                <input type="submit" value="Редактировать">
                <input type="hidden" name="id" value="{{ $city->id }}">
                <a href="{{ route('show.cities') }}">Отмена</a>
            </form>
        </div>
        <div class="postbottom"></div>
    </div>
</x-base>
