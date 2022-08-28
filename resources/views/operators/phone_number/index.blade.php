@extends('layouts.app')
@section("content")
    <h1>Номера телефонов оператора {{$operator->name}}</h1>
    <a href="{{ route("operators.phone_number.create_view", $operator->id) }}">Добавить новый номер</a>

    @foreach($phone_numbers as $phone_number)
        <div style=" border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
            {{$phone_number->number_phone}}
        </div>
    @endforeach
@endsection
