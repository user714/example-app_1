@extends('layouts.app')
@section("content")
<h1>Форма создания пользователя</h1>
<form action="{{ route('users.create') }}" method="post">
    @csrf
    <div>
        <input placeholder="Имя" type="text" name="firstname">
    </div>
    <div>
        <input placeholder="Фамилия" type="text" name="lastname">
    </div>
    <div>
        <input placeholder="Отчество" type="text" name="patronymic">
    </div>
    <div>
        <div>
            Номер телефона
        </div>
        <select name="id_phone_number">

            @foreach($all_phone_numbers as $phone_number)
                <option value="{{$phone_number->id}}">{{$phone_number->number_phone}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button>Сохранить</button>
    </div>
</form>
@endsection
