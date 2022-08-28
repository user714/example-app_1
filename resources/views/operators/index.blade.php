@extends('layouts.app')
@section("content")
    <h1>Список операторов</h1>
    <div>
        <a href="{{ route('operators.create_view') }}">Создать оператора</a>
    </div>


        @foreach($operators as $operator)
            <div style="display: grid;   grid-template-columns: 1fr 200px 200px; border-bottom: solid 1px #bbb; padding-bottom: 10px; padding-top: 10px;">
                <div>
                    {{$operator->name}}
                </div>
                <div>
                    <a href="{{ route('operators.price.list', $operator->id ) }}">Тарифная сетка</a>
                </div>
                <div>

                    <a href="{{ route('operators.phone_number.list',$operator->id ) }}">Номера телефонов</a>
                </div>
            </div>
        @endforeach

@endsection
