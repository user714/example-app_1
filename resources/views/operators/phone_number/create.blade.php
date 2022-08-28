@extends('layouts.app')
@section("content")
<h1>Форма создания номера телефона для оператора {{$operator->name}}</h1>
<form action="{{ route('operators.phone_number.create', $operator->id) }}" method="post">
    @csrf
    <div>
        <input type="hidden" name="id_operator" value="{{$operator->id}}">
        <input placeholder="Номер телефона" type="text" name="number_phone">
    </div>
    <div>
        <button>Сохранить</button>
    </div>
</form>
@endsection
